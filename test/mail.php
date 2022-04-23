<?php
session_start();
$rand = $_SESSION['code'];
$otp = $_POST['code'];

if ($rand == $otp) {
	unset($_SESSION['code']);

	echo "登録しました．<br>";
} else {
	echo "コードが間違っています<br><br>";
    echo "<h1>メール承認（再）</h1>";
    echo "<form action='mail.php' method='post'>";
    echo "<label>コード</label><br>";
    echo "<input type='text' name='code' required>";
    echo "<input type='submit' value='確認'>";
    echo "</form>";
}

?>