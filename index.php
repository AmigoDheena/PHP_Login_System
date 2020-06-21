<?php
    require_once 'includes/login.inc.php';
    include 'includes/google_api.php';
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
    <?php 
    // if( ( !isset($_SESSION['id']) && !isset($_SESSION['reg_username']) ) || (!isset($_SESSION['name'])) ){
        if( !isset($_SESSION['reg_username']) && !isset($_SESSION['Gname'])) { ?>
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
                <div class="google-btn">
                    <a href="<?=$client->createAuthUrl(); ?>" btn btn-primary btn-block btn-large >
                        <div class="google-icon-wrapper">
                            <img class="google-icon" src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg"/>
                        </div>
                        <p class="btn-text"><b>Sign in with google</b></p>
                    </a>
                </div>
            </form>
        </div>
    <?php }elseif( isset($_SESSION['reg_username']) ){?>
        <div class="loggedin">
        <h1>You are Logged in!</h1>
        <form action="includes/logout.inc.php" method="POST">
            <button type="submit" name="logout" class="btn btn-primary btn-block btn-large">Logout</button>
        </form>
        </div>
       <?php }
       else{
            'You are not logged in';
        }
        if (isset($_SESSION['Gname'])) {?>
            <div class="loggedin">
            <img src="<?php echo $_SESSION['Gdp']; ?>" alt="<?php echo $_SESSION['Gname'];?>">
            <h1>Welcome <?php echo $_SESSION['Gname']; ?> </h1>
            <p>You are Logged in by using your Google Account <?php echo $_SESSION['Gemail'];?></p>
            <form action="includes/logout.inc.php" method="POST">
                <button type="submit" name="logout_submit" class="btn btn-primary btn-block btn-large">Logout</button>
            </form>
        </div>            
   <?php }
    ?>
</body>
</html>