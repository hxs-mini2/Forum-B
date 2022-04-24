<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="utf-8">
	<title>掲示板ハブ</title>
</head>

<body>

	<?php
        session_start();
		echo "運良くこのページにたどり着いた方へ<br>";
		echo "おめでとう！！<br>";
		echo "ただ，このページはまだ開発中のものなのでアカウント等を作っても意味はほとんどありません．<br>";
		echo "何かあればHxSコンピュータ部までどうぞ";
		echo "<br><br>";
		require './vendor/autoload.php';
		Dotenv\Dotenv::createImmutable(__DIR__)->load();
		$host = htmlspecialchars($_ENV['HOST'], ENT_QUOTES, 'UTF-8');
		$DBname = htmlspecialchars($_ENV['DBNAME'], ENT_QUOTES, 'UTF-8');
		$user = htmlspecialchars($_ENV['USER'], ENT_QUOTES, 'UTF-8');
		$passwd = htmlspecialchars($_ENV['PASSWD'], ENT_QUOTES, 'UTF-8');
		
        if (isset($_SESSION['id'])) {
        $username = htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8');
		$db = new PDO("mysql:host=$host;dbname=$DBname", "$user", "$passwd");
    	$n = $db->query("SHOW TABLES");
		while ($i = $n->fetch()) {
			$data[] = htmlspecialchars($i[0], ENT_QUOTES, 'UTF-8');
		}
        
        echo "<h1>ようこそ $username さん</h1>";
		echo "<table class='Forums'>";
		echo "<tr><th>NO.</th><td>掲示板一覧</td></tr>";
		$count = 1;
		foreach ($data as $value) {
			echo "<tr><th>$count</th><td><a href=\"keiziban/index.php?table%5B%5D=$value\">$value</a></td></tr>";
			$count++;
		}
		echo "</table>";
		echo "<br>";
		echo '<a href="login_out/logout.php">ログアウト</a>';
    } else {
        echo '<br>ログインしていません<br>';
        echo '<br><a href="login_out/login_form.php">ログイン</a><br>';
        echo '<br><a href="login_out/signup.php">新規登録</a><br>';
    }
	?>

</body>

</html>