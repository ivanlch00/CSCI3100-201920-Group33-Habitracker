<?php
    require 'header.php';
    
    if( !isset( $_SESSION['username']) ){
        echo "You are not authorized to view this page. Go back <a href= '/'>home</a>";
        exit();
    }
    
    require 'db_key.php';
    $conn = connect_db();
    $goal_keyword = $_POST['goal_keyword'];
    $sql = "Select * from goals Where goal_name Like '%$goal_keyword%' and goal_public = True";
    $search_result = $conn->query($sql);
    
    ?>


<div><h1>Search results</h1></div>
<div><h4>Keyword: <?php echo "$goal_keyword"; ?></h4></div>


<?php
    if ($search_result->num_rows >0) {
        ?>
<table border= 1px solid cellpadding="4">
<tr>
<th bgcolor="#CCCCCC">User</th>
<th bgcolor="#CCCCCC">Goal ID</th>
<th bgcolor="#CCCCCC">Goal name</th>
<th bgcolor="#CCCCCC">Description</th>
<th bgcolor="#CCCCCC">Subtask</th>
<th bgcolor="#CCCCCC">End date</th>
<th bgcolor="#CCCCCC">Start time</th>
<th bgcolor="#CCCCCC">End time</th>
<th bgcolor="#CCCCCC">Report this goal to admin</th>
</tr>

<?php while($row = $search_result->fetch_assoc()) { ?>
<tr>
<td><?php echo '<a href="profile_view_others.php?username='.$row['username'].'">'.$row['username'].'</a>'; ?></td>
<td><?php echo $row['goal_id']; ?></td>
<td><?php echo $row['goal_name']; ?></td>
<td><?php echo $row['goal_description']; ?></td>
<td><?php echo $row['goal_subtask']; ?></td>
<td><?php echo $row['goal_enddate']; ?></td>
<td><?php echo (($row['goal_starttime'] != NULL)? date("H:i", strtotime($row['goal_starttime'])) : ''); ?></td>
<td><?php echo (($row['goal_endtime'] != NULL)? date("H:i", strtotime($row['goal_endtime'])) : ''); ?></td>
    
<?php 
    if ($row['username'] == $_SESSION['username']) {
        echo '<td>-</td>';
    }
    else {
        echo '<td><a href="report_goal.php?id='.$row['goal_id'].'">Click Here</a></td>';
    }
?>
    
    
</tr>
<?php } ?>
</table>
<?php
    } else
    echo "No results";
    ?>
