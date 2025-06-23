<?php
require __DIR__. '/../dao/ConnectionFactory.php';
require __DIR__. '/../model/Paciente.php';
require __DIR__. '/../dao/PacienteDaoSQL.php';


$pacienteDao = new PacienteDaoSQL();

if(isset($_POST['cadastrar'])){
    $paciente = new Paciente();
    $paciente->setNome($_POST['nome']);
    $paciente->setTelefone($_POST['telefone']);
    $paciente->setData($_POST['data']);
    $paciente->setNomeMae($_POST['nomeMae']);
    $paciente->setEmail($_POST['email']);
    $paciente->setData_Nascimento($_POST['Data_Nascimento']);
    $paciente->setPeriodo($_POST['periodo']);
    $paciente->setMedicamento($_POST['medicamento']);
    $paciente->setMedicamentoNome($_POST['medicamentoNome']);
    $paciente->setSexo
    
    
    
    ($_POST['Sexo']);
  
    $exames = isset($_POST['examesSolicitados']) ? $_POST['examesSolicitados'] : [];
    $examesString = implode(',', $exames);
    $paciente->setExamesSolicitados($examesString);


    $pacienteDao->inserir($paciente);
    header("Location: ../views/listarPaciente.php");
    exit();
}

if(isset($_GET['editar'])){
    $registroPaciente = $_GET['editar'];
    
    $paciente = $pacienteDao->buscarPorRegistro($registroPaciente);

    if(!$paciente->getRegistro()){ // Se o ID do objeto $paciente ainda não foi setado
        echo "<p>Paciente não encontrado para edição.</p>";
        header("Location: ../views/listarPaciente.php?erro=nao_encontrado");
        exit();
    }
}

if(isset($_POST['salvar_edicao'])){
    $paciente = new Paciente();
    $paciente->setRegistro($_POST['registro']); // O ID é crucial para o método UPDATE do DAO
    $paciente->setNome($_POST['nome']);
    $paciente->setTelefone($_POST['telefone']);
    $paciente->setData($_POST['data']);
    $paciente->setPeriodo($_POST['periodo']);
    $paciente->setNomeMae($_POST['nomeMae']);
    $paciente->setEmail($_POST['email']);
    $paciente->setData_Nascimento($_POST['Data_Nascimento']);
    $paciente->setMedicamento($_POST['medicamento']);
    $paciente->setMedicamentoNome($_POST['medicamentoNome']);
    $paciente->setSexo($_POST['Sexo']);
    $exames = isset($_POST['examesSolicitados']) ? $_POST['examesSolicitados'] : [];
$examesString = implode(',', $exames);
$paciente->setExamesSolicitados($examesString);

    echo "Controller linha 36";
    $pacienteDao->editar($paciente); // Chama o método editar no DAO

    header("Location: ../views/listarPaciente.php"); // Redireciona de volta para a lista
    exit();
}

function listar(){
    $pacienteDao = new PacienteDaoSQL();
    $lista = $pacienteDao->read();
    foreach($lista as $pac){
        echo "<tr>
        <td> {$pac->getRegistro()} </td>
        <td> {$pac->getNome()}</td>
        <td> {$pac->getTelefone()}</td>
        <td> {$pac->getData()}</td>
        <td> {$pac->getPeriodo()}</td>
        <td> {$pac->getNomeMae()}</td>
        <td> {$pac->getExamesSolicitados()}</td>
        <td> {$pac->getEmail()}</td>
        <td> {$pac->getData_Nascimento()}</td>
        <td> {$pac->getMedicamento()}</td>
        <td> {$pac->getMedicamentoNome()}</td>
        <td> {$pac->getSexo()}</td>
        
        <td> 
            <a href='listarPaciente.php?editar={$pac->getRegistro()}'> 
                <i class='bi bi-pencil-square'></i> 
                Editar</a> 
                <a href='#'> Exluir</a> 
        </td>
    </tr>";
    }
}
//parte Adrian, para atualizar apenas a area de exame!
if (isset($_POST['atualizar_exames'])) {
    $registro = $_POST['registro'];
    $exames = isset($_POST['examesSolicitados']) ? $_POST['examesSolicitados'] : '';

    if (is_array($exames)) {
        $examesString = implode(',', $exames);
    } else {
        $examesString = trim($exames);
    }

    $pacienteDao->atualizarExames($registro, $examesString);

    header("Location: ../views/ListaExames.php?msg=exames_atualizados");
    exit();
}
//parte do Adrian, para mecanismo de busca usado na pagina de exames!
if (isset($_GET['buscar'])) {
        $nomeBusca = $_GET['buscar'];
        $pacientes = $pacienteDao->buscarPorNome($nomeBusca);  // Chama a função de busca no DAO
    } else {
        $pacientes = $pacienteDao->read();  // Lista todos os pacientes
    }
    


?>
