<?php
class ConnectionFactory {
    private static $connection; // Corrigido para private e static

    public static function getConnection() {
        if (!isset(ConnectionFactory::$connection)) { // Usando o nome da classe para acessar a variável estática
            $port = 3307; // Porta do SGBD
            $dbName = "aula0605"; // Nome do banco de dados
            $userDb = "root"; // Usuário do banco
            $host = "localhost"; // Local de hospedagem do SGBD
            $pass = "";

            try {
                ConnectionFactory::$connection = new PDO("mysql:host=$host;dbname=$dbName;port=$port", $userDb, $pass);
                echo "Conectado com sucesso!";
            } catch (PDOException $ex) {
                echo "Erro!! " . $ex->getMessage();
            }
        }
        return ConnectionFactory::$connection; // Retorna a conexão estática
    }
}