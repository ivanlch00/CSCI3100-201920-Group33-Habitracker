$(document).ready(function() {
    // send data
    $("#login").submit(function(e){
        e.preventDefault();
        $.post($("#login").attr("action"), 
            {username: $("input").eq(0).val(),
            pwd: $("input").eq(1).val()}, 
            function(res){ 
                if(res == "empty"){
                    $("#errorMsg").html("Empty field");
                    $("#errorMsg").css("margin-bottom", "1em");
                }
                else if(res == "fail"){
                    $("#errorMsg").html("Wrong username/password");
                    $("#errorMsg").css("margin-bottom", "1em");
                }
                else if(res == "success"){
                    window.location.href = "admin_index.php";
                }
        });
    });
        
    // remove error message
    $("input").on("keypress", function(){
        $("#errorMsg").html("");
        $("#errorMsg").css("margin-bottom", "");
    });
});
    