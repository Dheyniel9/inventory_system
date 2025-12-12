<style>
    /* Sidebar Base Styles */
    .sidebar {
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 18rem;
        background-color: #1f2937;
        overflow-y: auto;
    }

    /* Header Section */
    .sidebar-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 4rem;
        padding: 0 1rem;
        border-bottom: 1px solid #374151;
        flex-shrink: 0;
    }

    .sidebar-logo {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.25rem;
        font-weight: 700;
        color: white;
    }

    .close-button {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2rem;
        height: 2rem;
        border: none;
        background: none;
        color: #9ca3af;
        cursor: pointer;
        border-radius: 0.375rem;
        transition: all 0.2s;
    }

    .close-button:hover {
        background-color: #374151;
        color: white;
    }

    /* Content Section */
    .sidebar-content {
        flex: 1;
        overflow-y: auto;
        padding: 1rem;
    }

    /* Navigation List */
    .nav-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: flex;
        flex-direction: column;
        gap: 0.125rem;
    }

    .nav-item {
        list-style: none;
    }

    /* Navigation Links */
    .nav-link,
    .nav-button {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        width: 100%;
        padding: 0.75rem;
        border: none;
        border-radius: 0.5rem;
        background: none;
        font-size: 0.875rem;
        font-weight: 500;
        text-align: left;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.15s ease;
        color: #d1d5db;
    }

    .nav-link:hover,
    .nav-button:hover {
        background-color: #374151;
        color: white;
    }

    .nav-link.active,
    .nav-button.active {
        background-color: #3b82f6;
        color: white;
        font-weight: 600;
    }

    .nav-icon {
        width: 1.25rem;
        height: 1.25rem;
        flex-shrink: 0;
    }

    .nav-text {
        flex: 1;
        line-height: 1.25;
    }

    /* Chevron Icon */
    .chevron-icon {
        width: 1rem;
        height: 1rem;
        flex-shrink: 0;
        transition: transform 0.2s ease;
        opacity: 0.6;
    }

    .chevron-icon.rotate {
        transform: rotate(90deg);
    }

    /* Submenu */
    .nav-submenu {
        list-style: none;
        padding: 0;
        margin: 0.25rem 0 0.5rem 0;
        overflow: hidden;
        max-height: 0;
        transition: max-height 0.3s ease;
    }

    .nav-submenu.open {
        max-height: 500px;
    }

    .nav-sublink {
        display: flex;
        align-items: center;
        padding: 0.625rem 0.75rem 0.625rem 2.75rem;
        font-size: 0.8125rem;
        color: #9ca3af;
        text-decoration: none;
        border-radius: 0.5rem;
        transition: all 0.15s ease;
        line-height: 1.25;
    }

    .nav-sublink:hover {
        background-color: #374151;
        color: #d1d5db;
    }

    .nav-sublink.active {
        background-color: #374151;
        color: white;
        font-weight: 500;
    }

    /* Mobile Overlay */
    .mobile-sidebar-overlay {
        position: relative;
        z-index: 50;
        display: none;
    }

    @media (max-width: 1023px) {
        .mobile-sidebar-overlay {
            display: block;
        }
    }

    .mobile-sidebar-overlay.hidden {
        display: none;
    }

    .mobile-sidebar-overlay.visible {
        display: block;
    }

    .sidebar-backdrop {
        position: fixed;
        inset: 0;
        background-color: rgba(0, 0, 0, 0.5);
        animation: fadeIn 0.2s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .sidebar-container {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        width: 18rem;
        transform: translateX(-100%);
        transition: transform 0.3s ease;
        z-index: 51;
    }

    .sidebar-container.open {
        transform: translateX(0);
    }

    .sidebar-close-button {
        position: absolute;
        left: 100%;
        top: 0;
        display: flex;
        justify-content: center;
        padding-top: 1rem;
        width: 3rem;
    }

    .sidebar-close-button button {
        padding: 0.5rem;
        border: none;
        background-color: rgba(0, 0, 0, 0.3);
        border-radius: 0.375rem;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .sidebar-close-button button:hover {
        background-color: rgba(0, 0, 0, 0.5);
    }

    .sidebar-close-button svg {
        width: 1.5rem;
        height: 1.5rem;
        color: white;
    }

    /* Desktop Sidebar */
    .desktop-sidebar {
        display: none;
    }

    @media (min-width: 1024px) {
        .desktop-sidebar {
            display: block;
            flex-shrink: 0;
            width: 18rem;
            height: 100vh;
            position: sticky;
            top: 0;
        }

        .close-button {
            display: none;
        }
    }

    /* Scrollbar Styling */
    .sidebar-content::-webkit-scrollbar {
        width: 0.375rem;
    }

    .sidebar-content::-webkit-scrollbar-track {
        background: transparent;
    }

    .sidebar-content::-webkit-scrollbar-thumb {
        background: #4b5563;
        border-radius: 0.25rem;
    }

    .sidebar-content::-webkit-scrollbar-thumb:hover {
        background: #6b7280;
    }
</style>

<div class="sidebar">
    <!-- Header -->
    <div class="sidebar-header">
        <div class="sidebar-logo">
            <span>📦</span>
            <span>Inventory</span>
        </div>
        <button class="close-button"
                @click="sidebarOpen = false"
                aria-label="Close menu">
            <svg class="nav-icon"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke-width="2"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Navigation Content -->
    <div class="sidebar-content">
        <nav>
            <ul class="nav-list">
                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="<?php echo e(route('dashboard')); ?>"
                       class="nav-link <?php echo e(request()->routeIs('dashboard*') ? 'active' : ''); ?>">
                        <svg class="nav-icon"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        <span class="nav-text">Dashboard</span>
                    </a>
                </li>

                <!-- Products -->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view products')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('products.index')); ?>"
                       class="nav-link <?php echo e(request()->routeIs('products.*') ? 'active' : ''); ?>">
                        <svg class="nav-icon"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                        </svg>
                        <span class="nav-text">Products</span>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Categories -->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view categories')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('categories.index')); ?>"
                       class="nav-link <?php echo e(request()->routeIs('categories.*') ? 'active' : ''); ?>">
                        <svg class="nav-icon"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                        </svg>
                        <span class="nav-text">Categories</span>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Suppliers -->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view suppliers')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('suppliers.index')); ?>"
                       class="nav-link <?php echo e(request()->routeIs('suppliers.*') ? 'active' : ''); ?>">
                        <svg class="nav-icon"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                        </svg>
                        <span class="nav-text">Suppliers</span>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Stock Management -->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view stock')): ?>
                <li class="nav-item"
                    x-data="{ open: <?php echo e(request()->routeIs('stock.*') ? 'true' : 'false'); ?> }">
                    <button class="nav-button <?php echo e(request()->routeIs('stock.*') ? 'active' : ''); ?>"
                            @click="open = !open">
                        <svg class="nav-icon"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
                        </svg>
                        <span class="nav-text">Stock Management</span>
                        <svg class="chevron-icon"
                             :class="{ 'rotate': open }"
                             viewBox="0 0 20 20"
                             fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                  clip-rule="evenodd" />
                        </svg>
                    </button>
                    <ul class="nav-submenu"
                        :class="{ 'open': open }">
                        <li>
                            <a href="<?php echo e(route('stock.index')); ?>"
                               class="nav-sublink <?php echo e(request()->routeIs('stock.index') ? 'active' : ''); ?>">
                                All Transactions
                            </a>
                        </li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage stock')): ?>
                        <li>
                            <a href="<?php echo e(route('stock.in')); ?>"
                               class="nav-sublink <?php echo e(request()->routeIs('stock.in*') ? 'active' : ''); ?>">
                                Stock In
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('stock.out')); ?>"
                               class="nav-sublink <?php echo e(request()->routeIs('stock.out*') ? 'active' : ''); ?>">
                                Stock Out
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('stock.adjustment')); ?>"
                               class="nav-sublink <?php echo e(request()->routeIs('stock.adjustment*') ? 'active' : ''); ?>">
                                Adjustment
                            </a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>
                <?php endif; ?>

                <!-- Users -->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage users')): ?>
                <li class="nav-item">
                    <a href="<?php echo e(route('users.index')); ?>"
                       class="nav-link <?php echo e(request()->routeIs('users.*') ? 'active' : ''); ?>">
                        <svg class="nav-icon"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                        </svg>
                        <span class="nav-text">Users</span>
                    </a>
                </li>
                <?php endif; ?>

                <!-- Point of Sale -->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('access pos')): ?>
                <li class="nav-item"
                    x-data="{ open: <?php echo e(request()->routeIs('pos.*') ? 'true' : 'false'); ?> }">
                    <button class="nav-button <?php echo e(request()->routeIs('pos.*') ? 'active' : ''); ?>"
                            @click="open = !open">
                        <svg class="nav-icon"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke-width="1.5"
                             stroke="currentColor">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                        </svg>
                        <span class="nav-text">Point of Sale</span>
                        <svg class="chevron-icon"
                             :class="{ 'rotate': open }"
                             viewBox="0 0 20 20"
                             fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                  clip-rule="evenodd" />
                        </svg>
                    </button>
                    <ul class="nav-submenu"
                        :class="{ 'open': open }">
                        <li>
                            <a href="<?php echo e(route('pos.index')); ?>"
                               class="nav-sublink <?php echo e(request()->routeIs('pos.index') ? 'active' : ''); ?>">
                                New Sale
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('pos.sales')); ?>"
                               class="nav-sublink <?php echo e(request()->routeIs('pos.sales') || request()->routeIs('pos.show') ? 'active' : ''); ?>">
                                Sales History
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo e(route('pos.report')); ?>"
                               class="nav-sublink <?php echo e(request()->routeIs('pos.report') ? 'active' : ''); ?>">
                                Sales Report
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>
<?php /**PATH D:\cnucum_projects\inventory-system\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>