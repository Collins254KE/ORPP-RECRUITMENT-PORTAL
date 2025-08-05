<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Verify Your Email</title>
</head>
<body>
    <h2>Hello, <?php echo e($user->name); ?>!</h2>
    <p>Thank you for registering. Please click the link below to verify your email address:</p>

    <p>
        <a href="<?php echo e($verificationUrl); ?>" style="color: #fff; background-color: #1a73e8; padding: 10px 15px; text-decoration: none; border-radius: 5px;">
            Verify Email
        </a>
    </p>

    <p>If you did not create an account, no further action is required.</p>
    <p>Regards,<br>ORPP Recruitment Portal</p>
</body>
</html>
<?php /**PATH C:\orpp6\resources\views\emails\verify.blade.php ENDPATH**/ ?>