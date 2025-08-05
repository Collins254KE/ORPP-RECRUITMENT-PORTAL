<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Shortlisted Notification</title>
</head>
<body>
    <h1>Congratulations!</h1>
    <p>Dear <?php echo e($application->user->name); ?>,</p>
    <p>You have been shortlisted for the position of <?php echo e($application->jobListing->title); ?>.</p>
    <p>Login to your portal: <a href="<?php echo e(route('login')); ?>">here</a></p>
</body>
</html>
<?php /**PATH C:\orpp6\resources\views/emails/shortlisted_notification_html.blade.php ENDPATH**/ ?>