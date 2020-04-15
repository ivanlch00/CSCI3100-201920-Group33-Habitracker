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

	if(isset($_GET['id'])){


		$activityID = $_GET['id'];

		getActivityNameFromActivityID($activityID);

		echo "<div>Participants: </div>";

		$conn = mysqli_connect("localhost","root","","Habitracker");
		$sql = "SELECT * FROM activity_users_list WHERE activity_id = ".$activityID." ";
		$result = mysqli_query($conn,$sql);

		while($row = mysqli_fetch_assoc($result)){
			echo "<span>".$row['username']."</span><br>";
			//printing all users in this event
		}

			echo '<form action = "activity_display_details.php" method="GET">
				<button type="submit" name="id" value='.$activityID.'>Details of this event </button> </form>';

			echo '<form action = "activity_join.php" method="GET">
				<button type="submit" name="id" value='.$activityID.'>Join this event </button> </form>';


			echo '<form action = "activity_index_page.php">
				  <button type="submit">Go back to activity page </button> </form>';

			echo"</div>";



	}



?>
