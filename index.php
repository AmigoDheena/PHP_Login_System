<?php
    require_once 'includes/login.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php if(!isset($_SESSION['id']) && !isset($_SESSION['reg_username'])){ ?>
        <div class="login">
            <h1>Login</h1>
            <form action="includes/login.inc.php" method="POST" autocomplete="off">
                <?php if(isset($_SESSION['message'])){ ?>
                    <div class="<?php echo $_SESSION['message_type'] ?>-msg">
                    <?php echo $_SESSION['message']; 
                        unset($_SESSION['message']);
                    ?>
                    </div>
                <?php } ?>
                <input type="text" name="login_username" placeholder="Username" />
                <input type="password" name="login_pwd" placeholder="Password" />
                <button type="submit" name="login_submit" class="btn btn-primary btn-block btn-large">Login</button>
                <a href="register.php" class="btn btn-primary btn-block btn-large nbtn">Register</a>
            </form>
        </div>
    <?php }elseif(isset($_SESSION['id']) && isset($_SESSION['reg_username'])){ ?>
        <div class="loggedin">
        <h1>You are Logged in!</h1>
        <form action="includes/logout.inc.php" method="POST">
            <button type="submit" name="logout" class="btn btn-primary btn-block btn-large">Logout</button>
        </form>
        </div>
       <?php }else{
            'You are not logged in';
        }
    ?>
</body>
</html>