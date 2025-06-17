<?php
class PacienteDaoSql{
    public function inserir(Paciente $pac){
        try{
            $sql = "INSERT INTO paciente (nome, telefone, data, periodo, nomeMae, examesSolicitados, Email, Data_Nascimento)
                VALUES (:nome, :telefone, :data, :periodo, :nomeMae, :examesSolicitados, :Email, :Data_Nascimento)";
            $conn = ConnectionFactory::getConnection()->prepare($sql);
            $conn->bindValue(":nome", $pac->getNome());
            $conn->bindValue(":telefone", $pac->getTelefone());
            $conn->bindValue(":data", $pac->getData());
            $conn->bindValue(":periodo", $pac->getPeriodo());
            $conn->bindValue(":nomeMae", $pac->getNomeMae());
            $conn->bindValue(":examesSolicitados", $pac->getExamesSolicitados());
            $conn->bindValue(":Email", $pac->getEmail());
            $conn->bindValue(":Data_Nascimento", $pac->getData_Nascimento());

            return $conn->execute(); # executa o insert
        }catch(PDOException $ex){
            echo "<p> Erro </p> <p> $ex </p>";
        }
    }

    // Executa SELECT * FROM no banco
    public function read(){
        try{
            $sql = "SELECT * FROM paciente";
            $conn = ConnectionFactory::getConnection()->query($sql);
            $lista = $conn->fetchAll(PDO::FETCH_ASSOC);
            $pacList = array();
            foreach($lista as $pac){
                $pacList[] = $this->listaPaciente($pac);
            }
            echo "Temos ". count($pacList) . " cadastros no banco";
            return $pacList;
        }catch (PDOException $ex){
            echo "<p>Ocorreu um erro ao executar a consulta </p> {$ex}";
        }
    }

    // Converter uma linha em obj
    public function listaPaciente($row){
        $paciente = new Paciente();
        $paciente->setRegistro($row['registro']);
        $paciente->setNome($row['nome']);
        $paciente->setTelefone($row['telefone']);
        $paciente->setData($row['data']);
        $paciente->setPeriodo($row['periodo']);
        $paciente->setNomeMae($row['nomeMae']);
        $paciente->setExamesSolicitados($row['examesSolicitados']);
        $paciente->setEmail($row['Email']);
        $paciente->setData_Nascimento($row['Data_Nascimento']);
        return $paciente;
    }

    public function editar(Paciente $pac){
        try{
            $sql = "UPDATE paciente SET 
                nome = :nome, telefone = :telefone, data = :data, periodo = :periodo, nomeMae = :nomeMae, examesSolicitados = :examesSolicitados, Email = :Email, Data_Nascimento = :Data_Nascimento WHERE registro = :registro";
            $conn = ConnectionFactory::getConnection()->prepare($sql);
            $conn->bindValue(":nome", $pac->getNome());
            $conn->bindValue(":telefone", $pac->getTelefone());
            $conn->bindValue(":data", $pac->getData());
            $conn->bindValue(":periodo", $pac->getPeriodo());
            $conn->bindValue(":nomeMae", $pac->getNomeMae());
            $conn->bindValue(":examesSolicitados", $pac->getExamesSolicitados());
            $conn->bindValue(":Email", $pac->getEmail());
            $conn->bindValue(":Data_Nascimento", $pac->getData_Nascimento());
            $conn->bindValue(":registro", $pac->getRegistro()); 
            return $conn->execute(); // Executa o update
        }catch(PDOException $ex){
            echo "<p> Erro ao editar </p> <p> $ex </p>";
        }
    }

    public function buscarPorRegistro($registro){
        try{
            $sql = "SELECT * FROM paciente WHERE registro = :registro";
            $conn = ConnectionFactory::getConnection()->prepare($sql);
            $conn->bindValue(":registro", $registro);
            $conn->execute();
            $row = $conn->fetch(PDO::FETCH_ASSOC); // Busca apenas uma linha
            if($row){
                return $this->listaPaciente($row);
            }
            return null; // Retorna null se não encontrar o ID
        }catch(PDOException $ex){
            echo "<p>Erro ao buscar paciente por ID: </p> <p> {$ex->getMessage()} </p>";
            return null;
        }
    }
} // Fecha a classe Dao
?>
