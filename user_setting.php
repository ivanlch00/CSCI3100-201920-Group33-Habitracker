<?php
    require 'header.php';
    if( !isset( $_SESSION['username']) ){
        echo "You are not authorized to view this page. Go back <a href= '/'>home</a>";
        exit();
    }
    
    if (isset($_GET['edit_setting'])){
        echo '<p>Settings saved.</p>';
    };
    
    $user_id = $_SESSION['user_id'];
    require 'db_key.php';
    $conn = connect_db();
    $sql = "Select * from login Where user_id = '$user_id'";
    $search_result = $conn->query($sql);
    $row = $search_result->fetch_assoc();
        ?>

<body>
<div><h1>Settings</h1></div>
<div><h2>Personalize services according to your needs</h2></div>
<form action = 'user_setting_backend.php' method = 'POST'>
<div class = 'p-5 m-5'>
<div class="form-group">


<input type="checkbox" name="receive_dailyreminder" <? echo ($row['receive_dailyreminder']? "checked":""); ?>>
<label for="receive_dailyreminder">Receive goal reminder daily via email</label><br>

<input type="checkbox" name="receive_weeklyreport" <? echo ($row['receive_weeklyreport']? "checked":""); ?>>
<label for="receive_weeklyreport">Receive weekly report via email</label><br>

<br>

<div class ='text-center mt-3 w-50'>
<button class = 'btn btn-outline-info' type = 'submit' value = 'submit' name= 'edit_setting'>Save</button>

</div>
</div>
</div>
</form>
</div>
</body>
</html>

