<?
dsadsad
use model\Connection;       
class ConnectionUser extends Connection {
    private static $instance;

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new ConnectionUser();
        }
        return self::$instance;
    }

    protected function __construct() {
        parent::__construct();
    }

    public function connect() {
        try {
            $this->conn = new \PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (\PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            return null;
        }
    }
}
?>