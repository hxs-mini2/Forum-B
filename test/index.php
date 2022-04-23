<?php
session_start();
$username = $_SESSION['name'];
if (isset($_SESSION['id'])) {//ログインしているとき
    echo 'こんにちは' . htmlspecialchars($username, \ENT_QUOTES, 'UTF-8') . 'さん' . "<br><br>";
    echo '<a href="logout.php">ログアウト</a>';
} else {//ログインしていない時
    echo '<br>ログインしていません<br>';
    echo '<br><a href="login_form.php">ログイン</a><br>';
    echo '<br><a href="signup.php">新規登録</a><br>';
}
?>