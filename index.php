<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<title>掲示板ハブ</title>
</head>

<body>

	<?php
		require './vendor/autoload.php';
		Dotenv\Dotenv::createImmutable(__DIR__)->load();
		$host = $_ENV['HOST'];
		$DBname = $_ENV['DBNAME'];
		$user = $_ENV['USER'];
		$passwd = $_ENV['PASSWD'];
		
		$db = new PDO("mysql:host=$host;dbname=$DBname", "$user", "$passwd");
    	$n = $db->query("SHOW TABLES");
		while ($i = $n->fetch()) {
			$data[] = $i[0];
		}

		echo "<table class='Forums'>";
		echo "<tr><th>NO.</th><td>掲示板一覧</td></tr>";
		$count = 1;
		foreach ($data as $value) {
			echo "<tr><th>$count</th><td><a href=\"keiziban/index.php?table%5B%5D=$value\">$value</a></td></tr>";
			$count++;
		}
		echo "</table>";
	?>

</body>

</html>