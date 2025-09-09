<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('conexao.php');

$id = filter_input(INPUT_GET, 'id', FILTER_DEFAULT);
if (empty($id)) {
    echo "ID do usuário não fornecido!";
    exit;
}

$sql = "SELECT * FROM `tabelaadm` WHERE id= ?";
$statement = $pdo->prepare($sql);
$statement-> execute([$id]);
$resultado = $statement->fetch((PDO::FETCH_ASSOC));

if (!$resultado) {
   echo "Usuário não encontrado!";
    exit; 
}


?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário - LabImuno</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../styles/controleUser.css">
</head>

<body>

    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="logo">LabImun</div>
            <ul class="list-unstyled components">
                <li class="nav-item">
                    <a class="nav-link" href="../views/telaHomeLab.html">
                        <i class="bi bi-grid-fill"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="../database/listagem.php">
                        <i class="bi bi-people-fill"></i> <span>Usuários</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-journal-medical"></i> <span>Exames</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-gear-fill"></i> <span>Configurações</span>
                    </a>
                </li>
                <hr class="mx-3 my-2" style="border-color: rgba(255,255,255,0.1);">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-box-arrow-right"></i> <span>Sair</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Conteúdo -->
        <div id="content">
            <button type="button" id="sidebar-toggle" class="btn btn-outline-secondary">
                <i class="bi bi-list"></i>
            </button>

            <div class="container-fluid">
                <h3 class="mb-4 mt-3">Editar Usuário</h3>

                <div class="card shadow-sm p-4">
                    <form action="atualizar.php" method="POST"> 
                        <input type="hidden" name="id" value="<?php echo $resultado['id']; ?>">

                        <div class="mb-3">
                            <label for="nomeUsuario" class ="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="nomeUsuario" name="nomeUsuario" value="<?= $resultado['nomeUsuario']?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="emailUsuario" class="form-label">Email</label>
                            <input type="email" class="form-control" id="emailUsuario" name="emailUsuario" value="<?= $resultado['emailUsuario']?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="telefoneUsuario" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="telefoneUsuario" name="telefoneUsuario" value="<?= $resultado['telefoneUsuario']?>">
                        </div>

                        <div class="mb-3">
                            <label for="cpfUsuario" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="cpfUsuario" name="cpfUsuario" value="<?= $resultado['cpfUsuario']?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="registroProfissional" class="form-label">Registro Profissional</label>
                            <input type="text" class="form-control" id="registroProfissional" name="registroProfissional" value="<?= $resultado['registroProfissional']?>">
                        </div>

                        <div class="mb-3">
                            <label for="cargoFunc" class="form-label">Tipo de Usuário</label>
                            <select class="form-select" id="cargoFunc" name="cargoFunc" required>
                                <option value="">Selecione...</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Biomédico">Biomédico</option>
                                <option value="Técnico">Técnico</option>
                                <option value="Recepção">Recepção</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="senha" name="senha">
                            <small class="text-muted">Deixe em branco para não alterar a senha.</small>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="listagem.php" class="btn btn-secondary">Cancelar</a>
                            <button type="submit" name="submit" class="btn btn-primary">Salvar Alterações</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle Sidebar
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const sidebarToggle = document.getElementById('sidebar-toggle');

        sidebarToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
            content.style.marginLeft = sidebar.classList.contains('active') ? '0' : '250px';
            sidebarToggle.style.left = sidebar.classList.contains('active') ? '10px' : '260px';
        });
    </script>

</body>
</html>
