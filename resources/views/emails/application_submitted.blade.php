<!DOCTYPE html>
<html>
<head>
    <title>Application Submitted</title>
</head>
<body>
    <h1>Hello {{ $user->name }},</h1>

    <p>Thank you for submitting your application for the job: <strong>{{ $application->jobListing->title ?? 'N/A' }}</strong>.</p>

    <p>Your application is currently being processed. We will notify you with updates.</p>

    <p>Best regards,<br>ORPP Recruitment Team</p>
</body>
</html>
