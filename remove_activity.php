<?php
    $title = "Remove Activity";
    require 'admin_header.php';
    
    if(!isset($_SESSION['admin_username'])){
        "<div class='mx-2'><p>You don't have permission to access this page! Please log in as administator.</p><div>";
        exit();
    }
    
    require 'db_key.php';
    $conn = connect_db();

    $sql = "select activity_id, username, activity_name, activity_location from activity_table";
    $result = $conn->query($sql);
?>

<div><h1 align=center>Activity List</h1></div>

<?php
    if($result->num_rows > 0) {
        $table = 
            '<table class="table table-bordered table-hover table-sm text-nowrap">
                <thead class="thead-light text-center">
                    <tr>
                        <th class="sticky-top">Activity ID</th>
                        <th class="sticky-top">Activity Host</th>
                        <th class="sticky-top">Activity Name</th>
                        <th class="sticky-top">Description</th>
                        <th class="sticky-top">Subtask</th>
                        <th class="sticky-top">Delete Activity</th>
                    </tr>
                </thead>
            <tbody>';
        
        while($activity = $result->fetch_assoc()) { 
            $table .= '<tr class="table-success text-center">';
            $table .= '<td class="align-middle">'.$activity['activity_id'].'</td>';
            $table .= '<td class="align-middle">'.$activity['username'].'</td>';
            $table .= '<td class="align-middle">'.$activity['activity_name'].'</td>';
            $table .= '<td class="align-middle">'.$activity['activity_location'].'</td>';
            $table .= '<td class="align-middle">'.$activity['activity_location'].'</td>';
            $table .= '<td class="align-middle"><button class="deleteActivity btn btn-link" data-id="'.$activity['activity_id'].'" data-username="'.$activity['username'].'">Delete</button></td>';
            $table .= '</tr>';
        }
        $table .= '</tbody></table>';
        echo $table;
    }
    else
        echo "No activities";
?>

<?php
    require "footer.php";
?>
