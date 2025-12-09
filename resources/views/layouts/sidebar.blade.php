<style>
    .sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.25rem;
        overflow-y: auto;
        background-color: #1f2937;
        padding: 1.5rem;
        padding-bottom: 1rem;
        flex-grow: 1;
    }

    .sidebar-header {
        display: flex;
        height: 4rem;
        align-items: center;
        flex-shrink: 0;
    }

    .sidebar-header span {
        font-size: 1.5rem;
        font-weight: bold;
        color: white;
    }

    .sidebar-nav {
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .sidebar-nav ul {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 1.75rem;
    }

    .nav-group {
        list-style: none;
    }

    .nav-items {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .nav-item {
        list-style: none;
    }

    .nav-link,
    .nav-button {
        display: flex;
        gap: 0.75rem;
        border-radius: 0.375rem;
        padding: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        border: none;
        cursor: pointer;
        background: none;
        width: 100%;
        text-align: left;
        transition: all 0.2s;
    }

    .nav-link {
        text-decoration: none;
    }

    .nav-link.inactive,
    .nav-button.inactive {
        color: #d1d5db;
    }

    .nav-link.inactive:hover,
    .nav-button.inactive:hover {
        color: white;
        background-color: #374151;
    }

    .nav-link.active,
    .nav-button.active {
        background-color: #374151;
        color: white;
    }

    .nav-icon {
        width: 1.5rem;
        height: 1.5rem;
        flex-shrink: 0;
    }

    .nav-submenu {
        list-style: none;
        margin-top: 0.25rem;
        padding-left: 0.5rem;
    }

    .nav-submenu li {
        list-style: none;
    }

    .nav-sublink {
        display: block;
        border-radius: 0.375rem;
        padding: 0.5rem 0.5rem 0.5rem 2.25rem;
        font-size: 0.875rem;
        text-decoration: none;
        color: #d1d5db;
        transition: all 0.2s;
    }

    .nav-sublink:hover {
        color: white;
        background-color: #374151;
    }

    .nav-sublink.active {
        background-color: #374151;
        color: white;
    }

    .chevron-icon {
        width: 1.25rem;
        height: 1.25rem;
        flex-shrink: 0;
        margin-left: auto;
        transition: transform 0.2s;
    }

    .chevron-icon.rotate {
        transform: rotate(90deg);
    }

    .submenu-hidden {
        display: none;
    }

    .submenu-visible {
        display: block;
    }

    .sidebar-footer {
        margin-top: auto;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.75rem 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: #d1d5db;
    }

    .user-avatar {
        width: 2rem;
        height: 2rem;
        border-radius: 50%;
        background-color: #374151;
    }

    .user-name {
        flex: 1;
    }

    .user-role {
        margin-left: auto;
        border-radius: 9999px;
        background-color: #374151;
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
</style>

<div class="sidebar">
    <div class="sidebar-header">
        <span>📦 Inventory</span>
    </div>
    <nav class="sidebar-nav">
        <ul>
            <li class="nav-group">
                <ul class="nav-items">
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}"
                           class="nav-link {{ request()->routeIs('dashboard*') ? 'active' : 'inactive' }}">
                            <svg class="nav-icon"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                            </svg>
                            Dashboard
                        </a>
                    </li>

                    <!-- Products -->
                    @can('view products')
                    <li class="nav-item">
                        <a href="{{ route('products.index') }}"
                           class="nav-link {{ request()->routeIs('products.*') ? 'active' : 'inactive' }}">
                            <svg class="nav-icon"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                            </svg>
                            Products
                        </a>
                    </li>
                    @endcan

                    <!-- Categories -->
                    @can('view categories')
                    <li class="nav-item">
                        <a href="{{ route('categories.index') }}"
                           class="nav-link {{ request()->routeIs('categories.*') ? 'active' : 'inactive' }}">
                            <svg class="nav-icon"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M2.25 12.75V12A2.25 2.25 0 014.5 9.75h15A2.25 2.25 0 0121.75 12v.75m-8.69-6.44l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                            </svg>
                            Categories
                        </a>
                    </li>
                    @endcan

                    <!-- Suppliers -->
                    @can('view suppliers')
                    <li class="nav-item">
                        <a href="{{ route('suppliers.index') }}"
                           class="nav-link {{ request()->routeIs('suppliers.*') ? 'active' : 'inactive' }}">
                            <svg class="nav-icon"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                            </svg>
                            Suppliers
                        </a>
                    </li>
                    @endcan

                    <!-- Stock -->
                    @can('view stock')
                    <li class="nav-item">
                        <button
                                class="nav-button stock-toggle {{ request()->routeIs('stock.*') ? 'active' : 'inactive' }}">
                            <svg class="nav-icon"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M7.5 14.25v2.25m3-4.5v4.5m3-6.75v6.75m3-9v9M6 20.25h12A2.25 2.25 0 0020.25 18V6A2.25 2.25 0 0018 3.75H6A2.25 2.25 0 003.75 6v12A2.25 2.25 0 006 20.25z" />
                            </svg>
                            Stock Management
                            <svg class="chevron-icon"
                                 viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                      clip-rule="evenodd" />
                            </svg>
                        </button>
                        <ul
                            class="nav-submenu stock-submenu {{ request()->routeIs('stock.*') ? 'submenu-visible' : 'submenu-hidden' }}">
                            <li><a href="{{ route('stock.index') }}"
                                   class="nav-sublink {{ request()->routeIs('stock.index') ? 'active' : '' }}">All
                                    Transactions</a></li>
                            @can('manage stock')
                            <li><a href="{{ route('stock.in') }}"
                                   class="nav-sublink {{ request()->routeIs('stock.in*') ? 'active' : '' }}">Stock
                                    In</a></li>
                            <li><a href="{{ route('stock.out') }}"
                                   class="nav-sublink {{ request()->routeIs('stock.out*') ? 'active' : '' }}">Stock
                                    Out</a></li>
                            <li><a href="{{ route('stock.adjustment') }}"
                                   class="nav-sublink {{ request()->routeIs('stock.adjustment*') ? 'active' : '' }}">Adjustment</a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                    @endcan

                    <!-- Users -->
                    @can('manage users')
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}"
                           class="nav-link {{ request()->routeIs('users.*') ? 'active' : 'inactive' }}">
                            <svg class="nav-icon"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                            </svg>
                            Users
                        </a>
                    </li>
                    @endcan

                    <!-- POS -->
                    @can('access pos')
                    <li class="nav-item">
                        <button class="nav-button pos-toggle {{ request()->routeIs('pos.*') ? 'active' : 'inactive' }}">
                            <svg class="nav-icon"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                            </svg>
                            Point of Sale
                            <svg class="chevron-icon"
                                 viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                      clip-rule="evenodd" />
                            </svg>
                        </button>
                        <ul
                            class="nav-submenu pos-submenu {{ request()->routeIs('pos.*') ? 'submenu-visible' : 'submenu-hidden' }}">
                            <li><a href="{{ route('pos.index') }}"
                                   class="nav-sublink {{ request()->routeIs('pos.index') ? 'active' : '' }}">New
                                    Sale</a></li>
                            <li><a href="{{ route('pos.sales') }}"
                                   class="nav-sublink {{ request()->routeIs('pos.sales') || request()->routeIs('pos.show') ? 'active' : '' }}">Sales
                                    History</a></li>
                            <li><a href="{{ route('pos.report') }}"
                                   class="nav-sublink {{ request()->routeIs('pos.report') ? 'active' : '' }}">Sales
                                    Report</a></li>
                        </ul>
                    </li>
                    @endcan
                </ul>
            </li>

            <!-- User info at bottom -->
            <li class="sidebar-footer">
                <div class="user-info">
                    <img class="user-avatar"
                         src="{{ auth()->user()->avatar_url }}"
                         alt="">
                    <span class="user-name">{{ auth()->user()->name }}</span>
                    <span class="user-role">{{ auth()->user()->roles->first()?->name ?? 'User' }}</span>
                </div>
            </li>
        </ul>
    </nav>

    <script>
        function initSubmenuToggle(buttonSelector) {
            document.querySelectorAll(buttonSelector).forEach(button => {
                const submenu = button.nextElementSibling;
                const chevron = button.querySelector('.chevron-icon');

                if (!submenu) {
                    return;
                }

                button.addEventListener('click', () => {
                    const isOpen = submenu.classList.contains('submenu-visible');
                    submenu.classList.toggle('submenu-visible', !isOpen);
                    submenu.classList.toggle('submenu-hidden', isOpen);
                    chevron?.classList.toggle('rotate', !isOpen);
                });
            });
        }

        initSubmenuToggle('.stock-toggle');
        initSubmenuToggle('.pos-toggle');
    </script>
</div>
