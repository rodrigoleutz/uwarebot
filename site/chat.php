<div class="top">
	<a onclick="down()"><img id="image" src="img/up_chat.png"></a>
	<div id="chatbot">
		<span>uwarebot</span>
	</div>
</div>
<div class="iframe">
	<iframe src="chat_frame.php"></iframe>
</div>
<script type="text/javascript">
	function down(){
		var div1 = 'chat';
		var div2 = 'image';
		if(document.getElementById(div1).style.bottom == '0px'){
			document.getElementById(div1).style.bottom = '-450px';
			document.getElementById(div2).style.opacity = '0';
			setTimeout(function(){ document.getElementById(div2).src="img/up_chat.png";
				document.getElementById(div2).style.opacity = '1' },2000);
		}
		else{
			document.getElementById(div1).style.bottom = '0px'
			document.getElementById(div2).style.opacity = '0';
			setTimeout(function(){ document.getElementById(div2).src="img/down_chat.png";
				document.getElementById(div2).style.opacity = '1'; },2000);
		}
	}
	document.getElementById("texto").focus();
</script>