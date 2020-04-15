<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $title ?></title>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
		integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
        <script src="admin_backend.js"></script>
        
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <style>
        body {
            background-image: url('img/background.jpg');
            font-family: Arial, Helvetica, sans-serif;
        }

        .nav {
        overflow: hidden;
            background-color: #333;
        }

        .nav a {
            float: left;
            font-size: 16px;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .nav a: hover{
            background-color: blue;
        }

        .dropdownmenu {
            float: left;
            overflow: hidden;
        }

        .dropdownmenu .dropbutton {
            font-size: 16px;
            border: none;
            outline: none;
            color: white;
            padding: 14px 16px;
            background-color: inherit;
            font-family: inherit;
            margin: 0;
        }

        .nav a: hover, .dropdownmenu: hover .dropbutton {
            background-color: blue;
        }

        .dropdownmenu-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdownmenu-content a {
            float: none;
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdownmenu-content a: hover {
            background-color: #ddd;
        }

        .dropdownmenu:hover .dropdownmenu-content {
            display: block;
        }
        </style>
    </head>
<body>
<img src="img/logo.png" alt="Habitracker" height="50">
<div class="nav">
    <a href="admin_index.php">Home</a>
    <div class="dropdownmenu">
        <button class="dropbutton">Reports
            <i class="fa fa-caret-down"></i>
        </button>
        <div class="dropdownmenu-content">
            <a href="view_goal_reports.php">View goal reports</a>
            <a href="view_activity_reports.php">View activity reports</a>
        </div>
    </div>
    <a href="remove_user.php">Remove user</a>
    <a href="remove_goal.php">Remove goal</a>
    <a href="remove_activity.php">Remove activity</a>
</div>

<?php
session_start();
if (!isset($_SESSION['admin_username'])){
    echo '<a href="admin_login.php">Click here to log in as administrator!</a></br>';
} else {
 echo '<form action="includes/logout.inc.php" method="post">
 <button type="submit" name="logout-submit">Logout</button></br></br>
 </form>';
}

?>
