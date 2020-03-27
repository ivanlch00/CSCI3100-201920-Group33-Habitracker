<?php
    require 'header.php';

    //$username = $_SESSION['userUid'];
    $username = $_SESSION['username'];
    
    if( !isset( $_SESSION['username']) ){
    //if( !isset( $_SESSION['userUid']) ){

        echo "You are not authorized to view this page. Go back <a href= '/'>home</a>";
        exit();
    }
    
    require 'includes/dbh.inc.php';
    //require 'dbh.inc.php';

    $sql = "SELECT * FROM login WHERE username=?;";
    //$sql = "SELECT * FROM users WHERE uidUsers=?;";
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
                <td><?php echo "Username: ".$row['username']; ?></br></br></td>
                <td><?php echo "Email: ".$row['email']; ?></br></br></td>
            </tr>
            
            <?php
                if (isset($row['first_name']))
                {echo "First name: ".$row["first_name"] ?></br></br><?php ;}
                    else 
                        echo "First name: "?> </br></br> <?php ;

                if (isset($row['last_name'])) {
                    echo "Last name: ".$row["last_name"]?> </br></br> <?php ;
                } else
                        echo "Last name: "?> </br></br> <?php ;

                if (isset($row['welcome_message'])) {
                    echo "Welcoming message: ".$row["welcome_message"]?> </br></br> <?php ;
                } else
                        echo "Welcoming message: "?> </br></br> <?php ;

            ?>
             
             <form action="edit_user_profile.php" method="post"> 
             <button type="submit" name="edit-profile-submit">Edit your profile</button>

            
            <?php

            }
        }

        if (isset($_GET['profile'])){    //use $_GET to check the url
            if ($_GET['profile'] == "profileupdated") {
                echo '<p> Your profile is updatecd!</p>';
            }
        }
          
         ?>

    
