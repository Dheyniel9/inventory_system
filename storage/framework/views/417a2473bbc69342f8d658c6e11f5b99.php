<style>
    /* Root styles */
    html,
    body {
        height: 100%;
        background-color: #f3f4f6;
        font-family: 'Roboto Mono', monospace;
    }

    body {
        margin: 0;
        padding: 0;
    }

    .app-layout {
        min-height: 100vh;
    }

    /* Sidebar Container */
    .sidebar-wrapper {
        display: contents;
    }

    /* Mobile sidebar overlay */
    .mobile-sidebar-overlay {
        position: fixed;
        inset: 0;
        z-index: 40;
        background-color: rgba(17, 24, 39, 0.5);
        transition: opacity 0.3s ease-in-out;
    }

    .mobile-sidebar-overlay.hidden {
        opacity: 0;
        pointer-events: none;
    }

    /* Mobile sidebar container */
    .mobile-sidebar-container {
        position: fixed;
        inset-y: 0;
        left: 0;
        z-index: 50;
        width: 18rem;
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
        background-color: white;
        display: flex;
        flex-direction: column;
    }

    .mobile-sidebar-container.open {
        transform: translateX(0);
    }

    .sidebar-close-button {
        position: absolute;
        right: -3.5rem;
        top: 1.25rem;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 2rem;
        height: 2rem;
        border: none;
        background: none;
        cursor: pointer;
        color: white;
    }

    .sidebar-close-button svg {
        width: 1.5rem;
        height: 1.5rem;
    }

    /* Desktop sidebar */
    .desktop-sidebar {
        display: none;
        position: fixed;
        inset-y: 0;
        left: 0;
        z-index: 50;
        width: 18rem;
        background-color: white;
        border-right: 1px solid #e5e7eb;
        display: flex;
        flex-direction: column;
    }

    @media (min-width: 1024px) {
        .desktop-sidebar {
            display: flex;
        }

        .mobile-sidebar-overlay,
        .mobile-sidebar-container {
            display: none;
        }
    }

    /* Sidebar Content */
    .sidebar-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        height: 4rem;
        padding: 0 1.5rem;
        flex-shrink: 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .sidebar-logo {
        font-size: 1.5rem;
        font-weight: bold;
        color: #111827;
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
        background-color: #f3f4f6;
        color: #111827;
    }

    @media (min-width: 1024px) {
        .close-button {
            display: none;
        }
    }

    .sidebar-content {
        flex: 1;
        overflow-y: auto;
        padding: 1.5rem 0;
    }

    .nav-list {
        list-style: none;
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
        margin-bottom: 1.5rem;
        padding: 0 0.75rem;
    }

    .nav-item {
        list-style: none;
    }

    .nav-link,
    .nav-button {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        width: 100%;
        padding: 0.625rem 0.75rem;
        border: none;
        border-radius: 0.5rem;
        background: none;
        font-size: 0.875rem;
        font-weight: 500;
        text-align: left;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .nav-link.inactive,
    .nav-button.inactive {
        color: #6b7280;
    }

    .nav-link.inactive:hover,
    .nav-button.inactive:hover {
        color: #111827;
        background-color: #f3f4f6;
    }

    .nav-link.active,
    .nav-button.active {
        background-color: #3b82f6;
        color: white;
    }

    .nav-icon {
        width: 1.25rem;
        height: 1.25rem;
        flex-shrink: 0;
    }

    .nav-text {
        flex: 1;
    }

    .chevron-icon {
        width: 1.25rem;
        height: 1.25rem;
        flex-shrink: 0;
        transition: transform 0.2s;
    }

    .chevron-icon.rotate {
        transform: rotate(90deg);
    }

    .nav-submenu {
        list-style: none;
        overflow: hidden;
        max-height: 0;
        transition: max-height 0.3s ease-in-out;
    }

    .nav-submenu.open {
        max-height: 500px;
    }

    .nav-sublink {
        display: block;
        padding: 0.625rem 0.75rem 0.625rem 2.75rem;
        font-size: 0.875rem;
        color: #9ca3af;
        text-decoration: none;
        border-radius: 0.5rem;
        transition: all 0.2s;
    }

    .nav-sublink:hover {
        color: #111827;
        background-color: #f3f4f6;
    }

    .nav-sublink.active {
        background-color: #eff6ff;
        color: #1e40af;
    }

    .sidebar-footer {
        padding: 1rem 1.5rem;
        border-top: 1px solid #e5e7eb;
        flex-shrink: 0;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .user-avatar {
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        object-fit: cover;
        background-color: #f3f4f6;
    }

    .user-details {
        flex: 1;
        min-width: 0;
    }

    .user-name {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #111827;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .user-role {
        display: inline-block;
        margin-top: 0.25rem;
        padding: 0.125rem 0.5rem;
        font-size: 0.75rem;
        color: #9ca3af;
        background-color: #f3f4f6;
        border-radius: 9999px;
    }

    /* Main content */
    .main-content {
        padding: 0;
    }

    @media (min-width: 1024px) {
        .main-content {
            padding-left: 18rem;
        }
    }

    /* Page content */
    .page-content {
        padding: 1.5rem;
    }

    @media (min-width: 640px) {
        .page-content {
            padding: 1.5rem;
        }
    }

    @media (min-width: 1024px) {
        .page-content {
            padding: 1.5rem;
        }
    }

    /* Alerts */
    .alert {
        margin-bottom: 1rem;
        border-radius: 0.375rem;
        padding: 1rem;
    }

    .alert-success {
        background-color: #f0fdf4;
    }

    .alert-error {
        background-color: #fef2f2;
    }

    .alert-content {
        display: flex;
    }

    .alert-icon {
        flex-shrink: 0;
        width: 1.25rem;
        height: 1.25rem;
    }

    .alert-success .alert-icon {
        color: #4ade80;
    }

    .alert-error .alert-icon {
        color: #f87171;
    }

    .alert-message {
        margin-left: 0.75rem;
    }

    .alert-success .alert-message {
        font-size: 0.875rem;
        font-weight: 500;
        color: #166534;
    }

    .alert-error .alert-message {
        font-size: 0.875rem;
        color: #7f1d1d;
    }

    .alert-error ul {
        list-style: disc;
        padding-left: 1.5rem;
        margin: 0;
    }

    .alert-error li {
        margin: 0;
    }
</style>

<div class="sidebar-wrapper"
     x-data="{ sidebarOpen: false }">
    <!-- Mobile sidebar overlay -->
    <div class="mobile-sidebar-overlay"
         :class="{ 'hidden': !sidebarOpen }"
         @click="sidebarOpen = false"></div>

    <!-- Mobile sidebar -->
    <div class="mobile-sidebar-container"
         :class="{ 'open': sidebarOpen }">
        <button class="sidebar-close-button"
                @click="sidebarOpen = false"
                aria-label="Close sidebar">
            <svg fill="none"
                 viewBox="0 0 24 24"
                 stroke-width="1.5"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <?php echo $__env->make('layouts.sidebar-content', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>

    <!-- Desktop sidebar -->
    <div class="desktop-sidebar">
        <?php echo $__env->make('layouts.sidebar-content', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </div>
</div>

<script>
    // Make sidebarOpen accessible globally for navbar button
    document.addEventListener('alpine:init', () => {
        Alpine.store('sidebar', {
            open: false,
            toggle() {
                this.open = !this.open;
            },
            close() {
                this.open = false;
            }
        });
    });
</script>
<?php /**PATH D:\cnucum_projects\inventory-system\resources\views/components/sidebar.blade.php ENDPATH**/ ?>