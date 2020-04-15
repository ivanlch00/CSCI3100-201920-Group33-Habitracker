<?php
    require 'header.php';
    
    if( !isset( $_SESSION['username']) ){
        echo "You are not authorized to view this page. Go back <a href= '/'>home</a>";
        exit();
    }
    
    require 'db_key.php';
    $conn = connect_db();
    $username = $_SESSION['username'];
    $today = date("Y-m-d", time());
    $sql = "Select * from goals Where username = '$username' and goal_enddate >= '$today'";
    $search_result = $conn->query($sql);
    
    if (isset($_GET['update_goal_completion'])){
        echo '<p>Progress today saved.</p>';
    };
?>

<div><h1 align=center>My Progress Today</h1></div>
<form action = 'goal_backend.php' method = 'POST'>
<div class = 'p-5 m-5'>
<div class="form-group">

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
        <td bgcolor="#CCCCCC"><strong>Completed today</strong></td>
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
        <td><input type="checkbox" name=<?php echo('"goal_completed_'.$row['goal_id'].'"'); ?> <? echo ($row['goal_completed']? "checked":""); ?>></td>
        </tr>
        <?php } ?>

    </table>

<div class ='text-center mt-3 w-50'>
<button class = 'btn btn-outline-info' type = 'submit' value = 'submit' name= 'update_goal_completion'>Save</button>

<?php
    } else
    echo "No results";
    ?>


