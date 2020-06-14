<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="login">
        <h1>Login</h1>
        <form action="includes/login.inc.php" method="post" autocomplete="off">
            <input type="text" name="login_username" placeholder="Username" required="required" />
            <input type="password" name="login_pwd" placeholder="Password" required="required" />
            <button type="submit" name="login_submit" class="btn btn-primary btn-block btn-large">Login</button>
            <a href="register.php" class="btn btn-primary btn-block btn-large nbtn">Register</a>
        </form>
    </div>
</body>
</html>