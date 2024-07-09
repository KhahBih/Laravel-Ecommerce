<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
</head>
<body>
    <h1>Reset Your Password</h1>
    <p>Please click the following link to reset your password:</p>
    <p><a href="{{ url('reset-password', $token) }}">Reset Password</a></p>
</body>
</html>
