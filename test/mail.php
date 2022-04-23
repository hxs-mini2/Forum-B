<?php
session_start();
require dirname(__FILE__).'/../vendor/autoload.php';
Dotenv\Dotenv::createImmutable(__DIR__.'/..')->load();
$host = $_ENV['HOST'];
$DBname = $_ENV['DBACCOUNT'];
$user = $_ENV['USER'];
$passwd = $_ENV['PASSWD'];
$name = $_SESSION['name'];
$mail = $_SESSION['mail'];
$pass = $_SESSION['pass'];
$rand = $_SESSION['code'];
$otp = $_POST['code'];

if ($rand == $otp) {
	$_SESSION = array();
	$_POST = array();

    try {
        $db = new PDO("mysql:host=$host;dbname=$DBname", $user, $passwd);
        $db->query("INSERT INTO user(no, name, mail, pass) VALUES(NULL, '$name', '$mail', '$pass')");
        echo "<br>登録できました．<br>";		
    } catch (Exception $e) {
        echo "<br>登録できませんでした．<br>";
    }

} else {
	echo "コードが間違っています<br><br>";
    echo "<h1>メール承認（再）</h1>";
    echo "<form action='mail.php' method='post'>";
    echo "<label>コード</label><br>";
    echo "<input type='text' name='code' required>";
    echo "<input type='submit' value='確認'>";
    echo "</form>";
}

echo "<a href='index.php'>ホームへ</a>";

?>