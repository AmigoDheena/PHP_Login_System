<?php
    require_once 'includes/register.inc.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="login">
        <h1>Register</h1>
        <form action="includes/register.inc.php" method="post" autocomplete="off" novalidate>
            <?php if(isset($_SESSION['message'])){ ?>
                <div class="<?php echo $_SESSION['message_type'] ?>-msg">
                <?php echo $_SESSION['message']; 
                    unset($_SESSION['message']);
                ?>
                </div>
            <?php } ?>
            <input type="text" name="reg_username" placeholder="Username"  />
            <input type="email" name="reg_email" placeholder="Email" >
            <input type="password" name="reg_pwd" placeholder="Password"  />
            <input type="password" name="reg_repeat_pwd" placeholder="Repeat Password"  />
            <button type="submit" name="reg_submit" class="btn btn-primary btn-block btn-large">Register</button>
            <a href="index.php" class="btn btn-primary btn-block btn-large nbtn">Login</a>
        </form>
    </div>
</body>
</html>