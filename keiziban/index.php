<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- jqueryを読み込み -->
	<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
	<meta charset="utf-8" />

	<?php
		session_start();
		if (isset($_SESSION['id'])) {
			require dirname(__FILE__).'/../vendor/autoload.php';
    	    Dotenv\Dotenv::createImmutable(__DIR__.'/..')->load();
			$table = htmlspecialchars($_GET['table'][0], ENT_QUOTES, 'UTF-8');
		} else {
			header("Location: ../index.php");
			exit;
		}
	?>

	<script type="text/javascript">
		const table = <?= "'" . $table . "'"; ?>; 
		const homeURL = <?= "\"".htmlspecialchars($_ENV['HOMEURL'], ENT_QUOTES, 'UTF-8')."\"" ?>;
	</script>

	<title>掲示板-<?= $table; ?></title>
</head>

<body>
	<h1><?= $table; ?></h1>

	<a href="../index.php">戻る</a>

	<br>

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
			const name = htmlspecialchars(formElm.name.value);
			const message = htmlspecialchars(formElm.message.value);
			formElm.name.value = '';
			formElm.message.value = '';
			
			$.ajax({
				type: "POST",
				url: `http://${homeURL}keiziban/php/Send_C.php`,
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

		function htmlspecialchars(str){
  			return (str + '').replace(/&/g,'&amp;')
                   .replace(/"/g,'&quot;')
                   .replace(/'/g,'&#039;')
                   .replace(/</g,'&lt;')
                   .replace(/>/g,'&gt;'); 
		}
	</script>

	<br><br><br>

	<div id="displayArea">
		<!-- jsファイルを読み込み -->
		<script type="text/javascript" src="js/display.js"></script>
	</div>
</body>

</html>