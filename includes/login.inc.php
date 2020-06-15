<?php
session_start();
require 'dbh.inc.php';
if (isset($_POST['login_submit'])) {
    $login_username = $_POST['login_username'];
    $login_pwd = $_POST['login_pwd'];

    if (empty($login_username) || empty($login_pwd)) {
        $_SESSION['message'] = "Empty Field not allowed!"; 
        $_SESSION['message_type'] = 'error';
        header("Location: ../index.php?error=emptyField");
    }else{
        $sql = "SELECT * FROM users WHERE reg_username=? OR reg_email=?;";
        $stmt = mysqli_stmt_init($connect);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            $_SESSION['message'] = "SQL Prepare Error!"; 
            $_SESSION['message_type'] = 'error';
            header("Location: ../index.php?error=SQLPrepareError");
        }else{
            mysqli_stmt_bind_param($stmt,"ss",$login_username,$login_username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdCheck = password_verify($login_pwd,$row['reg_pwd']);
                if ($pwdCheck == false) {
                    $_SESSION['message'] = "Wrong Password!"; 
                    $_SESSION['message_type'] = 'error';
                    header("Location: ../index.php?error=PWDVerifyErr");
                }elseif ($pwdCheck == true) {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['reg_username'] = $row['reg_username'];
                    $_SESSION['message'] = "Successfully Logged in!"; 
                    $_SESSION['message_type'] = 'success';
                    header("Location: ../index.php?success=LoggedIn");
                }else{
                    $_SESSION['message'] = "Password Verify Error!"; 
                    $_SESSION['message_type'] = 'error';
                    header("Location: ../index.php?error=PWDVerifyErr");
                }
            }else{
                $_SESSION['message'] = "Fetch Error!"; 
                $_SESSION['message_type'] = 'error';
                header("Location: ../index.php?error=FetchError");
            }
        }
    }
}