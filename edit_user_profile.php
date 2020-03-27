<?php
require 'header.php';
if (isset($_POST['edit-profile-submit'])){

    //$username = $_SESSION['userUid'];
    $username = $_SESSION['username'];

    if( !isset( $_SESSION['username']) ){
    //if( !isset( $_SESSION['userUid']) ){
        echo "You are not authorized to view this page. Go back <a href= '/'>home</a>";
        exit();
    }
    require 'includes/dbh.inc.php';
    //require 'dbh.inc.php';

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
                echo "There was an error.";
                exit();

            } else {   
        ?>

            <tr>
                <td><?php echo "Username: ".$row['username']; ?></br></br></td> <!-- change to username -->
                <td><?php echo "Email: ".$row['email']; ?></br></br></td>  <!-- change to email -->
            </tr>

            <form action = 'includes/edit_user_profile.inc.php' method = 'POST'>

            <label>First name:</label>
            <input class = 'form-control w-50' type="text" <?php if ($row['first_name'] != NULL) 
            {?> value= "<?php echo $row['first_name']; ?>" <?php } else {
            ?> placeholder="Enter your first name" <?php } 
                ?> name="first_name"></br></br>

            <label>Last name:</label>
            <input class = 'form-control w-50' type="text" <?php if ($row['last_name'] != NULL) 
            {?> value= "<?php echo $row['last_name']; ?>" <?php } else {
            ?> placeholder="Enter your last name" <?php } 
                ?> name="last_name"></br></br>

            <label>Welcoming message:</label>
            <input class = 'form-control w-200' type="text" <?php if ($row['welcome_message'] != NULL) 
            {?> value= "<?php echo $row['welcome_message']; ?>" <?php } else {
            ?> placeholder="Enter your welcoming message" <?php } 
                ?> name="welcome_message"></br></br>

            <button type="submit" name="finish-edit-profile-submit">Finish editing</button>
            </form>

<?php
            }
        }
    }

    /*else {
        header("Location: ../user_profile.php");
        exit();
    }
    */
?>
