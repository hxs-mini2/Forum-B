<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- jqueryを読み込み -->
	<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
	<meta charset="utf-8" />
	<title>掲示板-tb1</title>
</head>

<body>
	
	<?php
		$data = $_GET['table'];
	?>

	<script type="text/javascript">
		const table = <?php echo $data[0]; ?>;
	</script>

	<a href="../index.php">戻る</a>

	<br><br>

	<form id="sendMessage">
		<p>名前</p>
		<input type="text" name="name">
		<p>コメント</p>
		<textarea name="message"></textarea>
	</form>
	<button onClick="sendMessage()">送信</button>
	<script type="text/javascript">
		function sendMessage(params) {
			const formElm = document.getElementById("sendMessage");
			const name = formElm.name.value;
			const message = formElm.message.value;
			formElm.name.value = '';
			formElm.message.value = '';
			
			$.ajax({
				type: "POST",
				url: "http://150.89.253.73/b21119/Forum-B/keiziban/php/Send_C.php",
				data: {"table" : table,
					   "name" : name, 
					   "message" : message}
			}).done(function(){
			}).fail(function (XMLHttpRequest, textStatus, errorThrown) {
				console.log(XMLHttpRequest.status);
				console.log(textStatus);
				console.log(errorThrown.message);
			});
		}
	</script>
	<br><br>

</body>

<body>
	<div id="displayArea">
		<!-- jsファイルを読み込み -->
		<script type="text/javascript" src="js/display.js"></script>
	</div>
</body>

</html>