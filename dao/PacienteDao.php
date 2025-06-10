<?php

require_once __DIR__ . '/../model/Paciente.php';
require_once __DIR__ . '/ConnectionFactory.php';

class PacienteDao {

    public function inserir(Paciente $paciente) {
        try {
            $sql = "INSERT INTO paciente (registro, data, periodo, exames_solicitados)
                    VALUES (:registro, :data, :periodo, :exames_solicitados)";
            $con = ConnectionFactory::getConnection()->prepare($sql);

            $con->bindValue(":registro", $paciente->getRegistro());
            $con->bindValue(":data", $paciente->getData());
            $con->bindValue(":periodo", $paciente->getPeriodo());
            $con->bindValue(":exames_solicitados", $paciente->getExamesSolicitados());

            return $con->execute();
        } catch (PDOException $e) {
            echo "Erro ao inserir paciente: " . $e->getMessage();
            return false;
        }
    }

    public function read() {
        try {
            $sql = "SELECT * FROM paciente";
            $stmt = ConnectionFactory::getConnection()->query($sql);
            $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $pacientes = [];

            foreach ($dados as $linha) {
                $paciente = new Paciente();
                $paciente->setRegistro($linha['registro']);
                $paciente->setData($linha['data']);
                $paciente->setPeriodo($linha['periodo']);
                $paciente->setExamesSolicitados($linha['exames_solicitados']);
                $pacientes[] = $paciente;
            }

            return $pacientes;
        } catch (PDOException $e) {
            echo "Erro ao listar pacientes: " . $e->getMessage();
            return [];
        }
    }

    public function buscaPorId($registro) {
        try {
            $sql = "SELECT * FROM paciente WHERE registro = :registro";
            $con = ConnectionFactory::getConnection()->prepare($sql);
            $con->bindValue(":registro", $registro);
            $con->execute();

            $linha = $con->fetch(PDO::FETCH_ASSOC);
            if (!$linha) return null;

            $paciente = new Paciente();
            $paciente->setRegistro($linha['registro']);
            $paciente->setData($linha['data']);
            $paciente->setPeriodo($linha['periodo']);
            $paciente->setExamesSolicitados($linha['exames_solicitados']);
            return $paciente;

        } catch (PDOException $e) {
            echo "Erro ao buscar paciente: " . $e->getMessage();
            return null;
        }
    }

    public function atualizar(Paciente $paciente) {
        try {
            $sql = "UPDATE paciente SET data = :data, periodo = :periodo, exames_solicitados = :exames_solicitados 
                    WHERE registro = :registro";
            $con = ConnectionFactory::getConnection()->prepare($sql);

            $con->bindValue(":registro", $paciente->getRegistro());
            $con->bindValue(":data", $paciente->getData());
            $con->bindValue(":periodo", $paciente->getPeriodo());
            $con->bindValue(":exames_solicitados", $paciente->getExamesSolicitados());

            return $con->execute();
        } catch (PDOException $e) {
            echo "Erro ao atualizar paciente: " . $e->getMessage();
            return false;
        }
    }
}
