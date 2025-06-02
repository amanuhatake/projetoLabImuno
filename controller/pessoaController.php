<?php
include '../dao/ConnectionPessoa.php';
include '../dao/PessoaDao.php';
include '../model/Pessoa.php';

$pessoa = new Pessoa();
$pessoaDao = new PessoaDao();

if (isset($_POST['cadastrar'])) {
    $pessoa->setNomeCompleto($_POST['nomeCompleto']);
    $pessoa->setDataNascimento($_POST['dataNascimento']);
    $pessoa->setTelefone($_POST['telefone']);
    $pessoa->setEmail($_POST['email']);

    $pessoaDao->inserir($pessoa);
    // header("Location: ../index.php");
}
?>
