<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>掲示板</title>
</head>

<body>

    <?php
    require './vendor/autoload.php';
    Dotenv\Dotenv::createImmutable(__DIR__)->load();
    $host = $_ENV['HOST'];
    $DBname = $_ENV['DBNAME'];
    $user = $_ENV['USER'];
    $passwd = $_ENV['PASSWD'];

    if (!empty($_POST["name"]) && !empty($_POST["message"])) {
        $name = htmlspecialchars($_POST["name"], ENT_QUOTES);
        $message = htmlspecialchars($_POST["message"], ENT_QUOTES);

        $db = new PDO("mysql:host=$host;dbname=$DBname", $user, $passwd);

        $db->query("INSERT INTO tb1(no, name, message, time)
             VALUES(NULL, '$name', '$message', NOW())");

        print "<h1>コメント送信完了しました</h1>";
        print "<p><a href=index.html>掲示板へ戻る</a></p>";
    } else {
        print "<h1>※フォームが入力されていません</h1>";
        print "<p><a href=index.html>掲示板へ戻る</a></p>";
    }

    ?>

</body>

</html>