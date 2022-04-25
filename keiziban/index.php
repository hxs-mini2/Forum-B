<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

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
		$url = $_ENV['HOMEURL'];
	?>

	<!-- jqueryを読み込み -->
	<script src="https://code.jquery.com/jquery-3.0.0.min.js"></script>
	<script src="http://<?=$url?>keiziban/js/jQuery_ajax.js"></script>
	<meta charset="utf-8" />

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
	<br><br><br>

	<div id="displayArea">
		<script>reload()</script>
	</div>
</body>

</html>