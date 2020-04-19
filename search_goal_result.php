<?php
    require 'header.php';
?>

<style>
    .content-table {
        border-collapse: collapse;
        margin: 25px 0;
        font-size: 0.9em;
        min-width: 400px;
        border-radius: 5px 5px 0 0;
        overflow: hidden;
        box-shadow: 0 0 20px rgba(0,0,0,0.15);
        margin-left:auto;
        margin-right:auto;
    }

    .content-table thead tr {
        background-color: #009897;
        color: #ffffff;
        text-align: left;
        font-weight: bold;
    }

    .content-table th,
    .content-table td {
        padding: 12px 15px;
    }

    .content-table tbody tr {
        border-bottom: 1px solid #dddddd;
    }

    .content-table tbody tr:nth-of-type(odd) {
        background-color: #ffffff;
    }

    .content-table tbody tr:nth-of-type(even) {
        background-color: #f3f3f3;
    }

    .content-table tbody tr:last-of-type {
        border-bottom: 3px solid #009897;
    }

</style>

<body>

<?php
    
    
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
<table class="content-table">
    <thead>
        <tr>
            <th>User</th>
            <th>Goal ID</th>
            <th>Goal name</th>
            <th>Description</th>
            <th>Subtask</th>
            <th>End date</th>
            <th>Start time</th>
            <th>End time</th>
            <th>Report this goal to admin</th>
        </tr>
    </thead>

    <tbody>
<?php while($row = $search_result->fetch_assoc()) { ?>


<tr>
    <td><?php echo '<a href="profile_view_others.php?username='.$row['username'].'">'.$row['username'].'</a>'; ?></td>
    <td><?php echo $row['goal_id']; ?></td>
    <td><?php echo $row['goal_name']; ?></td>
<td><? echo ($row['goal_description']==''? "-" : $row['goal_description']); ?></td>
<td><? echo ($row['goal_subtask']==''? "-" : $row['goal_subtask']); ?></td>
    <td><?php echo $row['goal_enddate']; ?></td>
    <td><?php echo (($row['goal_starttime'] != NULL)? date("H:i", strtotime($row['goal_starttime'])) : '-'); ?></td>
    <td><?php echo (($row['goal_endtime'] != NULL)? date("H:i", strtotime($row['goal_endtime'])) : '-'); ?></td>
    
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

</tbody>
</table>
<?php
    } else
    echo "No results";
    ?>
</body>
