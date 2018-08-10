
<?php
include_once "header.php"

?>


<!DOCTYPE html>
<html>
<head>

	<title>Chatroom bos</title>
	<style>






h2 {
	font-family: 'Open Sans';
	font-weight: 300;
	text-align: center;
	position: top;
	color: white;
	background-color: blue;
	border-radius: 10px;
	width: 200px;
	height: 50px;
	margin:auto;
	
}

	div#log{
	width: 800px;
	height: 300px;
	border: 5px solid #dedede;
    background-image: url("2.jpg") ;
    border-radius: 14px;
    
    margin:  0 auto;
    margin-top: 15px;
    text-color:black;
	}	

	div#sendCtrls{
		
    background-image: url("place.jpg");
    border-radius: 10px;
    padding: 10px;
  
		width: 225px;
		margin : 30px auto;

	}

	body {
	background-size: full;
	background-image: url("background.jpg");
}



	</style>
</head>
<body>
	



	<div id="log"></div> 

	<div id="sendCtrls">

	<input type="text" placeholder="your message" id="text">


	<button>send </button>

	
	<script>

		var name = prompt('siapa kamu?');

		var sock = new WebSocket("wss://localhost:5001");

		sock.onopen= function() {
			sock.send(JSON.stringify({
				type: "name",
				data: name
			}));
		}

		var log = document.getElementById('log');
	
		sock.onmessage = function(event){
			console.log(event);
			var json = JSON.parse(event.data);
			log.innerHTML += json.name+": "+json.data+"<br>";
		}

		document.querySelector('button').onclick = function(){
			var text = document.getElementById('text').value;
			sock.send(JSON.stringify({
				type: "message",
				data: text
			}));

			log.innerHTML += "You :"+text+"<br>";
		};
	</script>


</body>
</html>
