<?php

session_start();
//$username = $_SESSION['userUid'];
$username = $_SESSION['username'];
require 'db_key.php';
$conn = connect_db();
if (isset($_POST["finish-edit-profile-submit"])) {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $welcomeMessage = $_POST['welcome_message'];
    
    $firstName = mysqli_real_escape_string($conn, $firstName);
    $lastName = mysqli_real_escape_string($conn, $lastName);
    $welcomeMessage = mysqli_real_escape_string($conn, $welcomeMessage);
    
    $sql = "Update login Set first_name = '$firstName', last_name = 'lastName', welcome_message = '$welcomeMessage' Where username = '$username'";
    $sql = $conn->query($sql);
    
    header("Location: ../user_profile.php?profile=profileupdated");

}

/*
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
                    //$sql = "UPDATE users SET first_name=? WHERE uidUsers=?;";
                    $sql = "UPDATE login SET first_name=? WHERE username=?;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)){
                        echo "There was an error!";
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "ss", $firstName, $username); 
                        mysqli_stmt_execute($stmt);
                    }

                    //$sql = "UPDATE users SET last_name=? WHERE uidUsers=?;";
                    $sql = "UPDATE login SET last_name=? WHERE username=?;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)){
                        echo "There was an error!";
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "ss", $lastName, $username); 
                        mysqli_stmt_execute($stmt);
                    }

                    //$sql = "UPDATE users SET welcome_message=? WHERE uidUsers=?;";
                    $sql = "UPDATE login SET welcome_message=? WHERE username=?;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)){
                        echo "There was an error!";
                        exit();
                    } else {
                        mysqli_stmt_bind_param($stmt, "ss", $welcomeMessage, $username); 
                        mysqli_stmt_execute($stmt);
                    }

                    header("Location: ../user_profile.php?profile=profileupdated");

                }
        } */








?>
