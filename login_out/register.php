<?php
session_start();
require dirname(__FILE__).'/../vendor/autoload.php';
Dotenv\Dotenv::createImmutable(__DIR__.'/..')->load();
$name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
$mail = htmlspecialchars($_POST['mail']."@st.oit.ac.jp", ENT_QUOTES, 'UTF-8');
$pass = password_hash(htmlspecialchars($_POST['pass'], ENT_QUOTES, 'UTF-8'), PASSWORD_DEFAULT);
$host = htmlspecialchars($_ENV['HOST'], ENT_QUOTES, 'UTF-8');
$DBname = htmlspecialchars($_ENV['DBACCOUNT'], ENT_QUOTES, 'UTF-8');
$user = htmlspecialchars($_ENV['USER'], ENT_QUOTES, 'UTF-8');
$passwd = htmlspecialchars($_ENV['PASSWD'], ENT_QUOTES, 'UTF-8');

$db = new PDO("mysql:host=$host;dbname=$DBname", $user, $passwd);
$n = $db->query("SELECT * FROM user WHERE mail = '$mail' OR name = '$name'");

$i = $n->fetch();
if (!empty($i['mail']) || !empty($i['name'])) {
    echo "同じメールアドレスまたは，同じユーザIDが存在します。<br>";
} else {
    $rand = mt_rand(100000, 999999);
    $_SESSION['name'] = $name;
    $_SESSION['mail'] = $mail;
    $_SESSION['pass'] = $pass;
    $_SESSION['code'] = $rand;

    mb_language("Japanese");
    mb_internal_encoding("UTF-8");

    $to = $mail;
    $title = 'HxS掲示板・新規登録';
    $message = 'コード : '.$rand;
    $headers = "From: hoge21119@gmail.com";

    if (mb_send_mail($to, $title, $message, $headers)) {
        echo "メール送信成功です";
    } else {
        echo "メール送信失敗です";
    }

    echo "<h1>メール承認</h1>";
    echo "<form action='mail.php' method='post'>";
    echo "入力されたメールアドレス宛てに承認コードを送信しました．<br><br>";
    echo "<label>コード</label><br>";
    echo "<input type='text' name='code' required>";
    echo "<input type='submit' value='確認'>";
    echo "</form>";
}

echo "<br><br>";
echo "<a href='signup.php'>戻る</a>";
echo "<br>";
echo "<a href='../index.php'>ホーム</a>"
?>
