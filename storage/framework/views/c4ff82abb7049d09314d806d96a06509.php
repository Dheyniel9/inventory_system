<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <meta name="csrf-token"
          content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Inventory System')); ?> - <?php echo $__env->yieldContent('title', 'Dashboard'); ?></title>
    <link rel="preconnect"
          href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700"
          rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;500;600;700&display=swap"
          rel="stylesheet" />
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet"
          href="<?php echo e(asset('css/global.css')); ?>">

    <?php echo $__env->yieldContent('css'); ?>

    <style>
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

        /* Modern Layout using Flexbox */
        .app-layout {
            min-height: 100vh;
        }

        @media (min-width: 1024px) {
            .app-layout {
                display: flex;
            }
        }

        /* Main content takes remaining space */
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
            width: 100%;
        }

        @media (min-width: 1024px) {
            .main-content {
                width: auto;
            }
        }

        /* Page content */
        .page-content {
            flex: 1;
            padding: 1.5rem;
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
</head>

<body>
    <div class="app-layout"
         x-data="{ sidebarOpen: false }">
        <!-- Mobile sidebar -->
        <div class="mobile-sidebar-overlay"
             :class="{ 'visible': sidebarOpen, 'hidden': !sidebarOpen }">
            <div class="sidebar-backdrop"
                 @click="sidebarOpen = false"></div>
            <div class="sidebar-container">
                <div class="sidebar-content">
                    <div class="sidebar-close-button">
                        <button type="button"
                                @click="sidebarOpen = false">
                            <span class="sr-only">Close sidebar</span>
                            <svg fill="none"
                                 viewBox="0 0 24 24"
                                 stroke-width="1.5"
                                 stroke="currentColor">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            </div>
        </div>

        <!-- Static sidebar for desktop -->
        <div class="desktop-sidebar">
            <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>

        <!-- Main content -->
        <div class="main-content">
            <!-- Top navbar -->
            <?php echo $__env->make('components.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- Page content -->
            <main class="page-content">
                <?php if(session('success')): ?>
                <div class="alert alert-success"
                     x-data="{ show: true }"
                     x-show="show"
                     x-init="setTimeout(() => show = false, 5000)">
                    <div class="alert-content">
                        <div class="alert-icon">
                            <svg viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                      clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="alert-message">
                            <p><?php echo e(session('success')); ?></p>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if($errors->any()): ?>
                <div class="alert alert-error">
                    <div class="alert-content">
                        <div class="alert-icon">
                            <svg viewBox="0 0 20 20"
                                 fill="currentColor">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                                      clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="alert-message">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
            defer></script>
</body>

</html>
<?php /**PATH D:\cnucum_projects\inventory-system\resources\views/layouts/app.blade.php ENDPATH**/ ?>