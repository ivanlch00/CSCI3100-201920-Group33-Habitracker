<!doctype html>
<html lang="en">
<head>


</head>

<?php
    require 'header.php';
    $username = $_SESSION['username'];
    function displayOneOff($data,$username){
        $conn = mysqli_connect("localhost","root","","Habitracker");
        
        if($username==NULL){
            $sql = "SELECT * FROM activity_table WHERE activity_repetition = ".$data." ";
        }else{
            $sql = "SELECT * FROM activity_table WHERE activity_repetition = ".$data." AND username = '".$username." '";
        }
        $result = mysqli_query($conn,$sql);
        
        while($row = mysqli_fetch_assoc($result)){
            
            echo" <tr>";
            
            if($row['activity_status_open'] == 1 ){
                
                if($data == 0){
                    echo "<td>&nbsp;</td><th>".$row['activity_name']."  </th>";
                    $date = date('yy:m:d-h:i', strtotime($row['activity_one_off_datetime']));
                    echo "<th>".$date."  </span>";
                }
                
                
                echo "<th>".$row['activity_location']."  </th>";
                
                
                echo "<th>".$row['username']."</th>";
                
                
                
                $id = $row['activity_id'];
                
                echo '<th> <a href = "activity_display_details.php?id='.$id.'">Click Here </a> </th>';
                
                echo '<th> <a href = "activity_display_joined_users.php?id='.$id.'">Click Here</a> </th>';
                
                
                // echo '<form action = "activity_display_joined_users.php" method="GET">
                //         <button type="submit" name="id" value='.$id.'> Member Lists </button> </form></th>';
            }
            echo"</tr>";
        }
    }
    function displayRecurring($data,$username){
        
        
        
        $conn = mysqli_connect("localhost","root","","Habitracker");
        
        if($username==NULL){
            $sql = "SELECT * FROM activity_table WHERE activity_repetition = ".$data." ";
        }else{
            $sql = "SELECT * FROM activity_table WHERE activity_repetition = ".$data." AND username = '".$username." '";
        }
        
        
        $result = mysqli_query($conn,$sql);
        
        while($row = mysqli_fetch_assoc($result)){
            
            echo" <tr>";
            
            if($row['activity_status_open'] == 1 ){
                
                if($data >= 1){
                    echo "<td>&nbsp;</td><th>".$row['activity_name']."  </th>";
                    echo "<th>".$row['activity_recurring_date_0']."  </th>";
                    $date = date('h:i', strtotime($row['activity_recurring_time_0']));
                    echo "<th>".$date."  </span>";
                }
                
                if($data >= 2){
                    echo "<th>".$row['activity_recurring_date_1']."  </th>";
                    $date = date('h:i', strtotime($row['activity_recurring_time_1']));
                    echo "<th>".$date."  </span>";
                }
                
                if($data >= 3){
                    echo "<th>".$row['activity_recurring_date_2']."  </th>";
                    $date = date('h:i', strtotime($row['activity_recurring_time_2']));
                    echo "<th>".$date."  </span>";
                }
                
                
                echo "<th>".$row['activity_location']."  </th>";
                
                
                echo "<th>".$row['username']."</th>";
                
                
                
                $id = $row['activity_id'];
                
                echo '<th> <a href = "activity_display_details.php?id='.$id.'">Click Here </a> </th>';
                
                echo '<th> <a href = "activity_display_joined_users.php?id='.$id.'">Click Here</a> </th>';
                
                
                // echo '<form action = "activity_display_joined_users.php" method="GET">
                //         <button type="submit" name="id" value='.$id.'> Member Lists </button> </form></th>';
            }
            echo"</tr>";
        }
    }
    ?>

<style type="text/css">
table.tableizer-table {
    font-size: 12px;
border: 1px solid #CCC;
    font-family: Arial, Helvetica, sans-serif;
}
.tableizer-table td {
padding: 4px;
margin: 3px;
border: 1px solid #CCC;
}
.tableizer-table th {
    background-color: #B8D5BF;
color: #FFF;
    font-weight: bold;
}
</style>

<body>

	<br>Recurring<br>
	<table class="tableizer-table">
	<thead><tr class="tableizer-firstrow"><th></th><th>Name of activity</th><th>Date and Time</th><th>Location</th><th>Creator</th><th>Details</th><th>Memberlist</th></tr></thead><tbody>

	<?php
	displayOneOff(0,NULL);
	?>
	</tbody></table>
	<br>


<br>Once per week<br>
<table class="tableizer-table">
<thead><tr class="tableizer-firstrow"><th></th><th>Name of activity</th><th>Date</th><th>Time</th><th>Location</th><th>Creator</th><th>Details</th><th>Memberlist</th></tr></thead><tbody>

<?php displayRecurring(1,NULL); ?>
</tbody></table>
<br>


<br>Twice per week<br>
<table class="tableizer-table">
<thead><tr class="tableizer-firstrow"><th></th><th>Name of activity</th><th>Date1</th><th>Time1</th><th>Date2</th><th>Time2</th><th>Location</th><th>Creator</th><th>Details</th><th>Memberlist</th></tr></thead><tbody>

<?php displayRecurring(2,NULL); ?>
</tbody></table>
<br>

<br>Three times per week<br>
<table class="tableizer-table">
<thead><tr class="tableizer-firstrow"><th></th><th>Name of activity</th><th>Date1</th><th>Time1</th><th>Date2</th><th>Time2</th><th>Date3</th><th>Time3</th><th>Location</th><th>Creator</th><th>Details</th><th>Memberlist</th></tr></thead><tbody>

	<?php displayRecurring(3,NULL); ?>

</tbody></table>
<br>


</body>



</html>
