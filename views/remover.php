<?php
// Inclui o arquivo de conexão com o banco de dados
require 'conexao.php';


try{
    $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    $sql = "DELETE FROM `tabelaadm` WHERE id = $id";

    $statement = $pdo->prepare($sql);
    header('location: listagem.php');

} catch (PDOException $e) {
    // Em caso de erro, exibe uma mensagem
    die('OPS! Aconteceu um erro ao atualizar o usuário: ' . $e->getMessage());
}
?>