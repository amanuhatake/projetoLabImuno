<?php
class ConnectionPaciente{
    static $connection; // 

    public static function getConnection(){
        if(!isset($connection)){
            $port = 3307;         // porta do SGBD
            $dbName = "laboratorio"; // Nome do banco de dados
            $userDb = "root";     // usuário do banco
            $host = "localhost";  // local de hospedagem do SGBD
            $pass = "";
            try{
                $connection = new PDO("mysql:host=$host;dbname=$dbName;port=$port",$userDb, $pass);
                echo "Conectado com sucesso!";
                return $connection;
            }catch(PDOException $ex){
                echo "Erro!! ".$ex->getMessage();
            }
        }
        return self::$connection;
    }
}

?>