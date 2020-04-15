<?php
    require 'header.php';
    if( !isset( $_SESSION['username']) ){
        echo "You are not authorized to view this page. Go back <a href= '/'>home</a>";
        exit();
    }
    $goal_id = $_GET['goal_id'];
    require 'db_key.php';
    $conn = connect_db();
    $sql = "Select * from goals Where goal_id = '$goal_id'";
    $search_result = $conn->query($sql);
    $row = $search_result->fetch_assoc();
    if ($row['username'] == $_SESSION['username']) {
        $_SESSION['goal_id'] = $goal_id;
        ?>

<body>
<form action = 'goal_backend.php' method = 'POST'>
<div class = 'p-5 m-5'>
<div class="form-group">
<label>Goal name:</label>
<input class = 'form-control w-50' type="text" value="<?php echo $row['goal_name']; ?>" name="goal_name" required>

<label>Description (Optional):</label>
<input class = 'form-control w-50' type="text" <?php if ($row['goal_description'] != NULL) {?> value= "<?php echo $row['goal_description']; ?>" <?php } ?> name="goal_description">

<label>Sub-task (Optional):</label>
<input class = 'form-control w-50' type="text" <?php if ($row['goal_subtask'] != NULL) {?> value= "<?php echo $row['goal_subtask']; ?>" <?php } ?> name="goal_subtask">

<label>Number of days left:</label><br>
<input type="number" name="duration" min="0" value="<?php echo ceil((strtotime($row['goal_enddate'])-time())/60/60/24)?>"><br>
<label>day(s) (Current end date: <?php echo $row['goal_enddate']; ?>, <?php echo ceil((strtotime($row['goal_enddate'])-time())/60/60/24)?> days from today)<br>

<label>Time (Optional) (Please input the time in the form of hh:mm):</label><br>
<input type="number" <?php if ($row['goal_starttime'] != NULL) {?> value= <?php echo date("H", strtotime($row['goal_starttime'])); }?> name="goal_starttime_hh" min="0" max="23">
<label>:</label>
<input type="number" <?php if ($row['goal_starttime'] != NULL) {?> value= <?php echo date("i", strtotime($row['goal_starttime'])); }?> name="goal_starttime_mm" min="0" max="59">
<label> to </label>
<input type="number" <?php if ($row['goal_endtime'] != NULL) {?> value= <?php echo date("H", strtotime($row['goal_endtime'])); }?> name="goal_endtime_hh" min="0" max="23">
<label>:</label>
<input type="number" <?php if ($row['goal_endtime'] != NULL) {?> value= <?php echo date("i", strtotime($row['goal_endtime'])); }?> name="goal_endtime_mm" min="0" max="59"><br>

<input type="checkbox" name="goal_public" <? echo ($row['goal_public']? "checked":""); ?>>
<label for="goal_public">Allow other users to view this goal</label><br>

<div class ='text-center mt-3 w-50'>
<button class = 'btn btn-outline-info' type = 'submit' value = 'submit' name= 'edit_goal'>Submit</button>

</div>
</div>
</div>
</form>
</div>
</body>
</html>


<?php
    } else echo "This is not a goal set up by this account. Please re-try. Click here to go back to ".'<a href="mygoals.php">My Goals List</a>'.".";
    ?>


