<html>
    <head>
    <link rel="stylesheet" href="login_style.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: url('img/login_bg3.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
</head>

<body>
    <img src="img/logo.png" alt="Habitracker" height="50">
    <div class="loginbox">
        <img src="img/login_avatar1.png" class="avatar">
            <h1>Login Here</h1> 
            <?php 
                session_start();
                if (!isset($_SESSION['user_id'])){
                    echo '<form action="includes/login.inc.php" method="post">
                    <p>Username/E-mail</p> 
                    <input type="text" name ="mailuid" placeholder="Enter Username/E-mail">
                    <p>Password</p>
                    <input type="password" name ="pwd" placeholder="Enter Password">
                    <button type="submit" name="login-submit">Login</button>
                    <a href="signup.php">Signup</a><br>
                    <a href="reset-password.php">Forgot your password?</a><br>
                    <a href="admin_login.php">Login as administrator</a>
                    </form>';
                } else {
                    echo '<form action="includes/logout.inc.php" method="post">
                    <button type="submit" name="logout-submit">Logout</button></br></br>
                    </form>';
                }  

                if (isset($_GET['error'])){  
                    if ($_GET['error'] == "wrongpwd") {
                        echo '<p class="wrong"> Wrong username or password!</p>';
                    }
                    else if ($_GET['error'] == "emptyfields") {
                        echo '<p class="wrong"> Fill in all fields!</p>';
                    }
                    else if ($_GET['error'] == "nouser") {
                        echo '<p class="wrong"> Wrong username or password!</p>';
                    }
                }

                if (isset($_GET["newpwd"])) {
                    if ($_GET["newpwd"] == "passwordupdated") {
                        echo '<p>Your password has been reset!</p>';
                    }
                }
            ?>   
    </div>

    <?php
        

    ?>

    </body>
</html>
