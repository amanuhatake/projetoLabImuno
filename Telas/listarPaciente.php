<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Lista de Pacientes - LEAC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <style>
        body { background-color: #f8f9fa; }
        h1 { color: #0c4299; font-weight: bold; }
        .btn-primary { background-color: #0c4299; border-color: #0c4299; }
        .btn-primary:hover { background-color: #092f6b; border-color: #092f6b; }
        .btn-danger { background-color: #cc0000; border-color: #cc0000; }
        .btn-danger:hover { background-color: #990000; border-color: #990000; }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4 text-center">Lista de Pacientes</h1>
    <div class="mb-3 text-end">
        <a href="cadastroPaciente.php" class="btn btn-primary">Cadastrar Novo Paciente</a>
    </div>
    <table class="table table-striped table-bordered bg-white">
        <thead class="table-primary">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Telefone</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>João da Silva</td>
                <td>(11) 91234-5678</td>
                <td>joao@email.com</td>
                <td>
                    <a href="editarPaciente.php?id=1" class="btn btn-sm btn-primary">Editar</a>
                    <a href="excluirPaciente.php?id=1" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Maria Oliveira</td>
                <td>(21) 97654-3210</td>
                <td>maria@email.com</td>
                <td>
                    <a href="editarPaciente.php?id=2" class="btn btn-sm btn-primary">Editar</a>
                    <a href="excluirPaciente.php?id=2" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
