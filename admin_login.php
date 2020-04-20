<html>
    <head>
        <title>Administrator Login</title>
        <link rel="stylesheet" href="admin_login_style.css">
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"
		integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="admin_login.js"></script>
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

        <div class="bubbles">
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
            <div class="bubble"></div>
        </div>

        <img src="img/logo.png" alt="Habitracker" height="50">
        <div class="loginbox">
            <img src="img/login_avatar1.png" class="avatar">
            <h1>Login Here</h1>
            <?php 
                session_start();
                if (!isset($_SESSION['username'])){
                    echo '<form id="login" action="includes/admin_login.inc.php">
                    <p>Username</p> 
                    <input type="text" name="username" placeholder="Enter Username">
                    <p>Password</p>
                    <input type="password" name="pwd" placeholder="Enter Password">
                    <p id="errorMsg"></p>
                    <button type="submit" name="login-submit">Login</button>
                    <a href="login.php">Login as user</a>
                    </form>';
                } else {
                    echo '<form action="includes/logout.inc.php" method="post">
                    <button type="submit" name="logout-submit">Logout</button></br></br>
                    </form>';
                }  
            ?>   
        </div>
    </body>
</html>
