<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StockTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_number',
        'product_id',
        'user_id',
        'type',
        'quantity',
        'quantity_before',
        'quantity_after',
        'unit_cost',
        'total_cost',
        'reason',
        'notes',
        'transaction_date',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'quantity_before' => 'integer',
        'quantity_after' => 'integer',
        'unit_cost' => 'decimal:2',
        'total_cost' => 'decimal:2',
        'transaction_date' => 'datetime',
    ];

    public const TYPE_IN = 'in';
    public const TYPE_OUT = 'out';
    public const TYPE_ADJUSTMENT = 'adjustment';
    public const TYPE_RETURN = 'return';

    public const TYPES = [
        self::TYPE_IN => 'Stock In',
        self::TYPE_OUT => 'Stock Out',
        self::TYPE_ADJUSTMENT => 'Adjustment',
        self::TYPE_RETURN => 'Return',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            if (empty($transaction->reference_number)) {
                $transaction->reference_number = self::generateReferenceNumber($transaction->type);
            }

            if (empty($transaction->transaction_date)) {
                $transaction->transaction_date = now();
            }
        });
    }

    // Relationships
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopeByType($query, $type)
    {
        if (!$type) {
            return $query;
        }

        return $query->where('type', $type);
    }

    public function scopeByProduct($query, $productId)
    {
        if (!$productId) {
            return $query;
        }

        return $query->where('product_id', $productId);
    }

    public function scopeByUser($query, $userId)
    {
        if (!$userId) {
            return $query;
        }

        return $query->where('user_id', $userId);
    }

    public function scopeDateRange($query, $startDate, $endDate)
    {
        if ($startDate) {
            $query->whereDate('transaction_date', '>=', $startDate);
        }

        if ($endDate) {
            $query->whereDate('transaction_date', '<=', $endDate);
        }

        return $query;
    }

    public function scopeSearch($query, ?string $search)
    {
        if (!$search) {
            return $query;
        }

        return $query->where(function ($q) use ($search) {
            $q->where('reference_number', 'like', "%{$search}%")
              ->orWhere('reason', 'like', "%{$search}%")
              ->orWhere('notes', 'like', "%{$search}%")
              ->orWhereHas('product', function ($pq) use ($search) {
                  $pq->where('name', 'like', "%{$search}%")
                    ->orWhere('sku', 'like', "%{$search}%");
              });
        });
    }

    // Static methods
    public static function generateReferenceNumber(string $type): string
    {
        $prefix = match ($type) {
            self::TYPE_IN => 'STI',
            self::TYPE_OUT => 'STO',
            self::TYPE_ADJUSTMENT => 'ADJ',
            self::TYPE_RETURN => 'RTN',
            default => 'TRX',
        };

        $date = now()->format('Ymd');
        $lastTransaction = self::where('reference_number', 'like', "{$prefix}{$date}%")
            ->orderBy('reference_number', 'desc')
            ->first();

        if (!$lastTransaction) {
            return "{$prefix}{$date}0001";
        }

        $lastNumber = (int) substr($lastTransaction->reference_number, -4);
        return "{$prefix}{$date}" . str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
    }

    // Accessors
    public function getTypeLabelAttribute(): string
    {
        return self::TYPES[$this->type] ?? 'Unknown';
    }

    public function getIsStockInAttribute(): bool
    {
        return in_array($this->type, [self::TYPE_IN, self::TYPE_RETURN]);
    }

    public function getIsStockOutAttribute(): bool
    {
        return $this->type === self::TYPE_OUT;
    }

    public function getQuantityChangeAttribute(): string
    {
        $sign = $this->is_stock_in ? '+' : '-';
        return $sign . abs($this->quantity);
    }
}
