<?php
include __DIR__.'/../dao/ConnectionPaciente.php';
include __DIR__.'/../dao/PacienteDao.php';
include __DIR__.'/../model/Paciente.php';


$pacienteDao = new PacienteDao();

if(isset($_POST['cadastrar'])){
    $paciente->setRegistro($_POST['registro']);
    $paciente->setData($_POST['data']);
    $paciente->setPeriodo($_POST['periodo']);
    $paciente->setExamesSolicitados($_POST['examesSolicitados']);
    $pacienteDaoDao->inserir($paciente);
    //header("Location: ../index.php");
}
if(isset($_GET['editar'])){
    $registro = $_GET['editar'];
    $paciente = $pacienteDao->buscaPorId($registro);
    if(!isset($paciente)){
        echo "<p>Paciente de Registro {$registro} não encontrado. </p>";
        header("Location: ../cadastroPaciente.php?erro=nao_encontrado");
    }
}

if(isset($_POST['salvar_edicao'])){
    $pacinte->setRegistro($_POST['registro']);
    $paciente->setData($_POST['data']);
    $paciente->setPeriodo($_POST['periodo']);
    $paciente->setExamesSolicitados($_POST['examesSolicitados']);
    $pacienteDao->inserir($paciente);
    header("Location: ../cadastroPaciente.php");
}
//add isso
 function lista(){
    $pacienteteDao = new PacienteDao();
    $lista = $PacienteDao->read();
    foreach($lista as $pac){
            echo "<tr>
             <td> . $pac->getRegistro() . </td>;
             <td> . $pac->getData() . </td>;
             <td>. $pac->getPeriodo() . </td>;
             <td> . $pac->getExamesSolicitados() . </td>;
             <td>
             <a href=''cadastroPaciente.php?editar={$paciente->getRegistro()}>Editar</a>;
             </td>
         </tr>";
    }
 }
?>
