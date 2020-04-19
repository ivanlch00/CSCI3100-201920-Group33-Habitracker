<?php
//Contributed by Ivan

require 'header.php';


if( !isset( $_SESSION['username']) ){
  echo "You are not authorized to view this page. Go back <a href= '/'>home</a>";
  exit();
}


?>

<div>
  <div><h1>Search activities by keyword</h1></div>
</div>
<form action = 'activity_search_backend.php' method = 'POST'>
  <label>You can search activities through keywords.</label><br><br>
  <label>Keyword: </label>
  <input class = 'form-control w-50' type="text" name="activity_keyword"><br><br>

  <div class ='text-center mt-3 w-50'>
    <button class = 'btn btn-outline-info' type = 'submit' value = 'submit' name= 'search_activity'>Submit</button></br></br>
  </form>
