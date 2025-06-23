<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <title>Cadastro de Paciente</title>
</head>
<body>
    <div class="container">
        <div class="row"> <!-- Linha de cabeçalho da página -->
            <div class="col">
                <h1 class="display-3">Cadastro de Paciente</h1>
            </div>
        </div>
        <!-- Linha do formulário -->
        <div class="row">
            <?php
                require_once '../controller/pacienteController.php';
                include 'cadastroPaciente.php';
            ?>
        </div>
        <div class="row">
            <div class="col mx-4 mt-4">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Registro</th> <th>Nome</th> <th>Sexo</th> <th>Telefone</th> <th>Data</th> <th>periodo</th> <th>nomeMae</th> <th>examesSolicitados</th> <th>Email</th> <th>Data_Nascimento</th><th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- chamar select * from-->
                         <?php
                         if($_SERVER["REQUEST_METHOD"] == "GET"){
                            require_once '../controller/PacienteController.php';
                            listar();
                         }
                         ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</body>
</html>