<?php
//CALVIN 
require_once '../dao/labImunoDAO.php';

$dao = new LabImunoDAO();
$exames = $dao->listarTodos();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Exames - Laboratório de Imunologia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .bg-leac { background-color: #0c4299; }
        .text-leac { color: #0c4299; }
        .btn-leac { background-color: #0c4299; color: white; }
        .btn-leac:hover { background-color: #083b7a; }
        .table th, .table td { vertical-align: middle; }
        .border-leac { border: 2px solid #0c4299; }
    </style>
</head>
<body class="bg-light p-4">

<div class="container bg-white p-4 rounded shadow-sm border-leac">
    <h1 class="text-center mb-4 text-leac">Lista de Exames Cadastrados</h1>

    <a href="labImuno.php" class="btn btn-leac mb-3">Novo Exame</a>

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Nome do Paciente</th>
                <th>Número de Registro</th>
                <th>Data do Exame</th>
                <th>Data de Entrega</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($exames) > 0): ?>
                <?php foreach ($exames as $exame): ?>
                    <tr>
                        <td><?= htmlspecialchars($exame['id']) ?></td>
                        <td><?= htmlspecialchars($exame['nome_paciente']) ?></td>
                        <td><?= htmlspecialchars($exame['numero_registro']) ?></td>
                        <td><?= htmlspecialchars($exame['data_exame']) ?></td>
                        <td><?= htmlspecialchars($exame['data_entrega']) ?></td>
                        <td>
                            <a href="editarLab.php?id=<?= $exame['id'] ?>" class="btn btn-sm btn-leac">Editar</a>
                            <!-- Aqui você pode adicionar um botão de excluir depois -->
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Nenhum exame cadastrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
