<?php
require_once __DIR__ . '/../dao/ConnectionFactory.php';
require_once __DIR__ . '/../dao/PessoaDao.php';
require_once __DIR__ . '/../dao/PacienteDao.php';

require_once __DIR__ . '/../model/Pessoa.php';
require_once __DIR__ . '/../model/Paciente.php';

$pacienteDao = new PacienteDao();
$pessoaDao = new PessoaDao();

// Cadastro de novo paciente
if (isset($_POST['cadastrar'])) {
    $paciente = new Paciente();
    
    $paciente->setRegistro($_POST['registro']);
    $paciente->setData($_POST['data']);
    $paciente->setPeriodo($_POST['periodo']);
    $paciente->setExamesSolicitados($_POST['examesSolicitados']);
    
    $paciente->setNomeCompleto($_POST['nome']);
    $paciente->setDataNascimento($_POST['dataNascimento']);
    $paciente->setTelefone($_POST['telefone']);
    $paciente->setEmail($_POST['email']);
    $paciente->setNomeMae($_POST['nomeMae']);

    $pessoaDao->inserir($paciente);
    $pacienteDao->inserir($paciente);
}

// Edição de paciente (carregar dados para formulário)
if (isset($_GET['editar'])) {
    $registro = $_GET['editar'];
    $paciente = $pacienteDao->buscaPorId($registro);
    if (!isset($paciente)) {
        echo "<p>Paciente de Registro {$registro} não encontrado.</p>";
        header("Location: ../cadastroPaciente.php?erro=nao_encontrado");
        exit;
    }
}

// Salvando a edição
if (isset($_POST['salvar_edicao'])) {
    $paciente = new Paciente();

    $paciente->setRegistro($_POST['registro']);
    $paciente->setData($_POST['data']);
    $paciente->setPeriodo($_POST['periodo']);
    $paciente->setExamesSolicitados($_POST['examesSolicitados']);
    
    $paciente->setNomeCompleto($_POST['nome']);
    $paciente->setDataNascimento($_POST['dataNascimento']);
    $paciente->setTelefone($_POST['telefone']);
    $paciente->setEmail($_POST['email']);
    $paciente->setNomeMae($_POST['nomeMae']);

    $pessoaDao->atualizar($paciente);
    $pacienteDao->atualizar($paciente);

    header("Location: ../cadastroPaciente.php");
    exit;
}

// Função para listar todos os pacientes
function lista()
{
    $pacienteDao = new PacienteDao();
    $lista = $pacienteDao->read();

    echo "<table class='table table-striped mt-4'>";
    echo "<thead><tr>
            <th>Registro</th>
            <th>Nome</th>
            <th>Data</th>
            <th>Período</th>
            <th>Exames Solicitados</th>
            <th>Ações</th>
          </tr></thead><tbody>";

    foreach ($lista as $pac) {
        echo "<tr>
                <td>" . $pac->getRegistro() . "</td>
                <td>" . $pac->getNomeCompleto() . "</td>
                <td>" . $pac->getData() . "</td>
                <td>" . $pac->getPeriodo() . "</td>
                <td>" . $pac->getExamesSolicitados() . "</td>
                <td><a href='cadastroPaciente.php?editar=" . $pac->getRegistro() . "' class='btn btn-sm btn-warning'>Editar</a></td>
              </tr>";
    }

    echo "</tbody></table>";
}
?>
