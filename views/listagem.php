<?php
include 'conexao.php';

//$buscar_cadastros = "SELECT * FROM table"
//$sql = "SELECT * FROM `usuario`";
$sql = "SELECT id, nomeUsuario, emailUsuario, cpfUsuario, telefoneUsuario, registroProfissional, cargoFunc FROM `tabelaadm`";
$statement = $pdo->prepare($sql);
$statement->execute();
$resultado = $statement->fetchAll((PDO::FETCH_ASSOC));
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Usuários - LabImuno</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../styles/controleUser.css">

</head>

<body>

    <div class="wrapper">
        <nav id="sidebar">
            <div class="logo">LabImun</div>
            <ul class="list-unstyled components">
                <li class="nav-item">
                    <a class="nav-link" href="../views/telaHomeLab.html">
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">
                        <i class="bi bi-people-fill"></i>
                        <span>Usuários</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-journal-medical"></i>
                        <span>Exames</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-gear-fill"></i>
                        <span>Configurações</span>
                    </a>
                </li>
                <hr class="mx-3 my-2" style="border-color: rgba(255,255,255,0.1);">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Sair</span>
                    </a>
                </li>
            </ul>
        </nav>

        <div id="content">
            <button type="button" id="sidebar-toggle" class="btn btn-outline-secondary">
                <i class="bi bi-list"></i>
            </button>

            <div class="container-fluid">
                <h3 class="mb-4 mt-3">Gerenciamento de Usuários</h3>

                <div class="row g-4 mb-5">
                    <div class="col-md-3">
                        <div class="summary-card">
                            <div class="summary-icon bg-primary"><i class="bi bi-person-check-fill"></i></div>
                            <div>
                                <p class="summary-title mb-1">Usuários Ativos</p>
                                <h2 class="summary-value text-primary">12</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="summary-card">
                            <div class="summary-icon bg-secondary"><i class="bi bi-person-x-fill"></i></div>
                            <div>
                                <p class="summary-title mb-1">Usuários Inativos</p>
                                <h2 class="summary-value text-secondary">3</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="summary-card">
                            <div class="summary-icon bg-success"><i class="bi bi-person-badge-fill"></i></div>
                            <div>
                                <p class="summary-title mb-1">Total de Funcionários</p>
                                <h2 class="summary-value text-success">15</h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="summary-card">
                            <div class="summary-icon bg-warning"><i class="bi bi-person-plus-fill"></i></div>
                            <div>
                                <p class="summary-title mb-1">Cadastrar Novo</p>
                                <button class="btn btn-sm btn-outline-warning mt-2" data-bs-toggle="modal"
                                    data-bs-target="#userModal" onclick="prepareModal('add')">
                                    Novo Usuário
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="data-table-container">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Lista de Usuários</h5>
                        <div class="input-group" style="width: 300px;">
                            <input type="text" class="form-control" placeholder="Buscar por nome ou email...">
                            <button class="btn btn-outline-primary" type="button"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>CPF</th>
                                    <th>Reg. Profissional</th>
                                    <th>Tipo</th>
                                    <th style="text-align: center;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                     <?php
                                         foreach ($resultado as $row): ?>
                                         <tr>
                                                <td><?php echo $row['nomeUsuario']; ?></td>
                                                <td><?php echo $row['emailUsuario']; ?></td>
                                                <td><?php echo $row['telefoneUsuario']; ?></td>
                                                <td><?php echo $row['cpfUsuario']; ?></td>
                                                <td><?php echo $row['registroProfissional']; ?></td>
                                                <td><?php echo $row['cargoFunc']; ?></td>
                                                <td class="d-flex justify-content-center gap-3">
                                                    <a class="btn btn-sm btn-warning" href="editar.php?id=<?= $row['id']?>">Editar</a>
                                                    <a class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja remover este usuário?');" href="remover.php?id=<?= $row['id']?>">Remover</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="userForm" action="../database/cadastrar.php" method="POST">
                        <input type="hidden" name="id">
                        <div class="mb-3">
                            <label for="userName" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="userName" name="nomeUsuario"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="userEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="userEmail" name="emailUsuario" required>
                        </div>
                        <div class="mb-3">
                            <label for="userPhone" class="form-label">Telefone</label>
                            <input type="text" class="form-control" id="userPhone" name="telefoneUsuario">
                        </div>
                        <div class="mb-3">
                            <label for="userCpf" class="form-label">CPF</label>
                            <input type="text" class="form-control" id="userCpf" name="cpfUsuario" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="userRegistro" class="form-label">Registro Profissional</label>
                            <input type="text" class="form-control" id="userRegistro" name="registroProfissional">
                        </div>

                        <div class="mb-3">
                            <label for="userType" class="form-label">Tipo de Usuário</label>
                            <select class="form-select" id="cargoFunc" name="cargoFunc" required>
                                <option value="">Selecione...</option>
                                <option value="Administrador">Administrador</option>
                                <option value="Biomédico">Biomédico</option>
                                <option value="Técnico">Técnico</option>
                                <option value="Recepção">Recepção</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="userPassword" class="form-label">Senha</label>
                            <input type="password" class="form-control" id="userPassword" name="senha" required>
                            <small class="text-muted">Deixe em branco para não alterar a senha.</small>
                        </div>
                        <button type="submit" class="btn btn-primary w-100" id="submitBtn">Salvar</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Função para preparar o modal de acordo com a ação (adicionar ou editar)
        function prepareModal(action, id = '', name = '', email = '', cpf = '', phone = '', registro = '', type = '') {
            const modalTitle = document.getElementById('userModalLabel');
            const submitBtn = document.getElementById('submitBtn');
            const userIdInput = document.getElementById('userId');
            const userNameInput = document.getElementById('userName');
            const userEmailInput = document.getElementById('userEmail');
            const userPhoneInput = document.getElementById('userPhone');
            const userCpfInput = document.getElementById('userCpf');
            const userRegistroInput = document.getElementById('userRegistro')
            const userTypeSelect = document.getElementById('userType');
            const userPasswordInput = document.getElementById('userPassword');

            // Limpa o formulário antes de preencher
            document.getElementById('userForm').reset();

            if (action === 'add') {
                modalTitle.textContent = 'Adicionar Novo Usuário';
                submitBtn.textContent = 'Cadastrar Usuário';
                userPasswordInput.required = true;
            } else if (action === 'edit') {
                modalTitle.textContent = `Editar Usuário ${name}`;
                submitBtn.textContent = 'Salvar Alterações';
                userIdInput.value = id;
                userNameInput.value = name;
                userEmailInput.value = email;
                userPhoneInput.value = phone;
                userCpfInput.value = cpf;
                userRegistroInput.value = registro;
                userTypeSelect.value = type;
                userPasswordInput.required = false;
            }
        }

        // Toggle da Sidebar
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