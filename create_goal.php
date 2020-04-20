<?php
    require 'header.php';
?>
<html>
<head>
    <title>Create goal</title>
    <link rel="stylesheet" href="create_goal.css">

</head>

<body>
<?php
    if( !isset( $_SESSION['username']) ){
        echo "You are not authorized to view this page. Go back <a href= '/'>home</a>";
        exit();
    }
    
?>
<div class="loginbox">
<div>
<div><h1>Create goal</h1></div>
<div><h3>- <?php echo $_SESSION['username']?>, keep going and create a goal now!(ง •̀_•́)ง</h3></div>
</div>
<form action = 'goal_backend.php' method = 'POST'>

<label>Goal name:</label>
<input class = 'form-control w-50' type="text" name="goal_name" required><br><br>

<label>Description (Optional):</label>
<input class = 'form-control w-50' type="text" name="goal_description"><br><br>

<label>Sub-task (Optional):</label>
<input class = 'form-control w-50' type="text" name="goal_subtask"><br><br>

<label>Duration: </label>
<input type="number" name="duration" min="0">
<label>day(s) (Recommended: 21 days, until <?php echo date("Y M d", strtotime("+21 days")) ?>)</label><br><br>

<label>Time (Optional) (Please input the time in the form of hh:mm):<br/></label>
<input type="number" name="goal_starttime_hh" min="0" max="23">
<label>:</label>
<input type="number" name="goal_starttime_mm" min="0" max="59">
<label> to </label>
<input type="number" name="goal_endtime_hh" min="0" max="23">
<label>:</label>
<input type="number" name="goal_endtime_mm" min="0" max="59"><br><br>

<input type="checkbox" name="goal_public">
<label for="goal_public">Allow other users to view this goal</label><br><br>


<button class = 'btn btn-outline-info' type = 'submit' value = 'submit' name= 'create_goal'>Submit</button>


</form>
</div>
</body>
</html>


