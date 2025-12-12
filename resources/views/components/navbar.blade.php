<style>
  /* Top navbar */
  .navbar {
    position: sticky;
    top: 0;
    z-index: 40;
    display: flex;
    height: 4rem;
    align-items: center;
    gap: 1rem;
    border-bottom: 1px solid #e5e7eb;
    background-color: white;
    padding: 1rem;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
  }

  @media (min-width: 640px) {
    .navbar {
      gap: 1.5rem;
      padding: 1rem 1.5rem;
    }
  }

  @media (min-width: 1024px) {
    .navbar {
      padding: 1rem 2rem;
    }

    .mobile-menu-button {
      display: none;
    }
  }

  .mobile-menu-button {
    margin: -0.625rem;
    padding: 0.625rem;
    color: #374151;
    border: none;
    background: none;
    cursor: pointer;
  }

  .mobile-menu-button svg {
    width: 1.5rem;
    height: 1.5rem;
  }

  .navbar-divider {
    height: 1.5rem;
    width: 1px;
    background-color: #e5e7eb;
  }

  @media (min-width: 1024px) {
    .navbar-divider {
      display: none;
    }
  }

  .navbar-content {
    display: flex;
    flex: 1;
    gap: 1rem;
  }

  @media (min-width: 1024px) {
    .navbar-content {
      gap: 1.5rem;
    }
  }

  .navbar-spacer {
    flex: 1;
  }

  .navbar-actions {
    display: flex;
    align-items: center;
    gap: 1rem;
  }

  @media (min-width: 1024px) {
    .navbar-actions {
      gap: 1.5rem;
    }
  }

  /* User dropdown */
  .user-dropdown {
    position: relative;
  }

  .user-menu-button {
    margin: -0.375rem;
    padding: 0.375rem;
    display: flex;
    align-items: center;
    border: none;
    background: none;
    cursor: pointer;
    transition: none;
  }

  .user-menu-button:hover {
    background: none;
  }

  .user-avatar {
    width: 2rem;
    height: 2rem;
    border-radius: 50%;
    background-color: #f3f4f6;
  }

  .user-info {
    display: none;
    margin-left: 1rem;
    align-items: center;
  }

  @media (min-width: 1024px) {
    .user-info {
      display: flex;
    }
  }

  .user-name {
    font-size: 0.875rem;
    font-weight: 600;
    color: #111827;
  }

  .user-dropdown-icon {
    margin-left: 0.5rem;
    width: 1.25rem;
    height: 1.25rem;
    color: #9ca3af;
  }

  .dropdown-menu {
    position: absolute;
    right: 0;
    top: 100%;
    z-index: 50;
    margin-top: 0.625rem;
    width: 8rem;
    border-radius: 0.375rem;
    background-color: white;
    padding: 0.5rem 0;
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    border: 1px solid rgba(17, 24, 39, 0.05);
  }

  .dropdown-menu.hidden {
    display: none;
  }

  .dropdown-menu.visible {
    display: block;
  }

  .dropdown-item {
    display: block;
    padding: 0.25rem 0.75rem;
    font-size: 0.875rem;
    color: #111827;
    text-decoration: none;
    transition: background-color 0.2s;
  }

  .dropdown-item-button {
    width: 100%;
    text-align: left;
    border: none;
    background: none;
    padding: 0.25rem 0.75rem;
    font-size: 0.875rem;
    color: #111827;
    cursor: pointer;
    transition: background-color 0.2s;
  }
</style>

<div class="navbar">
  <button type="button"
          class="mobile-menu-button"
          @click="sidebarOpen = true">
    <span class="sr-only">Open sidebar</span>
    <svg fill="none"
         viewBox="0 0 24 24"
         stroke-width="1.5"
         stroke="currentColor">
      <path stroke-linecap="round"
            stroke-linejoin="round"
            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
    </svg>
  </button>

  <div class="navbar-divider"></div>

  <div class="navbar-content">
    <div class="navbar-spacer"></div>
    <div class="navbar-actions">
      <!-- User dropdown -->
      <div class="user-dropdown"
           x-data="{ dropdownOpen: false }"
           @click.away="dropdownOpen = false">
        <button type="button"
                @click="dropdownOpen = !dropdownOpen"
                class="user-menu-button">
          <img class="user-avatar"
               src="{{ auth()->user()->avatar_url }}"
               alt="">
          <span class="user-info">
            <span class="user-name">{{ auth()->user()->name }}</span>
            <svg class="user-dropdown-icon"
                 viewBox="0 0 20 20"
                 fill="currentColor">
              <path fill-rule="evenodd"
                    d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                    clip-rule="evenodd" />
            </svg>
          </span>
        </button>
        <div class="dropdown-menu"
             x-show="dropdownOpen"
             x-transition>
          <form method="POST"
                action="{{ route('logout') }}"
                class="w-full">
            @csrf
            <button type="submit"
                    class="dropdown-item-button">Sign out</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
