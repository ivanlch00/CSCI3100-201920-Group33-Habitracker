<?php

if (isset($_POST['login-submit'])) {
    require 'dbh.inc.php';

    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    if (empty($mailuid) || empty($password)){
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
    else {
        $sql = "SELECT * FROM login WHERE username=? OR email=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../index.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $mailuid, $mailuid);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $pwdcheck = password_verify($password, $row['password']);
                if ($pwdcheck == false){
                    header("Location: ../index.php?error=wrongpwd");
                    exit();
                }
                else if($pwdcheck == true){
                    session_start();
                    include('chatdatabase_connection.php');
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['username'] = $row['username'];
                    $sub_query = "
                    INSERT INTO login_details
                    (user_id)
                    VALUES ('".$row['user_id']."')
                    ";
                    $statement = $connect->prepare($sub_query);
                    $statement->execute();
                    $_SESSION['login_details_id'] = $connect->lastInsertId(); // return the value of last inserted id


                    header("Location: ../index.php?login=success");
                    exit();
                }
                else {
                    header("Location: ../index.php?error=wrongpwd");
                    exit();
                }
            }

            else {
                header("Location: ../index.php?error=nouser");
                exit();
            }
        }
    }

}
else {
    header("Location: ../index.php");
    exit();
}
