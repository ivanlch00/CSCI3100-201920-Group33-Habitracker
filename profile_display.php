<html>
    <head>
    <title>Profile Card design</title>
    <link rel="stylesheet" href="profile_display.css">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
<body>

<?php
    session_start();
    require 'header.php';

    $username = $_SESSION['username'];
   
    if( !isset( $_SESSION['username']) ){

        echo "You are not authorized to view this page. Go back <a href= '/'>home</a>";
        exit();
    }
    
    require 'db_key.php';
    $conn = connect_db();
    $sql = "Select * from login Where username = '$username'";
    $search_result = $conn->query($sql);
    $row = $search_result->fetch_assoc();
    $id = $row['user_id'];
?>
    <div class="profile-card">
        <div class="image-container">
        <?php 
        echo "<div>";
        if ($row['image_status'] == 0){
            echo "<img src='upload_image/profile".$id.".jpg' width ='200'>";
        } else if ($row['image_status'] == 1){
            echo "<img src='upload_image/profiledefault.jpg' width ='200'>";
        }
        echo "</div>";
        ?>
            <div class="title">
                <h2><?php echo "Username: ".$row['username']; ?></h2>
            </div>   
        </div>
        <div class="main-container">
            <p><i class="fa fa-envelope"></i><?php echo "Email: ".$row['email'];?></p>

            <p><i class="fa fa-star info"></i><?php
                if (isset($row['first_name'])){
                    echo "First name: ".$row["first_name"];
                }
                    else 
                        echo "First name: ";?></p>

            <p><i class="fa fa-star-o info"></i><?php
                if (isset($row['last_name'])){
                    echo "Last name: ".$row["last_name"];
                }
                    else 
                        echo "Last name: ";?></p>

            <p><i class="fa fa-heart info"></i><?php
                if (isset($row['welcome_message'])){
                    echo "Welcoming message: ".$row["welcome_message"];
                    echo "<br>";
                }
                    else 
                        echo "Welcoming message: ";?></p>
            <hr>
            <form action="profile_edit.php" method="post"> 
            <button class="edit_profile" type="submit" name="edit-profile-submit">Edit your profile</button>
            </form>
            <?php

            if (isset($_GET['profile'])){    //use $_GET to check the url
                if ($_GET['profile'] == "profileupdated") {
                echo '<p> Your profile is updated!</p>';
            }
            }
         ?>
        </div>
    </div>
</body>
