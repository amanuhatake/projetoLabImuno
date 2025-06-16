<?php
require_once '../dao/PessoaDao.php';
require_once '../model/Pessoa.php';

require_once '../dao/ConnectionFactory.php';
require_once '../dao/PacienteDao.php';
require_once '../model/Paciente.php';


if (isset($_POST['cadastrar'])) {
    $pessoa = new Pessoa();
    $pessoa->setNome($_POST['nome']);
    $pessoa->setData_Nascimento($_POST['Data_Nascimento']);
    $pessoa->setTelefone($_POST['telefone']);
    $pessoa->setEmail($_POST['email']);

    $pessoaDao = new PessoaDao();
    $registro = $pessoaDao->inserir($pessoa);

    if ($registro) {
        $paciente = new Paciente();
        $paciente->setRegistro($registro);
        $paciente->setData(date('Y-m-d'));
        $paciente->setPeriodo($_POST['periodo']);
        $paciente->setNomeMae($_POST['nomeMae']); 
        $paciente->setExamesSolicitados(implode(', ', $_POST['exame'] ?? []));

        $pacienteDao = new PacienteDao();
        $pacienteDao->inserir($paciente);
    }

    header("Location: ../Telas/cadastroPaciente.php");
    exit;
}

function lista() {
    $dao = new PacienteDao();
    $pacientes = $dao->read();

    if (empty($pacientes)) {
        echo "<p>Nenhum paciente cadastrado.</p>";
    } else {
        echo "<h3>Lista de Pacientes</h3><ul>";
        foreach ($pacientes as $paciente) {
            echo "<li>" . $paciente . "</li>";
        }
        echo "</ul>";
    }
}
?>
