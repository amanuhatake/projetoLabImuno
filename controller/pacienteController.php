<?php
include '../dao/ConnectionPaciente.php';
include '../dao/PacienteDao.php';
include '../model/Paciente.php';

$paciente = new Paciente();
$pacienteDao = new PacienteDao();

if(isset($_POST['cadastrar'])){
    $paciente->setRegistro($_POST['registro']);
    $paciente->setData($_POST['data']);
    $paciente->setPeriodo($_POST['periodo']);
    $paciente->setExamesSolicitados($_POST['examesSolicitados']);
    $pacienteDaoDao->inserir($paciente);
    //header("Location: ../index.php");
}
?>
