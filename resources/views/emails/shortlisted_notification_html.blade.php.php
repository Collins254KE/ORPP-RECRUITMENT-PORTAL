<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Shortlisted Notification</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <h2>Dear {{ $application->user->name }},</h2>

    <p>
        We are pleased to inform you that you have been <strong>shortlisted</strong> for the position of
        <strong>{{ $application->jobListing->title }}</strong> at the Office of the Registrar of Political Parties (ORPP).
    </p>

    <p>
        Please log in to your account for further information and next steps.
    </p>

    <p>
        <a href="{{ url('/login') }}" style="background-color: #007bff; color: white; padding: 10px 15px; text-decoration: none; border-radius: 5px;">Login to Your Account</a>
    </p>

    <p>Thank you for your interest in joining ORPP.</p>

    <p>Best regards,<br>
    ORPP Recruitment Team</p>
</body>
</html>
