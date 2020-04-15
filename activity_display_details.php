<?php

require 'header.php';
    
function getActivityNameFromActivityID($data){
  $conn = mysqli_connect("localhost","root","","Habitracker");
  $sql = "SELECT * FROM activity_table WHERE activity_id = ".$data." ";
  $result = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_assoc($result)){
    echo "<span>".$row['activity_name']."</span><br>";
  }


}

function getProperWeekDay($capWeekDay){
  if ($capWeekDay=="MON")return "Monday";
  elseif ($capWeekDay=="TUE")return "Tuesday";
  elseif ($capWeekDay=="WED")return "Wednesday";
  elseif ($capWeekDay=="THU")return "Thursday";
  elseif ($capWeekDay=="FRI")return "Friday";
  elseif ($capWeekDay=="SAT")return "Saturday";
  elseif ($capWeekDay=="SUN")return "Sunday";
}

if(isset($_GET['id'])){

  $activityID = $_GET['id'];
  getActivityNameFromActivityID($activityID);
  echo "<br><div>Details: </div>";
  $conn = mysqli_connect("localhost","root","","Habitracker");
  $sql = "SELECT * FROM activity_table WHERE activity_id = ".$activityID." ";
  $result = mysqli_query($conn,$sql);

  while($row = mysqli_fetch_assoc($result)){
    if(!empty($row['activity_one_off_datetime'])){
      $date= $row['activity_one_off_datetime'];
      echo "<div>The activity will be held on ".$date.". </div>";
    }
    if($row['activity_repetition']==1){

      echo "<div>The activity will be held once a week on ".
      getProperWeekDay($row['activity_recurring_date_0']).
      " at ".$row['activity_recurring_time_0'].". </div>";
    }
    if($row['activity_repetition']==2){

      echo "<div>The activity will be held twice a week on ".
      getProperWeekDay($row['activity_recurring_date_0']).
      " at ".$row['activity_recurring_time_0']." and ".
      getProperWeekDay($row['activity_recurring_date_1']).
      " at ".$row['activity_recurring_time_1'].". ".

      " </div>";
    }
    if($row['activity_repetition']==3){

      echo "<div>The activity will be held three times a week on ".
      getProperWeekDay($row['activity_recurring_date_0']).
      " at ".$row['activity_recurring_time_0']." , ".
      getProperWeekDay($row['activity_recurring_date_1']).
      " at ".$row['activity_recurring_time_1']." and ".
      getProperWeekDay($row['activity_recurring_date_2']).
      " at ".$row['activity_recurring_time_2'].". ".
      " </div>";
    }
    echo "<div>The location of this event is '".$row['activity_location']."'. </div>";

    if(!empty($row['activity_remark'])){
      echo "<div><br>The description of this event is as follow: <br> ".$row['activity_remark'].". </div>";

    }

    if(!empty($row['activity_time_remark'])){
      echo "<div><br>Special remark about the time:  <br> ".$row['activity_time_remark'].". </div>";

    }


    //echo "<span>".$row['date']."</span><br>";
    //printing all users in this event
  }

  echo '<br><form action = "activity_display_joined_users.php" method="GET">
  <button type="submit" name="id" value='.$activityID.'>Members of this event </button> </form>';

  echo '<form action = "activity_join.php" method="GET">
  <button type="submit" name="id" value='.$activityID.'>Join this event </button> </form>';

  echo '<form action = "activity_index_page.php">
  <button type="submit">Go back to activity page </button> </form>';

  echo"</div>";


}
?>
