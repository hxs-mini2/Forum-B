<?php
class Send_C {
    public $host;
    public $DBname;
    public $table;
    public $user;
    public $passwd;
	public $name;
	public $message;

    public function __construct($table) {
        require './vendor/autoload.php';
        Dotenv\Dotenv::createImmutable(__DIR__)->load();
        $this->host = $_ENV['HOST'];
        $this->DBname = $_ENV['DBNAME'];
        $this->table = $table;
        $this->user = $_ENV['USER'];
        $this->passwd = $_ENV['PASSWD'];
    }

    public function SendMessages() {
		if (!empty($_POST["name"]) && !empty($_POST["message"])) {
			$name = htmlspecialchars($_POST["name"], ENT_QUOTES);
			$message = htmlspecialchars($_POST["message"], ENT_QUOTES);
		
			$db = new PDO("mysql:host=$this->host;dbname=$this->DBname", $this->user, $this->passwd);
		
			$db->query("INSERT INTO $this->table(no, name, message, time)
					VALUES(NULL, '$name', '$message', NOW())");
		
		} else {
		}
    }
}

$send_C = new Send_C($_POST['table']);
$send_C->SendMessages();
exit;
?>
