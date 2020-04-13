<?php

if (isset($_POST["reset-password-submit"])) {

    $selector = $_POST["selector"];
    $validator = $_POST["validator"];
    $password = $_POST["pwd"];
    $passwordRepeat = $_POST["pwd-repeat"]; //get the variable name in create new password.php

    if (empty($password) || empty($passwordRepeat)) {
        header("Location: ../create-new-password.php?newpwd=empty&selector=$selector&validator=$validator");
        //header("Location: ../create-new-password.php?newpwd=empty" . $selector . "&validator=" . bin2hex($token));
        exit(); //this wont work since the tokens aren't included! either include the tokens in the URL, or just send them to the signup page and ask them to start over.
    
    } else if ($password != $passwordRepeat) {
        header("Location: ../create-new-password.php?newpd=pwdnotsame&selector=$selector&validator=$validator");
        exit();
    }

    $currentDate = date("U");
    
    require 'dbh.inc.php';

    $sql = "SELECT * FROM pwdreset WHERE pwdResetSelector=? AND pwdResetExpires >= ?;"; // replace the ? by the data input by user (data bind to statement)
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        echo "There was an error!";
        exit();
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $selector, $currentDate); 
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        if (!$row = mysqli_fetch_assoc($result)) {    //insert data into the associated array so we can refer to data by column names
            echo "You need to re-submit your reset request.";
            exit();
        } else {

            $tokenBin = hex2bin($validator);
            $tokenCheck = password_verify($tokenBin, $row["pwdResetToken"]);

            if ($tokenCheck === false) {
                echo "You need to re-submit your reset request.";
                exit();
            } else if ($tokenCheck === true) {
                $tokenEmail = $row['pwdResetEmail'];

                //$sql = "SELECT * FROM users WHERE emailUsers=?;";
                $sql = "SELECT * FROM login WHERE email=?;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)){
                    echo "There was an error!";
                    exit();
                } else {
                    mysqli_stmt_bind_param($stmt, "s", $tokenEmail); //input data into the place holder '?'
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    if (!$row = mysqli_fetch_assoc($result)) {    //insert data into the associated array so we can refer to data by column names
                        echo "There was an error!";
                        exit();
                    } else {

                        //$sql = "UPDATE users SET pwdUsers=? WHERE emailUsers=?;"; // update password from user table, matching both emails
                        $sql = "UPDATE login SET password=? WHERE email=?;";
                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)){
                            echo "There was an error!";
                            exit();
                        } else {
                            $newPwdHash = password_hash($password, PASSWORD_DEFAULT);
                            mysqli_stmt_bind_param($stmt, "ss", $newPwdHash, $tokenEmail); 
                            mysqli_stmt_execute($stmt);

                            $sql = "DELETE FROM pwdreset WHERE pwdResetEmail=?;";
                            $stmt = mysqli_stmt_init($conn);
                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "There was an error!";
                                exit();
                            }
                            else {
                                mysqli_stmt_bind_param($stmt, "s", $tokenEmail);
                                mysqli_stmt_execute($stmt);
                                header("Location: ../login.php?newpwd=passwordupdated");
                            }

                }
            }
        }
    }
    
    }

}
} else {
    header("Location: ../index.php");
}