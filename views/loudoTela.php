<?php
$nome = "EDUARDA CAROLINA DO NASCIMENTO";
$idade = 25;
$data_emissao = date("d/m/Y - H:i");
$sexo = 'Feminino';
$prontuario = "000967696";
$nomesocial = "";
$exame = "TIPAGEM SANGUÍNEA ABO(RH)";
$materialE = "SANGUE TOTAL";
$metodoE = "HEMAGLUTINAÇÃO";
$grupo = 'B';
$fator = 'POSITIVO';
$LiberadoPor = "EDUARDA CAROLINA DO NASCIMENTO";
$CRF = 38691;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Formulário de Exame</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }

    .sidebar {
      height: 100vh;
      width: 60px;
      position: fixed;
      background-color: #002855;
      transition: width 0.3s;
      overflow-x: hidden;
      z-index: 1000;
    }

    .sidebar:hover {
      width: 200px;
    }

    .sidebar .nav-link {
      color: #fff;
      padding: 15px;
      white-space: nowrap;
    }

    .sidebar .nav-link i {
      margin-right: 10px;
    }

    .sidebar .nav-link span {
      display: none;
    }

    .sidebar:hover .nav-link span {
      display: inline;
    }

    .content {
      margin-left: 60px;
      padding: 20px;
      transition: margin-left 0.3s;
    }

    .sidebar:hover ~ .content {
      margin-left: 200px;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar d-flex flex-column align-items-start">
    <a href="#" class="nav-link"><i class="bi bi-gear-fill"></i><span> ADM</span></a>
    <a href="#" class="nav-link"><i class="bi bi-person-fill"></i><span> Paciente</span></a>
    <a href="#" class="nav-link"><i class="bi bi-journal-text"></i><span> Laudo</span></a>
    <a href="#" class="nav-link"><i class="bi bi-file-medical"></i><span> Exames Lab.</span></a>
    <a href="#" class="nav-link"><i class="bi bi-file-earmark-text"></i><span> Exames Solicit.</span></a>
    <a href="#" class="nav-link"><i class="bi bi-question-circle-fill"></i><span> Ajuda</span></a>
    <a href="#" class="nav-link"><i class="bi bi-box-arrow-right"></i><span> Sair</span></a>
  </div>

  <!-- Conteúdo Central -->
  <div class="content d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow p-4" style="width: 100%; max-width: 500px;">
      <h4 class="text-center mb-4">Formulário de Exame</h4>
      <p><strong>Nome:</strong> <?= $nome ?></p>
      <p><strong>Nome Social:</strong> <?= empty($nomesocial) ? '-' : $nomesocial ?></p>
      <p><strong>Idade:</strong> <?= $idade ?></p>
      <p><strong>Sexo:</strong> <?= $sexo ?></p>
      <p><strong>Prontuário:</strong> <?= $prontuario ?></p>
      <p><strong>Data de Emissão:</strong> <?= $data_emissao ?></p>
      <hr>
      <p><strong>Exame:</strong> <?= $exame ?></p>
      <p><strong>Material:</strong> <?= $materialE ?></p>
      <p><strong>Método:</strong> <?= $metodoE ?></p>
      <p><strong>Grupo Sanguíneo:</strong> <?= $grupo ?></p>
      <p><strong>Fator RH:</strong> <?= $fator ?></p>
      <hr>
      <p><strong>Liberado por:</strong> <?= $LiberadoPor ?></p>
      <p><strong>CRF:</strong> <?= $CRF ?></p>
      <div class="d-flex justify-content-between mt-4">
        <button class="btn btn-danger">Editar</button>
        <a href="geradorpdf.php" target="_blank" class="btn btn-success">PDF</a>

      </div>
    </div>
  </div>

</body>
</html>
