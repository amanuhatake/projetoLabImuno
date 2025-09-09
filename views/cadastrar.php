<?php 
require('conexao.php');

   $nome = filter_input(INPUT_POST, 'nomeUsuario', filter: FILTER_DEFAULT);
   $email = filter_input(INPUT_POST, 'emailUsuario', filter: FILTER_DEFAULT);
   $telefone = filter_input(INPUT_POST, 'telefoneUsuario', filter: FILTER_DEFAULT);
   $cpf = filter_input(INPUT_POST, 'cpfUsuario', filter: FILTER_DEFAULT);
   $registro = filter_input(INPUT_POST, 'registroProfissional', filter: FILTER_DEFAULT);
   $tipoUser = filter_input(INPUT_POST, 'cargoFunc', filter: FILTER_DEFAULT);
   $senha = filter_input(INPUT_POST, 'senha', filter: FILTER_DEFAULT);


   $sql = "INSERT INTO `tabelaadm` (nomeUsuario, emailUsuario, telefoneUsuario, cpfUsuario,registroProfissional, cargoFunc, senha) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $statement = $pdo->prepare($sql);

   try{
    $sql = "INSERT INTO `tabelaadm`(nomeUsuario, emailUsuario, telefoneUsuario, cpfUsuario, registroProfissional, cargoFunc, senha) VALUES ('$nome', '$email', '$telefone','$cpf','$registro','$tipoUser','$senha')";

     $statement->execute([$nome, $email, $telefone, $cpf, $registro, $tipoUser, $senha]);
     header(header:'location: listagem.php');
   } catch(PDOException $e){
    echo'OPS! Aconteceu um erro: ' . $e->getMessage();
    exit();
   }
?>