<?php
    require "header.php";
    if( !isset( $_SESSION['username']) ){
        echo "You are not authorized to view this page. Go back <a href= '/'>home</a>";
        exit();
    } else {
    ?>

    <main>
    <h1>Change password</h1>
            <form action="includes/change-password.inc.php" method="post">
            <input type="password" name="exist-pwd" placeholder="Enter your existing password">
            <input type="password" name="new-pwd" placeholder="Enter a new password..">
            <input type="password" name="repeat-pwd" placeholder="Repeat new password">
            <button type="submit" name="change-password-submit">change password</button>

            </form>

    <?php
        if (isset($_GET['changepwd'])){    //use $_GET to check the url
            if ($_GET['changepwd'] == "empty") {
                echo '<p> Fill in all fields!</p>';
            }
            else if ($_GET['changepwd'] == "pwdnotsame") {
                echo '<p>Your new password and your confirmation password do not match</p>';
            }
            else if ($_GET['changepwd'] == "passwordupdated") {
                echo '<p>Your password is updated</p>';
            }
        }
    }
?>

</main>

<?php
    require "footer.php";
?>
