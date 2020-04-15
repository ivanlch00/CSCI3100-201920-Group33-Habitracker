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
<td bgcolor="#CCCCCC"><strong>User</strong></td>
<td bgcolor="#CCCCCC"><strong>Goal ID</strong></td>
<td bgcolor="#CCCCCC"><strong>Goal name</strong></td>
<td bgcolor="#CCCCCC"><strong>Description</strong></td>
<td bgcolor="#CCCCCC"><strong>Subtask</strong></td>
<td bgcolor="#CCCCCC"><strong>End date</strong></td>
<td bgcolor="#CCCCCC"><strong>Start time</strong></td>
<td bgcolor="#CCCCCC"><strong>End time</strong></td>
</tr>

<?php while($row = $search_result->fetch_assoc()) { ?>
<tr>
<td><?php echo '<a href="profile_view_others.php?username='.$row['username'].'">'.$row['username'].'</a>'; ?></td>
<td><? echo $row['goal_id']; ?></td>
<td><? echo $row['goal_name']; ?></td>
<td><? echo $row['goal_description']; ?></td>
<td><? echo $row['goal_subtask']; ?></td>
<td><? echo $row['goal_enddate']; ?></td>
<td><? echo (($row['goal_starttime'] != NULL)? date("H:i", strtotime($row['goal_starttime'])) : ''); ?></td>
<td><? echo (($row['goal_endtime'] != NULL)? date("H:i", strtotime($row['goal_endtime'])) : ''); ?></td>
</tr>
<?php } ?>
</table>
<?php
    } else
    echo "No results";
    ?>
