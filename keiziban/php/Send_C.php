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
        require dirname(__FILE__).'/../../vendor/autoload.php';
        Dotenv\Dotenv::createImmutable(__DIR__.'/../..')->load();
        $this->host = htmlspecialchars($_ENV['HOST'], ENT_QUOTES, 'UTF-8');
        $this->DBname = htmlspecialchars($_ENV['DBNAME'], ENT_QUOTES, 'UTF-8');
        $this->table = htmlspecialchars($table, ENT_QUOTES, 'UTF-8');
        $this->user = htmlspecialchars($_ENV['USER'], ENT_QUOTES, 'UTF-8');
        $this->passwd = htmlspecialchars($_ENV['PASSWD'], ENT_QUOTES, 'UTF-8');
    }

    public function SendMessages() {
		if (!empty($_POST["name"]) && !empty($_POST["message"])) {
			$name = htmlspecialchars($_POST["name"], ENT_QUOTES, 'UTF-8');
			$message = htmlspecialchars($_POST["message"], ENT_QUOTES, 'UTF-8');
		
            try {
		    	$pdo = new PDO("mysql:host=$this->host;dbname=$this->DBname", $this->user, $this->passwd);
	    		$stmt = $pdo->prepare("INSERT INTO $this->table(no, name, message, time) VALUES(NULL, :name, :message, NOW())");
                $stmt->bindValue(':name', $name);
                $stmt->bindValue(':message', $message);
                $stmt->execute();
            } catch (Exception $e) {
                exit;
            }
		} else {
		}
    }
}

$send_C = new Send_C(htmlspecialchars($_POST['table']), ENT_QUOTES, 'UTF-8');
$send_C->SendMessages();
exit;
?>
