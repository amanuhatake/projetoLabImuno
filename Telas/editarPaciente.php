<?php
$id = $_GET['id'] ?? null;
if (!$id) {
    echo "ID do paciente não informado.";
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Location: lista_pacientes.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Editar Paciente - LEAC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <style>
        body { background-color: #f8f9fa; }
        h1 { color: #0c4299; font-weight: bold; }
        .btn-primary { background-color: #0c4299; border-color: #0c4299; }
        .btn-primary:hover { background-color: #092f6b; border-color: #092f6b; }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="text-center mb-4">Editar Paciente</h1>
    <form action="" method="post" class="card p-4 bg-white border border-primary rounded">
        <div class="mb-3">
            <label for="nome" class="form-label">Nome completo:</label>
            <input type="text" id="nome" name="nome" class="form-control" required value="">
        </div>
        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone:</label>
            <input type="tel" id="telefone" name="telefone" class="form-control" required value="">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" id="email" name="email" class="form-control" required value="">
        </div>
        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="lista_pacientes.php" class="btn btn-secondary ms-2">Cancelar</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
