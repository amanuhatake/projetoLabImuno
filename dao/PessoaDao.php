<?php

require_once 'pessoa.php';
require_once 'ConnectionPessoa.php';

class PessoaDao {

    public function inserir(Pessoa $pessoa) {
        try {
            $sql = "INSERT INTO pessoa (nome_completo, data_nascimento, telefone, email) 
                    VALUES (:nome_completo, :data_nascimento, :telefone, :email)";
            
            $con_sql = ConnectionPessoa::getConnection()->prepare($sql);
            $con_sql->bindValue(":nome_completo", $pessoa->getNomeCompleto());
            $con_sql->bindValue(":data_nascimento", $pessoa->getDataNascimento());
            $con_sql->bindValue(":telefone", $pessoa->getTelefone());
            $con_sql->bindValue(":email", $pessoa->getEmail());

            return $con_sql->execute();
        } catch (PDOException $ex) {
            echo "<p>Erro ao inserir Pessoa no banco de dados!</p> $ex";
            return false;
        }
    }

    public function read() {
        try {
            $sql = "SELECT * FROM pessoa";
            $con_sql = ConnectionPessoa::getConnection()->query($sql);
            $lista = $con_sql->fetchAll(PDO::FETCH_ASSOC);
            $pessoaList = [];

            foreach ($lista as $linha) {
                $pessoaList[] = $this->mapearPessoa($linha);
            }

            echo "Temos " . count($pessoaList) . " pessoas cadastradas";
            return $pessoaList;

        } catch (PDOException $ex) {
            echo "<p>Ocorreu um erro ao selecionar pessoas</p> $ex";
            return [];
        }
    }

    private function mapearPessoa($linha) {
        $pessoa = new Pessoa(
            $linha['nome_completo'],
            $linha['data_nascimento'],
            $linha['telefone'],
            $linha['email']
        );
        return $pessoa;
    }
}
?>
