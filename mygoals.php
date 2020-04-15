<?php
    require 'header.php';
    
    if( !isset( $_SESSION['username']) ){
        echo "You are not authorized to view this page. Go back <a href= '/'>home</a>";
        exit();
    }
    
    require 'db_key.php';
    $conn = connect_db();
    $username = $_SESSION['username'];
    $sql = "Select * from goals Where username = '$username'";
    $search_result = $conn->query($sql);
    
    if (isset($_GET['create_goal'])){
        echo '<p>Goal created.</p>';
    };
    
    if (isset($_GET['edit_goal'])){
        echo '<p>Goal updated.</p>';
    };
    
    if (isset($_GET['delete_goal'])){
        echo '<p>Goal deleted.</p>';
    };
    
    ?>

<div><h1 align=center>My Goals List</h1></div>

<?php
    if ($search_result->num_rows >0) {
        ?>
<table border= 1px solid cellpadding="4">
<tr>
<td bgcolor="#CCCCCC"><strong>Goal ID</strong></td>
<td bgcolor="#CCCCCC"><strong>Goal name</strong></td>
<td bgcolor="#CCCCCC"><strong>Description</strong></td>
<td bgcolor="#CCCCCC"><strong>Subtask</strong></td>
<td bgcolor="#CCCCCC"><strong>End date</strong></td>
<td bgcolor="#CCCCCC"><strong>Start time</strong></td>
<td bgcolor="#CCCCCC"><strong>End time</strong></td>
<td bgcolor="#CCCCCC"><strong>Visible by other users</strong></td>
<td bgcolor="#CCCCCC"><strong>Edit this goal</strong></td>
<td bgcolor="#CCCCCC"><strong>Delete this goal</strong></td>
</tr>

<?php while($row = $search_result->fetch_assoc()) { ?>
<tr>
<td><? echo $row['goal_id']; ?></td>
<td><? echo $row['goal_name']; ?></td>
<td><? echo $row['goal_description']; ?></td>
<td><? echo $row['goal_subtask']; ?></td>
<td><? echo $row['goal_enddate']; ?></td>
<td><? echo (($row['goal_starttime'] != NULL)? date("H:i", strtotime($row['goal_starttime'])) : ''); ?></td>
<td><? echo (($row['goal_endtime'] != NULL)? date("H:i", strtotime($row['goal_endtime'])) : ''); ?></td>
<td><? echo ($row['goal_public']? "Yes":"No"); ?></td>
<td><?php echo '<a href="edit_goal.php?goal_id='.$row['goal_id'].'">Edit</a>'; ?></td>
<td><?php echo '<a href="delete_goal.php?goal_id='.$row['goal_id'].'">Delete</a>'; ?></td>
</tr>
<?php } ?>

</table>
<?php
    } else
    echo "No results";
    ?>


