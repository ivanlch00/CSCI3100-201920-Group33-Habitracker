<?php
    require 'header.php';
?>

<html>
<head>
<title>Edit your profile</title>
<link rel="stylesheet" href="profile_edit.css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>


<?php
    if (isset($_POST['edit-profile-submit'])){

    $username = $_SESSION['username'];
    //$username = $_SESSION['username'];

    //if( !isset( $_SESSION['username']) ){
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


    

        <div class="loginbox">

        <div class="image-container">

    <?php
    echo "<div>";
    if ($row['image_status'] == 0){
        echo "<img src='upload_image/profile".$id.".jpg' width ='200'>";
    } else if ($row['image_status'] == 1){
        echo "<img src='upload_image/profiledefault.jpg' width ='200'>";
    }
    echo "</div>";
    
    echo "<form action='profile_upload_img.php' method='POST' enctype='multipart/form-data'>
    <input type='file' name='file'>
    <button type='submit1' name='submit'>UPLOAD</button>
    </form>";

    ?>
    </div>
     
            <form action="includes/profile_edit.inc.php" method="post"> 
            <div class="edit-display">
            <tr>
                </br>
                <td><?php echo "Username: ".$row['username']; ?></br></br></td> <!-- change to username -->
                <td><?php echo "Email: ".$row['email']; ?></br></br></td>  <!-- change to email -->             
            </tr>
            
            <label>First name:</label>
            <input class = 'form-control w-50' type="text" <?php if ($row['first_name'] != NULL) 
            {?> value= "<?php echo $row['first_name']; ?>" <?php } else {
            ?> placeholder="Enter your first name" <?php } 
                ?> name="first_name"></br>

            <label>Last name: </label>
            <input class = 'form-control w-50' type="text" <?php if ($row['last_name'] != NULL) 
            {?> value= "<?php echo $row['last_name']; ?>" <?php } else {
            ?> placeholder="Enter your last name" <?php } 
                ?> name="last_name"></br>

            <label>Welcoming message:</label>
            <input class = 'form-control w-200' type="text" <?php if ($row['welcome_message'] != NULL) 
            {?> value= "<?php echo $row['welcome_message']; ?>" <?php } else {
            ?> placeholder="Enter your welcoming message" <?php } 
                ?> name="welcome_message"></br>

            
            <button class="finish_edit_profile" type="submit" name="finish-edit-profile-submit">Finish editing</button>
            </div>
            </form>
        </div>
<?php
}
    /*else {
        header("Location: ../user_profile.php");
        exit();
    }
    */
?>
</body>
