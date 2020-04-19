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
    <title>Chat with other users of Habitracker in the same activity</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>

<body>
    <div class="container">
    <br/>
    <h3 align="center">Chat with other users of Habitracker in the same activity</a></h3><br />
    <br/>

    <!--
        <input type="hidden" id="is_active_group_chat_window" value="no" />
        <button type="button" name="group_chat" id="group_chat" class="btn btn-warning btn-xs">Group Chat1</button> calling depends on id but not name-->
    

    <div class="table-responsive">
    <p align="right">Hi - <?php echo $_SESSION['username'];  ?></p>
    <div id="activity_details"></div>      <!--changed from user to activity-->
    <div id="user_model_details"></div>
    </div>
    </div>
</body>
</html>  

<div id="group_chat_dialog" title="Group Chat Window">
    <div id="group_chat_history" style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;">

    </div>
    <div class="form-group">
        <textarea name="group_chat_message" id="group_chat_message" class="form-control"></textarea>
    </div>
    <div class="form-group" align="right">
        <button type="button" name="send_group_chat" id="send_group_chat" class="btn btn-info">Send</button>
    </div>
</div>

<script>  
$(document).ready(function(){

 fetch_activity(); //fetch activity details on webpage 

 setInterval(function(){
    update_last_activity();
    fetch_activity();
    update_chat_history_data();
    //fetch_group_chat_history();
 }, 5000);

 function fetch_activity() //fetch_user -> fetch_activity
 {
  $.ajax({
    url:"groupchat_fetch_user.php", //file name is not wrong here
    method:"POST",
    success:function(data){
    $('#activity_details').html(data); //refer to the div id in html line 65
   }
  })
 }

 function update_last_activity() //no use now
 {
  $.ajax({
    url:"chatupdate_last_activity.php",
    success:function()
   {

   }
  })
 }

 function make_activity_dialog_box(activity_id, activity_name)
 {
  var modal_content = '<div id="activity_dialog_'+activity_id+'" class="user_dialog" title="You have chat with participants in '+activity_name+'">';
  modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-activityid="'+activity_id+'" id="chat_history_'+activity_id+'">';
  modal_content += fetch_activity_chat_history(activity_id);
  modal_content += '</div>';
  modal_content += '<div class="form-group">';
  modal_content += '<textarea name="chat_message_'+activity_id+'" id="chat_message_'+activity_id+'" class="form-control chat_message"></textarea>';
  modal_content += '</div><div class="form-group" align="right">';
  modal_content+= '<button type="button" name="send_chat" id="'+activity_id+'" class="btn btn-info send_chat">Send</button></div></div>';
  $('#user_model_details').html(modal_content); //#is from html div tag line 66
 }
 

 $(document).on('click', '.start_group_chat', function(){     //start_chat refers to fetch_user.php class btn 
    var activity_id = $(this).data('activityid');       //data- in fetch_user.php
    var activity_name = $(this).data('activityname');   //data- in fetch_user.php
    make_activity_dialog_box(activity_id, activity_name);   //using the upper two lines variable
    $("#activity_dialog_"+activity_id).dialog({             //refer to line 120 modal content, dialog is a jQuery function
    autoOpen:false,  //hide dialog on webpage
    width:400
    });
    $('#activity_dialog_'+activity_id).dialog('open'); //pop up chat dialog on webpage
 });
 
 $(document).on('click', '.send_chat', function(){ 
  var activity_id = $(this).attr('id'); //activity_id is the POST in groupchat_insert chat.php, id not yet know
  var activity_chat_message = $('#chat_message_'+activity_id).val(); //fetch data from chat area field and store in this variable
  $.ajax({
   url:"groupchat_insert_chat.php",
   method:"POST",
   data:{activity_id:activity_id, activity_chat_message:activity_chat_message},
   success:function(data)   //success if can retrieve data from server
   {
    $('#chat_message_'+activity_id).val('');   //clear text area value, not sure #chat message refer to what, same with below
    $('#chat_history_'+activity_id).html(data);   //the html data receive chat data under div
   }
  })
 });

function fetch_activity_chat_history(activity_id) //fetch particular user chat history 
 {
  $.ajax({
   url:"groupchat_fetch_user_chat_history.php",
   method:"POST",
   data:{activity_id:activity_id}, //choose what variable to send to sever
   success:function(data){ //can receive chat history from server if success
    $('#chat_history_'+activity_id).html(data);
   }
  })
 }

 function update_chat_history_data() //display chat history of every chatbox opened in webpage for each interval
 {
    $('.chat_history').each(function(){ //access to all html files which have class chat history
    var activity_id = $(this).data('activityid');  //data- in fetch_user.php
    fetch_activity_chat_history(activity_id);
    });
 }

 $(document).on('click', '.ui-button-icon', function(){
  $('.user_dialog').dialog('destroy').remove();
 });

/*
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
*/

/*
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
*/

/*
$('#group_chat_dialog').dialog({
    autoOpen:false,
    width:400
});

$('#group_chat').click(function(){  //this depnds on the id of the button above 
    $('#group_chat_dialog').dialog('open');
    $('#is_active_group_chat_window').val('yes');
    fetch_group_chat_history();
});

$('#send_group_chat').click(function(){
    var chat_message = $('#group_chat_message').val();
    var action = 'insert_data';
    if(chat_message != '')
    {
        $.ajax({
        url:"chatgroup_chat.php",
        method:"POST",
        data:{chat_message:chat_message, action:action},
        success:function(data){
            $('#group_chat_message').val('');
            $('#group_chat_history').html(data);
        }
        })
    }
});

function fetch_group_chat_history()
{
    var group_chat_dialog_active = $('#is_active_group_chat_window').val();
    var action = "fetch_data";
    if(group_chat_dialog_active == 'yes')
    {
        $.ajax({
        url:"chatgroup_chat.php",
        method:"POST",
        data:{action:action},
        success:function(data)
        {
            $('#group_chat_history').html(data);
        }
        })
    }
}
*/

});  
</script>

 
