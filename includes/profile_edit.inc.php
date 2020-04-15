<?php

session_start();
$username = $_SESSION['username'];
//$username = $_SESSION['username'];
?>


<?php

if(!isset($_SESSION['username'])){
    echo "You are not authorized to view this page. Go back <a href= '/'>home</a>";
    exit();

} else if($_POST){
    require 'db_key.php';
    $conn = connect_db();

if (isset($_POST["finish-edit-profile-submit"])) {
    $firstName = $_POST["first_name"];
    $lastName = $_POST["last_name"];
    $welcomeMessage = $_POST["welcome_message"];
    $firstName = mysqli_real_escape_string($conn, $firstName);
    $lastName = mysqli_real_escape_string($conn, $lastName);
    $welcomeMessage = mysqli_real_escape_string($conn, $welcomeMessage);

    $sql = "Update login Set first_name = '$firstName',last_name = '$lastName',welcome_message = '$welcomeMessage' where '$username' = username";
    $sql = $conn->query($sql);
    if($sql){
        //echo "Profile updated. You may <a href=profile_display.php>view your profile</a> now";
        header("Location: ../profile_display.php?profile=profileupdated");
    }
}
    

}
        
?>