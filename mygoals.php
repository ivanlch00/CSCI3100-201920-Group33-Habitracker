<?php
    session_start();
    if( !isset( $_SESSION['username']) ){
        echo "You are not authorized to view this page. Go back <a href= '/'>home</a>";
        exit();
    }
    
    require 'db_key.php';
    $conn = connect_db();
    $username = $_SESSION['username'];
    $sql = "Select * from goals Where username = '$username'";
    $search_result = $conn->query($sql);
    require 'header.php';
    ?>

<table border="1" cellpadding="4">
        <tr>
        <td bgcolor="#CCCCCC"><strong>Goal ID</strong></td>
        <td bgcolor="#CCCCCC"><strong>Goal name</strong></td>
        <td bgcolor="#CCCCCC"><strong>Description</strong></td>
        <td bgcolor="#CCCCCC"><strong>Subtask</strong></td>
        <td bgcolor="#CCCCCC"><strong>End date</strong></td>
        <td bgcolor="#CCCCCC"><strong>Start time</strong></td>
        <td bgcolor="#CCCCCC"><strong>End time</strong></td>
        <td bgcolor="#CCCCCC"><strong>Visible by other users</strong></td>
        </tr>

        <?php while($row = $search_result->fetch_assoc()) { ?>
        <tr>
        <td><? echo $row['goal_id']; ?></td>
        <td><? echo $row['goal_name']; ?></td>
        <td><? echo $row['goal_description']; ?></td>
        <td><? echo $row['goal_subtask']; ?></td>
        <td><? echo $row['goal_enddate']; ?></td>
        <td><? echo $row['goal_starttime']; ?></td>
        <td><? echo $row['goal_endtime']; ?></td>
        <td><? echo ($row['goal_public']? "Yes":"No"); ?></td>
        </tr>
        <?php } ?>

</table>


