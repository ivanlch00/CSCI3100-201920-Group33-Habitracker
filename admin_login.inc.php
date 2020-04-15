<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['pwd'];

    if (empty($username) || empty($password)){
        echo 'empty';
    }
    else if ($username != "Admin" || $password != "csci3100"){
        echo 'fail';
    }
    else{
        session_start();
        $_SESSION['admin_username'] = $username;
        echo 'success';
    }
    exit();
}
else {
    header("Location: ../admin_index.php");
    exit();
}

?>