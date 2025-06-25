<?php
class ConnectionFactory {
    private static $connection;

    public static function getConnection() {
        if (!isset(self::$connection)) {
            $host = 'localhost';
            $port = 3307;
            $dbName = 'laboratorio';
            $user = 'root';
            $pass = '';

            try {
                self::$connection = new PDO("mysql:host=$host;dbname=$dbName;port=$port", $user, $pass);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            } catch (PDOException $ex) {
                echo "Erro na conexão com o banco: " . $ex->getMessage();
                return null;
            }
        }

        return self::$connection;
    }
}
?>
