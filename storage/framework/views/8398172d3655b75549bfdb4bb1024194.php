<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <meta name="csrf-token"
          content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Inventory System')); ?> - <?php echo $__env->yieldContent('title', 'Login'); ?></title>
    <link rel="preconnect"
          href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700"
          rel="stylesheet" />
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f9fafb;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem 1.5rem;
        }

        @media (max-width: 640px) {
            body {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div style="min-height: 100%; display: flex; flex-direction: column; justify-content: center;">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</body>

</html>
<?php /**PATH D:\cnucum_projects\inventory-system\resources\views/layouts/guest.blade.php ENDPATH**/ ?>