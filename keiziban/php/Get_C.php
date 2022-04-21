<?php
class Get_C {
    public $host;
    public $DBname;
    public $table;
    public $user;
    public $passwd;

    public function __construct($table) {
        require dirname(__FILE__).'/../../vendor/autoload.php';
        Dotenv\Dotenv::createImmutable(__DIR__.'/../..')->load();
        $this->host = $_ENV['HOST'];
        $this->DBname = $_ENV['DBNAME'];
        $this->table = $table;
        $this->user = $_ENV['USER'];
        $this->passwd = $_ENV['PASSWD'];
    }

    public function getForum() {
        $db = new PDO("mysql:host=$this->host;dbname=$this->DBname", $this->user, $this->passwd);
        $n = $db->query("SELECT * FROM $this->table ORDER BY no DESC");
        while ($i = $n->fetch()) {
            $data[$i['no']] = array(
                "no" => $i['no'],
                "name" => $i['name'],
                "time" => $i['time'],
                "message" => $i['message']
            );
        }
        
        return $data;
    }
}

$get_C = new Get_C($_POST['table']);
echo json_encode($get_C->getForum());
exit
?>
