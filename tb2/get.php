<?php
require './vendor/autoload.php';
Dotenv\Dotenv::createImmutable(__DIR__)->load();
$host = $_ENV['HOST'];
$DBname = $_ENV['DBNAME'];
$TableName = $_ENV['TABLENAME'];
$user = $_ENV['USER'];
$passwd = $_ENV['PASSWD'];

$db = new PDO("mysql:host=$host;dbname=$DBname", $user, $passwd);
$n = $db->query("SELECT * FROM $TableName ORDER BY no DESC");
while ($i = $n->fetch()) {
	$data[$i['no']] = array(
		"no" => $i['no'],
		"name" => $i['name'],
		"time" => $i['time'],
		"message" => $i['message']
	);
}

echo json_encode($data);
exit;
?>
