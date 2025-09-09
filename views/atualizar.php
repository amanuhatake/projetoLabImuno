<?php
// Inclui o arquivo de conexão com o banco de dados
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: listagem.php');
    exit;
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
$nome = filter_input(INPUT_POST, 'nomeUsuario', FILTER_SANITIZE_SPECIAL_CHARS);
$email = filter_input(INPUT_POST, 'emailUsuario', FILTER_VALIDATE_EMAIL);
$telefone = filter_input(INPUT_POST, 'telefoneUsuario', FILTER_SANITIZE_SPECIAL_CHARS);
$cpf = filter_input(INPUT_POST, 'cpfUsuario', FILTER_SANITIZE_SPECIAL_CHARS);
$registro = filter_input(INPUT_POST, 'registroProfissional', FILTER_SANITIZE_SPECIAL_CHARS);
$tipoUser = filter_input(INPUT_POST, 'cargoFunc', FILTER_SANITIZE_SPECIAL_CHARS);
$senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);


exit;
// Validação básica dos campos obrigatórios
if (empty($id) || empty($nome) || empty($email) || empty($telefone)|| empty($cpf) || empty($registro) || empty($tipoUser)) {
    die("Erro: Dados do formulário incompletos ou inválidos.");
}

try {
    
    $sql = "UPDATE `tabelaadm` SET nomeUsuario = ?, emailUsuario = ?, telefoneUsuario = ?, cpfUsuario = ?, registroProfissional = ?, cargoFunc = ?";
    

    $params = [$nome, $email, $telefone, $cpf, $registro, $tipoUser];

  
    if (!empty($senha)) {
        // Gera um hash seguro para a nova senha
        $hashed_senha = password_hash($senha, PASSWORD_DEFAULT);
        $sql .= ", senha = ?";
        $params[] = $hashed_senha;
    }

 
    $sql .= " WHERE id = ?";
    $params[] = $id;

   
    $statement = $pdo->prepare($sql);
    $statement->execute($params);

    // Redireciona de volta para a listagem após a atualização bem-sucedida
    header('Location: listagem.php?status=success');
    exit;
} catch (PDOException $e) {
    // Em caso de erro, exibe uma mensagem
    die('OPS! Aconteceu um erro ao atualizar o usuário: ' . $e->getMessage());

?>

