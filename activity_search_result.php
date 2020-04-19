<?php
    require 'header.php';
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['username'];
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
        background-color: #006f98;
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
        border-bottom: 3px solid #006f98;
    }

</style>

<body>

<?php
    
    function checkJoined($activityID,$user_id){
        $cnt=0;
        
        $conn = mysqli_connect("localhost","root","","Habitracker");
        if($user_id==NULL){
            header("Location: index.php?query=failed");
        }else{
            $sql = "SELECT * FROM activity_users_list WHERE  user_id = '$user_id' and activity_id = '$activityID'";
        }
        
        $result = mysqli_query($conn,$sql);
        while($row = mysqli_fetch_assoc($result)){
            $cnt++;
        }
        if($cnt==0){
            echo '<td><a href = "activity_join.php?id='.$activityID.'">Click Here</a> </td>';
        }else{
            echo '<td>Joined</td>';
        }
    }
    
    if( !isset( $_SESSION['username']) ){
        echo "You are not authorized to view this page. Go back <a href= '/'>home</a>";
        exit();
    }
    
    require 'db_key.php';
    $conn = connect_db();
    $activity_keyword = $_POST['activity_keyword'];
    $sql = "Select * from activity_table Where activity_name Like '%$activity_keyword%' and activity_status_open = '1'";
    $search_result = $conn->query($sql);
    
    ?>


<div><h1 align=center>Existing Activities</h1></div>
<h3>Search by keyword</h3>
<form action = 'activity_search_result.php' method = 'POST'>
<label>Keyword: </label>
<input class = 'form-control w-50' type="text" name="activity_keyword"><br><br>

<div class ='text-center mt-3 w-50'>
<button class = 'btn btn-outline-info' type = 'submit' value = 'submit' name= 'search_activity'>Search</button></br></br>
</form>

<div><h3>Search results</h3></div>
<div><h4>Keyword: <?php echo "$activity_keyword"; ?></h4></div>

<?php
    if ($search_result->num_rows >0) {
        ?>
<table class="content-table">
    <thead>
        <tr>
            <th>Activity ID</th>
            <th>Name</th>
            <th>Recurrence</th>
            <th>Date and time</th>
            <th>No. of days</th>
            <th>Day1</th>
            <th>Time1</th>
            <th>Day2</th>
            <th>Time2</th>
            <th>Day3</th>
            <th>Time3</th>
            <th>Creator</th>
            <th>Details</th>
            <th>Join</th>
            <th>Report inappropriate</th>
        </tr>
    </thead>

    <tbody>
<?php while($row = $search_result->fetch_assoc()) { ?>

<tr>
<td><?php echo $row['activity_id']; ?></td>
<td><?php echo $row['activity_name']; ?></td>
<td><?php echo ($row['activity_repetition']==0? "One-off" : "Recurring"); ?></td>
<td><?php echo ($row['activity_repetition']==0? date('yy-m-d H:i', strtotime($row['activity_one_off_datetime'])) : "-"); ?></td>

<td><?php echo ($row['activity_repetition']==0? "-" : $row['activity_repetition']); ?></td>

<td><?php echo ($row['activity_repetition']==0? "-" : $row['activity_recurring_date_0']); ?></td>
<td><?php echo ($row['activity_repetition']==0? "-" : date('H:i', strtotime($row['activity_recurring_time_0']))); ?></td>

<td><?php echo ($row['activity_repetition']==0? "-" : ($row['activity_repetition']<2? "-" : $row['activity_recurring_date_1'])); ?></td>
<td><?php echo ($row['activity_repetition']==0? "-" : ($row['activity_repetition']<2? "-" : date('H:i', strtotime($row['activity_recurring_time_1'])))); ?></td>

<td><?php echo ($row['activity_repetition']==0? "-" : ($row['activity_repetition']<3? "-" : $row['activity_recurring_date_2'])); ?></td>
<td><?php echo ($row['activity_repetition']==0? "-" : ($row['activity_repetition']<3? "-" : date('H:i', strtotime($row['activity_recurring_time_2'])))); ?></td>

<td><?php echo ($row['username']==$username? $row['username'] : '<a href="profile_view_others.php?username='.$row['username'].'">'.$row['username'].'</a>'); ?></td>

<td><?php echo '<a href = "activity_display_details.php?id='.$row['activity_id'].'">Click Here</a>'; ?></td>

<?php checkJoined($row['activity_id'],$user_id); ?>
    
<?php 
    if ($row['username'] == $_SESSION['username']) {
        echo '<td>-</td>';
    }
    else {
        echo '<td><a href = "report_activity.php?id='.$row['activity_id'].'">Click Here</a></td>';
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
