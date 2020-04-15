function getData() {
	// get data from database
	
}

$(document).ready(function() {
	// get chat records from database
	setInterval(function() {getData()}, 1000);

	$("#submit").click(function() {
		let msg = $("#msg").val();
		msg = msg.replace(/\n/g, "<BR>");
		//if(msg != ""){
			let date = new Date();
			let $new = $("<li><img><div><h5></h5><p></p></div></li>");
			$new.addClass("media");
			/*
			$new.find("img").attr({
				"src": 				
			});
			*/
			$new.find("div").addClass("media-body");
			$new.find("div").addClass("bg-success");
			$new.find("div").addClass("round");
			$new.find("div").addClass("mb-3");
			
			$new.find("h5").html(""); // display username
			
			$new.find("p").html(msg + "<br>" + date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear() + 
			" " + date.getHours() + ":" + date.getMinutes());		

			$("#msgArea").append($new);
			$("form").trigger("reset");
			$("#msg").prop("rows", 1);	
			
			// save records to database
		//}
	});
	
	$("#msg").keyup(function() {
		 var lines = $(this).val().split("\n");
		 console.log(lines);
		$(this).prop("rows", lines.length + 1);	
	});
});
