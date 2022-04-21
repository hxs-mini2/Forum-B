<?php
require dirname(__FILE__).'/../vendor/autoload.php';
Dotenv\Dotenv::createImmutable(__DIR__.'/..')->load();
$name = $_POST['name'];
$mail = $_POST['mail'];
$pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
$host = $_ENV['HOST'];
$DBname = $_ENV['DBACCOUNT'];
$user = $_ENV['USER'];
$passwd = $_ENV['PASSWD'];

$db = new PDO("mysql:host=$host;dbname=$DBname", $user, $passwd);
$n = $db->query("SELECT * FROM user WHERE mail = $mail");

$i = $n->fetch();
if (!empty($i['mail'])) {
    echo "同じメールアドレスが存在します。<br>";
} else {
    try {
        $db = new PDO("mysql:host=$host;dbname=$DBname", $user, $passwd);
        $db->query("INSERT INTO user(no, name, mail, pass) VALUES(NULL, '$name', '$mail', '$pass')");
        echo "<br>登録できました．<br>";
    } catch (Exception $e) {
        echo "<br>登録できませんでした．<br>";
    }
}

echo "<a href='signup.php'>戻る</a>";
?>
