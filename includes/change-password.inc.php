<?php

session_start();
$username = $_SESSION['username'];
//$username = $_SESSION['userUid'];

if (isset($_POST["change-password-submit"])) {
    $existPassword = $_POST["exist-pwd"];
    $newPassword = $_POST["new-pwd"];
    $repeatPassword = $_POST["repeat-pwd"];
   
    if (empty($existPassword) || empty($newPassword) || empty($repeatPassword) ) {
        header("Location: ../change-password.php?changepwd=empty");
        exit();

    } else if ($newPassword != $repeatPassword) {
        header("Location: ../change-password.php?changepwd=pwdnotsame");
        exit();
    }

    require 'dbh.inc.php';

    //$sql = "SELECT * FROM users WHERE uidUsers=?;";
    $sql = "SELECT * FROM login WHERE username=?;";
    $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            echo "There was an error!";
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "s", $username); 
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);

            if (!$row = mysqli_fetch_assoc($result)) { 
                echo "You need to re-submit your reset request.";
                exit();

            } else {
                $passwordCheck = password_verify($existPassword, $row["password"]);
                //$passwordCheck = password_verify($existPassword, $row["pwdUsers"]);
                if ($passwordCheck === false){
                    
                    header("Location: ../change-password.php?changepwd=wrongpwd");
                    exit();
                } else if ($passwordCheck === true){

                    $sql = "UPDATE login SET password=? WHERE username=?;";
                    //$sql = "UPDATE users SET pwdUsers=? WHERE uidUsers=?;";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)){
                            echo "There was an error!";
                            exit();
                        } else {
                            $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newPasswordHash, $username); 
                            mysqli_stmt_execute($stmt);
                            header("Location: ../change-password.php?changepwd=passwordupdated");
                    
                        }
                }
            }
        }
    }



?>
