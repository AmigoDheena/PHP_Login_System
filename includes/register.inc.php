<?php
session_start();
if (isset($_POST['reg_submit'])) {
    require 'dbh.inc.php';
    $reg_username = $_POST['reg_username'];
    $reg_email = $_POST['reg_email'];
    $reg_pwd = $_POST['reg_pwd'];
    $reg_repeat_pwd = $_POST['reg_repeat_pwd'];

    if (empty($reg_username) || empty($reg_email) || empty($reg_pwd) || empty($reg_repeat_pwd) ) {
        $_SESSION['message'] = "Empty Field not allowed!"; 
        $_SESSION['message_type'] = 'error';
        header("Location: ../register.php?error=emptyField");
    }
    elseif (!filter_var($reg_email, FILTER_VALIDATE_EMAIL) || !preg_match("/^[a-zA-Z0-9]+_?[a-zA-Z0-9]+$/D",$reg_username)) {
        $_SESSION['message'] = "Check your Username & Email!"; 
        $_SESSION['message_type'] = 'error';
        header("Location: ../register.php?error=ErrorUsernamePassword");
    }
    elseif (!filter_var($reg_email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Please enter Valid Email!"; 
        $_SESSION['message_type'] = 'error';
        header("Location: ../register.php?error=invalidEmail");
    }
    elseif (!preg_match("/^[a-zA-Z0-9]+_?[a-zA-Z0-9]+$/D",$reg_username)) {
        $_SESSION['message'] = "Please check your Username!"; 
        $_SESSION['message_type'] = 'error';
        header("Location: ../register.php?error=invalidUsername");
    }
    elseif ($reg_pwd !== $reg_repeat_pwd) {
        $_SESSION['message'] = "Password not match!"; 
        $_SESSION['message_type'] = 'error';
        header("Location: ../register.php?error=PassordNotMatch");
    }
    else {
        $sql = "SELECT reg_username FROM users WHERE reg_username=?";
        $stmt = mysqli_stmt_init($connect);
        if (!mysqli_stmt_prepare($stmt,$sql)) {
            $_SESSION['message'] = "SQL Select Error!"; 
            $_SESSION['message_type'] = 'error';
            header("Location: ../register.php?error=SQL_Error");
        }else {
            mysqli_stmt_bind_param($stmt,"s",$reg_username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0 ) {
                $_SESSION['message'] = "User Already Exist!"; 
                $_SESSION['message_type'] = 'error';
                header("Location: ../register.php?error=UsernameExists");
            }else {
                $sql = "INSERT INTO users(reg_username,reg_email,reg_pwd) VALUES(?,?,?)";
                $stmt = mysqli_stmt_init($connect);
                if (!mysqli_stmt_prepare($stmt,$sql)) {
                    $_SESSION['message'] = "SQL Insert Error!"; 
                    $_SESSION['message_type'] = 'error';
                    header("Location: ../register.php?error=SQL_Error");
                }else{
                    $hashPwd = password_hash($reg_pwd, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt,"sss",$reg_username,$reg_email,$hashPwd);
                    mysqli_stmt_execute($stmt);
                    $_SESSION['message'] = "Successfully Registed!"; 
                    $_SESSION['message_type'] = 'success';
                    header("Location: ../index.php?register=success");
                }

            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($connect);
}
// else {
//     header("Location: ../register.php");
// }