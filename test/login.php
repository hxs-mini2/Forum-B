<?php
session_start();
require dirname(__FILE__).'/../vendor/autoload.php';
Dotenv\Dotenv::createImmutable(__DIR__.'/..')->load();
$name = $_POST['name'];
$host = $_ENV['HOST'];
$DBname = $_ENV['DBACCOUNT'];
$user = $_ENV['USER'];
$passwd = $_ENV['PASSWD'];

$db = new PDO("mysql:host=$host;dbname=$DBname", $user, $passwd);
$n = $db->query("SELECT * FROM user WHERE name = '$name'");

$member = $n->fetch();
//指定したハッシュがパスワードにマッチしているかチェック
if (password_verify($_POST['pass'], $member['pass'])) {
    //DBのユーザー情報をセッションに保存
    $_SESSION['id'] = $member['id'];
    $_SESSION['name'] = $member['name'];
    echo 'ログインしました。';
    echo '<a href="index.php">ホーム</a>';
} else {
    echo 'メールアドレスもしくはパスワードが間違っています。';
    echo "<h1>ログインページ（再）</h1>";
    echo "<form action='login.php' method='post'>";
    echo "<div>";
    echo "<label>ユーザID：<label>";
    echo "<input type='text' name='name' required>";
    echo "</div>";
    echo "<div>";
    echo "<label>パスワード：<label>";
    echo "<input type='password' name='pass' required>";
    echo "</div>";
    echo "<input type='submit' value='ログイン'>";
    echo "</form>";

    echo '<a href="login.php">戻る</a>';
}
?>
