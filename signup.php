<?php
    require "header.php";
?>


    <main>
        <h1>Signup</h1>
        <?php
            if (isset($_GET['error'])){    //use $_GET to check the url
                if ($_GET['error'] == "emptyfields") {
                    echo '<p> Fill in all fields!</p>';
                }
                else if ($_GET['error'] == "invaliduidmail") {
                    echo '<p> Invalid username and e-mail!</p>';
                }
                else if ($_GET['error'] == "invaliduid") {
                    echo '<p> Invalid username! The username can only contain alphabets and numbers.</p>';
                }
                else if ($_GET['error'] == "invalidmail") {
                    echo '<p> Invalid e-mail!</p>';
                }
                else if ($_GET['error'] == "passwordcheck") {
                    echo '<p> The password and the re-entered password do not match. Please check.</p>';
                }
                else if ($_GET['error'] == "usertaken") {
                    echo '<p> Username is already taken!</p>';
                }
            }
            else if (isset($_GET['signup'])) {
                if ($_GET['signup'] == "success") {
                echo '<p> Signup successful</p>';
                }
            }

        ?>
        <form action="includes/signup.inc.php" method="post">
            <input type="text" name="uid" placeholder="Username">
            <input type="text" name="mail" placeholder="E-mail">
            <input type="password" name="pwd" placeholder="Password">
            <input type="password" name="pwd-repeat" placeholder="Confirm password">
            <button type="submit" name="signup-submit">Signup</button>
        </form>

        <?php
        if (isset($_GET["newpwd"])) {
            if ($_GET["newpwd"] == "passwordupdated") {
                echo '<p>Your password has been reset!</p>';
            }
        }
        ?>
        <a href="reset-password.php">Forgot your password?</a>
    </main>

<?php
    require "footer.php";
?>
