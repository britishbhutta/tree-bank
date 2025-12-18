<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Account Created</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">

    <h2>Hello {{ $name }},</h2>

    <p>
        Your account has been successfully created by the <strong>Admin Team</strong>.
    </p>

    <p>
        Here are your login details:
    </p>

    <ul>
        <li><strong>Login Email:</strong> {{ $email }}</li>
        <li><strong>Temporary Password:</strong> {{ $password }}</li>
    </ul>

    <p>
        For security reasons, we recommend that you change your password after logging in.
    </p>

    <p>To change your password:</p>
    <ol>
        <li>Log in to your account</li>
        <li>Go to your profile page</li>
        <li>Edit your profile and update your password</li>
    </ol>

    <p>
        If you encounter any issues or need assistance, please contact the admin team.
    </p>

    <p>
        Best regards,<br>
        <strong>Admin Team</strong>
    </p>

</body>
</html>
