<?php
    require 'header.php';
    
    if( !isset( $_SESSION['username']) ){
        echo "You are not authorized to view this page. Go back <a href= '/'>home</a>";
        exit();
    }
    
    
    ?>

<form action = 'search_goal_result.php' method = 'POST'>
    <label>You can search goals of other users through keywords.</label><br><br>
    <label>Keyword: </label>
    <input class = 'form-control w-50' type="text" name="goal_keyword"><br><br>

    <div class ='text-center mt-3 w-50'>
    <button class = 'btn btn-outline-info' type = 'submit' value = 'submit' name= 'search_goal'>Submit</button></br></br>
</form>
