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
        $this->host = htmlspecialchars($_ENV['HOST'], ENT_QUOTES, 'UTF-8');
        $this->DBname = htmlspecialchars($_ENV['DBNAME'], ENT_QUOTES, 'UTF-8');
        $this->table = htmlspecialchars($table, ENT_QUOTES, 'UTF-8');
        $this->user = htmlspecialchars($_ENV['USER'], ENT_QUOTES, 'UTF-8');
        $this->passwd = htmlspecialchars($_ENV['PASSWD'], ENT_QUOTES, 'UTF-8');
    }

    public function getForum() {
        $db = new PDO("mysql:host=$this->host;dbname=$this->DBname", $this->user, $this->passwd);
        $n = $db->query("SELECT * FROM $this->table ORDER BY no DESC");
        while ($i = $n->fetch()) {
            $data[$i['no']] = array(
                "no" => htmlspecialchars($i['no'], ENT_QUOTES, 'UTF-8'),
                "name" => htmlspecialchars($i['name'], ENT_QUOTES, 'UTF-8'),
                "time" => htmlspecialchars($i['time'], ENT_QUOTES, 'UTF-8'),
                "message" => htmlspecialchars($i['message'], ENT_QUOTES, 'UTF-8')
            );
        }
        
        return $data;
    }
}

$get_C = new Get_C(htmlspecialchars($_POST['table']), ENT_QUOTES, 'UTF-8');
echo json_encode($get_C->getForum());
exit
?>
