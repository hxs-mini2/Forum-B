<?php
require './vendor/autoload.php';
Dotenv\Dotenv::createImmutable(__DIR__)->load();
$host = $_ENV['HOST'];
$DBname = $_ENV['DBNAME'];
$TableName = $_ENV['TABLENAME'];
$user = $_ENV['USER'];
$passwd = $_ENV['PASSWD'];

if (!empty($_POST["name"]) && !empty($_POST["message"])) {
    $name = htmlspecialchars($_POST["name"], ENT_QUOTES);
    $message = htmlspecialchars($_POST["message"], ENT_QUOTES);

    $db = new PDO("mysql:host=$host;dbname=$DBname", $user, $passwd);

    $db->query("INSERT INTO $TableName(no, name, message, time)
            VALUES(NULL, '$name', '$message', NOW())");

} else {
}

exit;
?>
