<?php

//fetch_user_chat_history.php

include('chatdatabase_connection.php');

session_start(); //get session variable

echo fetch_user_chat_history($_SESSION['user_id'], $_POST['to_user_id'], $connect);

?>