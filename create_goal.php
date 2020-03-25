<?php
    session_start();
    if( !isset( $_SESSION['username']) ){
        echo "You are not authorized to view this page. Go back <a href= '/'>home</a>";
        exit();
    }
    require 'header.php'
    ?>
<body>
<div class = 'container'>
<div>
<div><h1>Welcome to the Goal Creation Page, <?php echo $_SESSION['username'] ?></h1></div>
</div>
<form action = 'goal_backend.php' method = 'POST'>
<div class = 'p-5 m-5'>
<div class="form-group">
<label>Goal name:</label>
<input class = 'form-control w-50' type="text" name="goal_name" required>

<label>Description (Optional):</label>
<input class = 'form-control w-50' type="text" name="goal_description">

<label>Sub-task (Optional):</label>
<input class = 'form-control w-50' type="text" name="goal_subtask">

<label>Duration: </label><br>
<input type="number" name="duration" min="1">
<label>day(s) (Recommended: 21 days, until <?php echo date("Y M d", strtotime("+21 days")) ?>)</label><br>

<label>Time (Optional) (Please input the time in the form of hh:mm):</label><br>
<input type="number" name="goal_starttime_hh" min="0" max="23">
<label>:</label>
<input type="number" name="goal_starttime_mm" min="0" max="59">
<label> to </label>
<input type="number" name="goal_endtime_hh" min="0" max="23">
<label>:</label>
<input type="number" name="goal_endtime_mm" min="0" max="59"><br>

<input type="checkbox" name="goal_public">
<label for="goal_public">Allow other users to view this goal</label><br>

<div class ='text-center mt-3 w-50'>
<button class = 'btn btn-outline-info' type = 'submit' value = 'submit' name= 'create_goal'>Submit</button>
</div>
</div>
</div>
</form>
</div>
</body>
</html>


