<?php
session_start();
require dirname(__FILE__).'/../vendor/autoload.php';
Dotenv\Dotenv::createImmutable(__DIR__.'/..')->load();
$host = htmlspecialchars($_ENV['HOST'], ENT_QUOTES, 'UTF-8');
$DBname = htmlspecialchars($_ENV['DBACCOUNT'], ENT_QUOTES, 'UTF-8');
$user = htmlspecialchars($_ENV['USER'], ENT_QUOTES, 'UTF-8');
$passwd = htmlspecialchars($_ENV['PASSWD'], ENT_QUOTES, 'UTF-8');
$id = htmlspecialchars($_COOKIE['PHPSESSID'], ENT_QUOTES, 'UTF-8');
$name = htmlspecialchars($_SESSION['name'], ENT_QUOTES, 'UTF-8');
$mail = htmlspecialchars($_SESSION['mail'], ENT_QUOTES, 'UTF-8');
$pass = htmlspecialchars($_SESSION['pass'], ENT_QUOTES, 'UTF-8');
$rand = htmlspecialchars($_SESSION['code'], ENT_QUOTES, 'UTF-8');
$otp = htmlspecialchars($_POST['code'], ENT_QUOTES, 'UTF-8');

if ($rand == $otp) {
	$_SESSION = array();
	$_POST = array();

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$DBname", $user, $passwd);
        $stmt = $pdo->prepare("INSERT INTO user(no, id, name, mail, pass) VALUES(NULL, :id, :name, :mail, :pass)");
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':name', $name);
        $stmt->bindValue(':mail', $mail);
        $stmt->bindValue(':pass', $pass);
        $stmt->execute();
        echo "<br>登録できました．<br>";		
    } catch (Exception $e) {
        echo "<br>登録できませんでした．<br>";
        exit;
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

echo "<a href='../index.php'>ホームへ</a>";

?>