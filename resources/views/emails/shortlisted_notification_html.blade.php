<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Shortlisted Notification</title>
</head>
<body>
    <h1>Congratulations!</h1>
    <p>Dear {{ $application->user->name }},</p>
    <p>You have been shortlisted for the position of {{ $application->jobListing->title }}.</p>
    <p>Login to your portal: <a href="{{ route('login') }}">here</a></p>
</body>
</html>
