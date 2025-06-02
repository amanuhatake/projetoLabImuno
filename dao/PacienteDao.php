<?php

class PacienteDao{

    public function inserir(Paciente $pac){
        try{
             $sql = "INSERT INTO paciente (registro, data, periodo, examesSolicitados)
             VALUES (:registro, :data, :periodo, :nomeMae, :examesSolicitados);";
             $con_sql = ConnectionPaciente::getConnection()->prepare($sql);
             $con_sql->bindValue(":Registro", $pac->getregistro());
             $con_sql->bindValue(":Data", $pac->getdata());
             $con_sql->bindValue(":Periodo", $pac->getperiodo());
             $con_sql->bindValue(": nomeMae", $pac->getnomeMae());
             return $con_sql->execute();
         } catch(PDOException $ex){
            echo "<p> Erro ao inserir Paciente no banco de dados!</p> $ex";
        }
    }
     // Executa SELECT * FROM paciente
    public function read(){
        try{
            $sql = "SELECT * FROM paciente";
            $con_sql = ConnectionPaciente::getConnection()->query($sql);
            $lista = $con_sql->fetchAll(PDO::FETCH_ASSOC);
            $pacList = array();
            foreach($lista as $linha){
                $pacList[] = $this->listaPacientes($linha);
            }
             echo "Temos ". count($pacList). " pacientes cadastrados";
            return $pacList;
        }catch(PDOException $ex){
            echo "<p> Ocorreu um erro ao selecionar pacientes </p> $ex";
        }
    }
    public function listaPacientes($linha){
        $paciente = new Paciente();
        $paciente->setRegistro($linha['registro']);
        $paciente->setData($linha['data']);
        $paciente->setPeriodo($linha['periodo']);
        $paciente->setExamesSolicitados($linha['examesSolicitados']);
        return $paciente;
    }
}

?>