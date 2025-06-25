<?php
class Conexao {
    private $host = 'localhost';
    private $dbname = 'labimuno';
    private $usuario = 'root';
    private $senha = '';
    private $conexao;

    public function __construct() {
        try {
            $this->conexao = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->usuario,
                $this->senha,
                array(
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                )
            );
        } catch (PDOException $e) {
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }

    public function getConexao() {
        return $this->conexao;
    }

    public function fecharConexao() {
        $this->conexao = null;
    }
}
?>