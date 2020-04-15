<?php
session_start();
//include_once 'db_key.php';
require 'db_key.php';
$conn = connect_db();
$id = $_SESSION['user_id'];

if(isset($_POST['submit'])){
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));
    
    $allowed = array('jpg','jpeg','png','pdf');

    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if ($fileSize < 500000){
                $fileNameNew = "profile".$id.".".$fileActualExt;
                $fileDestination = 'upload_image/'.$fileNameNew;
                move_uploaded_file($fileTmpName, $fileDestination);
                $sql = "UPDATE login SEt image_status=0 WHERE user_id = '$id';";
                $search_result = $conn->query($sql);
                echo "Your profile picture is uploaded";
                header("Location: profile_display.php?uploadsuccess");

            } else {
                echo "Your file is too big!";
            }

        } else {
            echo "There was an error uploading your file!";
        }

    } else {
        echo 
        "You cannot upload files of this type!";
    }
}


