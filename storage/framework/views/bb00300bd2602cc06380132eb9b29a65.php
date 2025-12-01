<div class="flex grow flex-col gap-y-5 overflow-y-auto bg-primary-900 px-6 pb-4">
    <div class="flex h-16 shrink-0 items-center">
        <span class="text-2xl font-bold text-white">📦 Inventory</span>
    </div>
    <nav class="flex flex-1 flex-col">
        <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
                <ul role="list" class="-mx-2 space-y-1">
                    <!-- Dashboard -->
                    <li>
                        <a href="<?php echo e(route('dashboard')); ?>" class="<?php echo e(request()->routeIs('dashboard*') ? 'bg-primary-800 text-white' : 'text-primary-200 hover:text-white hover:bg-primary-800'); ?> group flex gap-x-3 rounded-md p-2 text-sm font-semibold">
                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            Dashboard
                        </a>
                    </li>

                    <!-- Products -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view products')): ?>
                    <li>
                        <a href="<?php echo e(route('products.index')); ?>" class="<?php echo e(request()->routeIs('products.*') ? 'bg-primary-800 text-white' : 'text-primary-200 hover:text-white hover:bg-primary-800'); ?> group flex gap-x-3 rounded-md p-2 text-sm font-semibold">
                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>
                            Products
                        </a>
                    </li>
                    <?php endif; ?>

                    <!-- Categories -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view categories')): ?>
                    <li>
                        <a href="<?php echo e(route('categories.index')); ?>" class="<?php echo e(request()->routeIs('categories.*') ? 'bg-primary-800 text-white' : 'text-primary-200 hover:text-white hover:bg-primary-800'); ?> group flex gap-x-3 rounded-md p-2 text-sm font-semibold">
                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                            </svg>
                            Categories
                        </a>
                    </li>
                    <?php endif; ?>

                    <!-- Suppliers -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view suppliers')): ?>
                    <li>
                        <a href="<?php echo e(route('suppliers.index')); ?>" class="<?php echo e(request()->routeIs('suppliers.*') ? 'bg-primary-800 text-white' : 'text-primary-200 hover:text-white hover:bg-primary-800'); ?> group flex gap-x-3 rounded-md p-2 text-sm font-semibold">
                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                            Suppliers
                        </a>
                    </li>
                    <?php endif; ?>

                    <!-- Stock -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view stock')): ?>
                    <li x-data="{ open: <?php echo e(request()->routeIs('stock.*') ? 'true' : 'false'); ?> }">
                        <button type="button" @click="open = !open" class="w-full text-primary-200 hover:text-white hover:bg-primary-800 group flex gap-x-3 rounded-md p-2 text-sm font-semibold">
                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
                            </svg>
                            Stock Management
                            <svg :class="open ? 'rotate-90' : ''" class="ml-auto h-5 w-5 shrink-0 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <ul x-show="open" x-collapse class="mt-1 px-2">
                            <li>
                                <a href="<?php echo e(route('stock.index')); ?>" class="<?php echo e(request()->routeIs('stock.index') ? 'bg-primary-800 text-white' : 'text-primary-200 hover:text-white hover:bg-primary-800'); ?> block rounded-md py-2 pl-9 pr-2 text-sm">
                                    All Transactions
                                </a>
                            </li>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage stock')): ?>
                            <li>
                                <a href="<?php echo e(route('stock.in')); ?>" class="<?php echo e(request()->routeIs('stock.in*') ? 'bg-primary-800 text-white' : 'text-primary-200 hover:text-white hover:bg-primary-800'); ?> block rounded-md py-2 pl-9 pr-2 text-sm">
                                    Stock In
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('stock.out')); ?>" class="<?php echo e(request()->routeIs('stock.out*') ? 'bg-primary-800 text-white' : 'text-primary-200 hover:text-white hover:bg-primary-800'); ?> block rounded-md py-2 pl-9 pr-2 text-sm">
                                    Stock Out
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('stock.adjustment')); ?>" class="<?php echo e(request()->routeIs('stock.adjustment*') ? 'bg-primary-800 text-white' : 'text-primary-200 hover:text-white hover:bg-primary-800'); ?> block rounded-md py-2 pl-9 pr-2 text-sm">
                                    Adjustment
                                </a>
                            </li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>

                    <!-- Users -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage users')): ?>
                    <li>
                        <a href="<?php echo e(route('users.index')); ?>" class="<?php echo e(request()->routeIs('users.*') ? 'bg-primary-800 text-white' : 'text-primary-200 hover:text-white hover:bg-primary-800'); ?> group flex gap-x-3 rounded-md p-2 text-sm font-semibold">
                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            Users
                        </a>
                    </li>
                    <?php endif; ?>

                    <!-- POS -->
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access pos')): ?>
                    <li x-data="{ open: <?php echo e(request()->routeIs('pos.*') ? 'true' : 'false'); ?> }">
                        <button type="button" @click="open = !open" class="w-full <?php echo e(request()->routeIs('pos.*') ? 'bg-primary-800 text-white' : 'text-primary-200 hover:text-white hover:bg-primary-800'); ?> group flex gap-x-3 rounded-md p-2 text-sm font-semibold">
                            <svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                            </svg>
                            Point of Sale
                            <svg :class="open ? 'rotate-90' : ''" class="ml-auto h-5 w-5 shrink-0 transition-transform" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                            </svg>
                        </button>
                        <ul x-show="open" x-collapse class="mt-1 px-2">
                            <li>
                                <a href="<?php echo e(route('pos.index')); ?>" class="<?php echo e(request()->routeIs('pos.index') ? 'bg-primary-800 text-white' : 'text-primary-200 hover:text-white hover:bg-primary-800'); ?> block rounded-md py-2 pl-9 pr-2 text-sm">
                                    New Sale
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('pos.sales')); ?>" class="<?php echo e(request()->routeIs('pos.sales') || request()->routeIs('pos.show') ? 'bg-primary-800 text-white' : 'text-primary-200 hover:text-white hover:bg-primary-800'); ?> block rounded-md py-2 pl-9 pr-2 text-sm">
                                    Sales History
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo e(route('pos.report')); ?>" class="<?php echo e(request()->routeIs('pos.report') ? 'bg-primary-800 text-white' : 'text-primary-200 hover:text-white hover:bg-primary-800'); ?> block rounded-md py-2 pl-9 pr-2 text-sm">
                                    Sales Report
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php endif; ?>
                </ul>
            </li>

            <!-- User info at bottom -->
            <li class="mt-auto">
                <div class="flex items-center gap-x-4 px-2 py-3 text-sm font-semibold text-primary-200">
                    <img class="h-8 w-8 rounded-full bg-primary-800" src="<?php echo e(auth()->user()->avatar_url); ?>" alt="">
                    <span class="sr-only">Your profile</span>
                    <span><?php echo e(auth()->user()->name); ?></span>
                    <span class="ml-auto rounded-full bg-primary-800 px-2 py-1 text-xs">
                        <?php echo e(auth()->user()->roles->first()?->name ?? 'User'); ?>

                    </span>
                </div>
            </li>
        </ul>
    </nav>
</div>
<?php /**PATH D:\cnucum_projects\inventory-system\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>