<?php

//fetch_user.php this is for displaying button "start chat" so it excludes the current user 

include('chatdatabase_connection.php');

session_start();

/* this is where we should select activity from activity from database which the user has joint */
$query = "
SELECT * FROM activity_users_list 
WHERE user_id = '".$_SESSION['user_id']."' 
";

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$output = '
<table class="table table-bordered table-striped">
 <tr>
 <th width="70%">Activity Name</td>
 
 <th width="30%">Action</td>
 </tr>
';

foreach($result as $row)
{
    /* this can ignore for now
 $status = '';
 $current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
 $current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
 $user_last_activity = fetch_user_last_activity($row['user_id'], $connect);
 if($user_last_activity > $current_timestamp)
 {
  $status = '<span class="label label-success">Online</span>';
 }
 else
 {
  $status = '<span class="label label-danger">Offline</span>';
 }
 */

$query = "
SELECT * FROM activity_table 
WHERE activity_id = '".$row['activity_id']."' 
";

$statement = $connect->prepare($query);

$statement->execute();

$result_2 = $statement->fetchAll();

foreach($result_2 as $row_2){

 $output .= '
 <tr>
    <td>'.$row_2['activity_name'].' '.count_activity_unseen_message($row_2['activity_id'], $connect).'</td>
   
    <td><button type="button" class="btn btn-info btn-xs start_group_chat" data-activityid="'.$row_2['activity_id'].'" data-activityname="'.$row_2['activity_name'].'">Start Group Chat</button></td>
 </tr>
 ';

}
}
//the activity_id and activity_name not yet defined, data- name changed 

$output .= '</table>';

echo $output;

?>
