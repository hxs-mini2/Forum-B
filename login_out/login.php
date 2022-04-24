<?php
session_start();
require dirname(__FILE__).'/../vendor/autoload.php';
Dotenv\Dotenv::createImmutable(__DIR__.'/..')->load();
$name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
$host = htmlspecialchars($_ENV['HOST'], ENT_QUOTES, 'UTF-8');
$DBname = htmlspecialchars($_ENV['DBACCOUNT'], ENT_QUOTES, 'UTF-8');
$user = htmlspecialchars($_ENV['USER'], ENT_QUOTES, 'UTF-8');
$passwd = htmlspecialchars($_ENV['PASSWD'], ENT_QUOTES, 'UTF-8');

try {
    $pdo = new PDO("mysql:host=$host;dbname=$DBname", $user, $passwd);
    $stmt = $pdo->prepare("SELECT * FROM user WHERE name = :name");
    $stmt->bindValue(':name', $name);
    $stmt->execute();
} catch (Exception $e) {
    exit;
}

$response = $stmt->fetch();
//指定したハッシュがパスワードにマッチしているかチェック
if (password_verify(htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8'), $response['pass'])) {
    //DBのユーザー情報をセッションに保存
    $_SESSION['id'] = htmlspecialchars($response['id'], ENT_QUOTES, 'UTF-8');
    $_SESSION['name'] = htmlspecialchars($response['name'], ENT_QUOTES, 'UTF-8');
    echo 'ログインしました。';
    echo "<br>";
    echo '<a href="../index.php">ホーム</a>';
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
    echo "<br>";
    echo "<a href='../index.php'>ホーム</a>";
}
?>
