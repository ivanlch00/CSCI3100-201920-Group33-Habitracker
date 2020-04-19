<?php
//Contributed by Ivan

require 'header.php';

require 'db_key.php';
$conn = connect_db();
$activity_keyword = $_POST['activity_keyword'];
$sql = "Select * from activity_table Where activity_name Like '%$activity_keyword%' and activity_status_open = 1";
$search_result = $conn->query($sql);

?>


<div><h1>Search results</h1></div>
<div><h4>Keyword: <?php echo "$activity_keyword"; ?></h4></div>


<?php
if ($search_result->num_rows >0) {
  ?>
  <table border= 1px solid cellpadding="4">
    <tr>
      <th bgcolor="#CCCCCC">User</th>
      <th bgcolor="#CCCCCC">activity ID</th>
      <th bgcolor="#CCCCCC">activity name</th>
      <th bgcolor="#CCCCCC">Description</th>
      <th bgcolor="#CCCCCC">Details</th>
      <th bgcolor="#CCCCCC">Memberlist</th>
      <th bgcolor="#CCCCCC">Report this activity to admin</th>
    </tr>

    <?php
    while($row = $search_result->fetch_assoc()) {
      $id = $row['activity_id'];
      ?>
      <tr>
        <td><?php echo '<a href="profile_view_others.php?username='.$row['username'].'">'.$row['username'].'</a>'; ?></td>
        <td><?php echo $row['activity_id']; ?></td>
        <td><?php echo $row['activity_name']; ?></td>
        <td><?php echo $row['activity_remark']; ?></td>
        <td><?php echo '<a href = "activity_display_details.php?id='.$id.'"> Click Here</a> ' ;?></td>
        <td><?php echo '<a href = "activity_display_joined_users.php?id='.$id.'"> Click Here</a> ';?> </td>

        <?php
        if ($row['username'] == $_SESSION['username']) {
          echo '<td>-</td>';
        }
        else {
          echo '<td><a href="report_activity.php?id='.$row['activity_id'].'">Click Here</a></td>';
        }
        ?>


      </tr>
    <?php } ?>
  </table>
  <?php
} else
echo "No results";
?>
