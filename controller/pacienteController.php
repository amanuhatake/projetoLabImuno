<?php
include __DIR__.'/../dao/ConnectionPaciente.php';
include __DIR__.'/../dao/PacienteDao.php';
include __DIR__.'/../model/Paciente.php';

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

$paciente = new Paciente() {

    $pacinte->setRegistro($_POST['registro']);
    $paciente->setData($_POST['data']);
    $paciente->setPeriodo($_POST['periodo']);
    $paciente->setExamesSolicitados($_POST['examesSolicitados']);
    $pacienteDao->inserir($paciente);
    //header("Location: ../index.php");
}
//add isso
 function lista(){
    $pacienteteDao = new PacienteDao();
    $lista = $pacienteDao->read();
    foreach($lista as $pac){
            echo "<tr>
             <td> . $fab->getRegistro() . </td>;
             <td> . $fab->getData() . </td>;
             <td>. $fab->getPeriodo() . </td>;
             <td> . $fab->getExamesSolicitados() . </td>;
             <td>
             <a href=''cadastroPaciente.php?editar={$paciente->getRegistro()}>Editar</a>;
             </td>
         </tr>";
    }
 }
?>
