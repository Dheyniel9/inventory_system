<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UserService
{
    public function __construct(
        protected User $model
    ) {}

    public function getPaginated(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->query()
            ->with('roles')
            ->search($filters['search'] ?? null)
            ->when(isset($filters['is_active']), fn($q) => $q->where('is_active', $filters['is_active']))
            ->when(isset($filters['role']), fn($q) => $q->role($filters['role']))
            ->orderBy($filters['sort_by'] ?? 'name', $filters['sort_order'] ?? 'asc')
            ->paginate($perPage);
    }

    public function getAll(bool $activeOnly = true): Collection
    {
        return $this->model
            ->query()
            ->with('roles')
            ->when($activeOnly, fn($q) => $q->active())
            ->orderBy('name')
            ->get();
    }

    public function findById(int $id): ?User
    {
        return $this->model
            ->with(['roles', 'stockTransactions' => fn($q) => $q->latest()->limit(10)])
            ->find($id);
    }

    public function findByEmail(string $email): ?User
    {
        return $this->model
            ->with('roles')
            ->where('email', $email)
            ->first();
    }

    public function create(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $avatarPath = null;

            if (isset($data['avatar']) && $data['avatar'] instanceof UploadedFile) {
                $avatarPath = $this->uploadAvatar($data['avatar']);
            }

            $user = $this->model->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'phone' => $data['phone'] ?? null,
                'avatar' => $avatarPath,
                'is_active' => $data['is_active'] ?? true,
            ]);

            // Assign role
            if (isset($data['role'])) {
                $user->assignRole($data['role']);
            }

            return $user->load('roles');
        });
    }

    public function update(User $user, array $data): User
    {
        return DB::transaction(function () use ($user, $data) {
            $avatarPath = $user->avatar;

            if (isset($data['avatar']) && $data['avatar'] instanceof UploadedFile) {
                $this->deleteAvatar($user->avatar);
                $avatarPath = $this->uploadAvatar($data['avatar']);
            } elseif (isset($data['remove_avatar']) && $data['remove_avatar']) {
                $this->deleteAvatar($user->avatar);
                $avatarPath = null;
            }

            $updateData = [
                'name' => $data['name'] ?? $user->name,
                'email' => $data['email'] ?? $user->email,
                'phone' => $data['phone'] ?? $user->phone,
                'avatar' => $avatarPath,
                'is_active' => $data['is_active'] ?? $user->is_active,
            ];

            if (!empty($data['password'])) {
                $updateData['password'] = Hash::make($data['password']);
            }

            $user->update($updateData);

            // Update role
            if (isset($data['role'])) {
                $user->syncRoles([$data['role']]);
            }

            return $user->fresh('roles');
        });
    }

    public function delete(User $user): bool
    {
        return DB::transaction(function () use ($user) {
            return $user->delete();
        });
    }

    public function forceDelete(User $user): bool
    {
        return DB::transaction(function () use ($user) {
            $this->deleteAvatar($user->avatar);
            return $user->forceDelete();
        });
    }

    public function restore(int $id): ?User
    {
        $user = $this->model->withTrashed()->find($id);

        if ($user) {
            $user->restore();
        }

        return $user;
    }

    public function toggleStatus(User $user): User
    {
        $user->update(['is_active' => !$user->is_active]);
        return $user->fresh();
    }

    public function updatePassword(User $user, string $password): User
    {
        $user->update(['password' => Hash::make($password)]);
        return $user->fresh();
    }

    public function getAllRoles(): Collection
    {
        return Role::orderBy('name')->get();
    }

    public function assignRole(User $user, string $roleName): User
    {
        $user->assignRole($roleName);
        return $user->fresh('roles');
    }

    public function removeRole(User $user, string $roleName): User
    {
        $user->removeRole($roleName);
        return $user->fresh('roles');
    }

    public function syncRoles(User $user, array $roles): User
    {
        $user->syncRoles($roles);
        return $user->fresh('roles');
    }

    protected function uploadAvatar(UploadedFile $file): string
    {
        return $file->store('avatars', 'public');
    }

    protected function deleteAvatar(?string $path): bool
    {
        if ($path && Storage::disk('public')->exists($path)) {
            return Storage::disk('public')->delete($path);
        }

        return false;
    }
}
