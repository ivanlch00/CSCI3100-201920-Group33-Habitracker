    <style>
        body {
            background-image: url('img/background.jpg');
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>

    <body>
    <img src="img/logo.png" alt="Habitracker" height="50">

    <ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="search_goal.php">Search goals</a></li>
    <li><a href="create_goal.php">Create goal</a></li>
    <li><a href="mygoals.php">View my goals</a></li>
    <li><a href="chatindex.php">Chat</a></li>
    <li><a href="change-password.php">Change password</a></li>
    </ul>

<?php
    session_start();
    if (isset($_SESSION['user_id'])){
        echo '<form action="includes/logout.inc.php" method="post">
        <button type="submit" name="logout-submit">Logout</button></br></br>
        </form>';
    } else {
        echo '<form action="includes/login.inc.php" method="post">
        <input type="text" name ="mailuid" placeholder="Username/E-mail...">
        <input type="password" name ="pwd" placeholder="Password...">
        <button type="submit" name="login-submit">Login</button>
        </form>
        <a href="signup.php">Signup</a>';
    }

    if (!isset($_SESSION['user_id'])) session_start();
    include('chatdatabase_connection.php');
    
    if(!isset($_SESSION['user_id'])) {
        header("location:index.php");
    }
    ?>

<html>
<head>
    <title>Chat with other users of Habitracker</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <div class="container">
    <br/>
    <h3 align="center">Chat with other users of Habitracker</a></h3><br />
    <br/>

    <div class="table-responsive">
    <p align="right">Hi - <?php echo $_SESSION['username'];  ?></p>
    <div id="user_details"></div>
    <div id="user_model_details"></div>
    </div>
    </div>
</body>
</html>  



<script>  
$(document).ready(function(){

 fetch_user();

 setInterval(function(){
    update_last_activity();
    fetch_user();
    update_chat_history_data();
 }, 5000);

 function fetch_user()
 {
  $.ajax({
    url:"chatfetch_user.php",
    method:"POST",
    success:function(data){
    $('#user_details').html(data);
   }
  })
 }

 function update_last_activity()
 {
  $.ajax({
    url:"chatupdate_last_activity.php",
    success:function()
   {

   }
  })
 }

 function make_chat_dialog_box(to_user_id, to_user_name)
 {
  var modal_content = '<div id="user_dialog_'+to_user_id+'" class="user_dialog" title="You have chat with '+to_user_name+'">';
  modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-touserid="'+to_user_id+'" id="chat_history_'+to_user_id+'">';
  modal_content += fetch_user_chat_history(to_user_id);
  modal_content += '</div>';
  modal_content += '<div class="form-group">';
  modal_content += '<textarea name="chat_message_'+to_user_id+'" id="chat_message_'+to_user_id+'" class="form-control chat_message"></textarea>';
  modal_content += '</div><div class="form-group" align="right">';
  modal_content+= '<button type="button" name="send_chat" id="'+to_user_id+'" class="btn btn-info send_chat">Send</button></div></div>';
  $('#user_model_details').html(modal_content);
 }

 $(document).on('click', '.start_chat', function(){
    var to_user_id = $(this).data('touserid');
    var to_user_name = $(this).data('tousername');
    make_chat_dialog_box(to_user_id, to_user_name);
    $("#user_dialog_"+to_user_id).dialog({
    autoOpen:false,
    width:400
    });
    $('#user_dialog_'+to_user_id).dialog('open');
 });
 
 $(document).on('click', '.send_chat', function(){
  var to_user_id = $(this).attr('id');
  var chat_message = $('#chat_message_'+to_user_id).val(); //fetch data from chat area field and store in this variable
  $.ajax({
   url:"chatinsert_chat.php",
   method:"POST",
   data:{to_user_id:to_user_id, chat_message:chat_message},
   success:function(data)   //success if can retrieve data from server
   {
    $('#chat_message_'+to_user_id).val('');   //clear text area value
    $('#chat_history_'+to_user_id).html(data);   //the html data receive chat data under div
   }
  })
 });

function fetch_user_chat_history(to_user_id) //fetch particular user chat history 
 {
  $.ajax({
   url:"chatfetch_user_chat_history.php",
   method:"POST",
   data:{to_user_id:to_user_id}, //choose what variable to send to sever
   success:function(data){ //can receive chat history from server if success
    $('#chat_history_'+to_user_id).html(data);
   }
  })
 }

 function update_chat_history_data() //display chat history of every chatbox opened in webpage for each interval
 {
    $('.chat_history').each(function(){ //access to all html files which have class chat history
    var to_user_id = $(this).data('touserid');
    fetch_user_chat_history(to_user_id);
    });
 }

 $(document).on('click', '.ui-button-icon', function(){
  $('.user_dialog').dialog('destroy').remove();
 });

$(document).on('focus', '.chat_message', function(){  //execute code if cursor come into text area field
    var is_type = 'yes';
    $.ajax({
        url:"chatupdate_is_type_status.php",
        method:"POST",
        data:{is_type:is_type},
        success:function()
        {

        }
    })
});

$(document).on('blur', '.chat_message', function(){  //execute code if cursor come into text area field
    var is_type = 'no';
    $.ajax({
        url:"chatupdate_is_type_status.php",
        method:"POST",
        data:{is_type:is_type},
        success:function()
        {

        }
    })
});

});  
</script>

 
