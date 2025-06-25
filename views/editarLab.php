<?php
require_once __DIR__ . '/../dao/labImunoDAO.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $dao = new LabImunoDAO();
    $exame = $dao->buscarExamePorId($id);

    if (!$exame) {
        echo "Exame não encontrado.";
        exit;
    }
} else {
    echo "ID do exame não informado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Editar Exame - Laboratório de Imunologia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        .bg-leac { background-color: #0c4299; }
        .text-leac { color: #0c4299; }
        .btn-leac { background-color: #0c4299; color: white; }
        .btn-leac:hover { background-color: #083b7a; }
        .border-leac { border: 2px solid #0c4299; }
        .table th, .table td { vertical-align: middle; }
    </style>
</head>
<body class="bg-light p-4">
  <div class="container bg-white p-4 rounded shadow-sm border-leac">
    <h1 class="text-center mb-4 text-leac">Editar Exame</h1>

    <form action="../controller/labImunoController.php" method="POST">
      <input type="hidden" name="id" value="<?php echo htmlspecialchars($exame['id']); ?>" />

      <div class="row g-3">
        <div class="col-md-6">
          <label for="nome_paciente" class="form-label">Nome do Paciente:</label>
          <input type="text" class="form-control" id="nome_paciente" name="nome_paciente" 
                 value="<?php echo htmlspecialchars($exame['nome_paciente']); ?>" required />
        </div>

        <div class="col-md-6">
          <label for="numero_registro" class="form-label">Número de registro:</label>
          <input type="text" class="form-control" id="numero_registro" name="numero_registro" 
                 value="<?php echo htmlspecialchars($exame['numero_registro']); ?>" required />
        </div>

        <div class="col-md-6">
          <label for="lote_lugol" class="form-label">Lote de lugol:</label>
          <input type="text" class="form-control" id="lote_lugol" name="lote_lugol" 
                 value="<?php echo htmlspecialchars($exame['lote_lugol']); ?>" />
        </div>

        <div class="col-md-6">
          <label for="validade_lugol" class="form-label">Validade do Lugol:</label>
          <input type="text" class="form-control" id="validade_lugol" name="validade_lugol" 
                 value="<?php echo htmlspecialchars($exame['validade_lugol']); ?>" />
        </div>

        <div class="col-md-6">
          <label for="entrada" class="form-label">Entrada:</label>
          <input type="text" class="form-control" id="entrada" name="entrada" 
                 value="<?php echo htmlspecialchars($exame['entrada']); ?>" />
        </div>

        <div class="col-md-6">
          <label for="centrifuga" class="form-label">Centrífuga Utilizada:</label>
          <input type="text" class="form-control" id="centrifuga" name="centrifuga" 
                 value="<?php echo htmlspecialchars($exame['centrifuga']); ?>" />
        </div>

        <div class="col-md-6">
          <label for="data_exame" class="form-label">Data e hora de realização do exame:</label>
          <input type="datetime-local" class="form-control" id="data_exame" name="data_exame" 
                 value="<?php echo date('Y-m-d\TH:i', strtotime($exame['data_exame'])); ?>" />
        </div>

        <div class="col-md-6">
          <label for="data_entrega" class="form-label">Data prevista para entrega do laudo:</label>
          <input type="date" class="form-control" id="data_entrega" name="data_entrega" 
                 value="<?php echo htmlspecialchars($exame['data_entrega']); ?>" />
        </div>
      </div>

      <h2 class="mt-5 mb-3 text-leac">Tipagem Sanguínea</h2>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead class="table-light">
            <tr>
              <th>Reagente</th>
              <th>Lote</th>
              <th>Validade</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Tubo de ensaio esterilizado</td>
              <td><input type="text" class="form-control" name="tubo_lote" value="<?php echo htmlspecialchars($exame['tubo_lote']); ?>" /></td>
              <td><input type="text" class="form-control" name="tubo_validade" value="<?php echo htmlspecialchars($exame['tubo_validade']); ?>" /></td>
            </tr>
            <tr>
              <td>Anti - A</td>
              <td><input type="text" class="form-control" name="anti_a_lote" value="<?php echo htmlspecialchars($exame['anti_a_lote']); ?>" /></td>
              <td><input type="text" class="form-control" name="anti_a_validade" value="<?php echo htmlspecialchars($exame['anti_a_validade']); ?>" /></td>
            </tr>
            <tr>
              <td>Anti - B</td>
              <td><input type="text" class="form-control" name="anti_b_lote" value="<?php echo htmlspecialchars($exame['anti_b_lote']); ?>" /></td>
              <td><input type="text" class="form-control" name="anti_b_validade" value="<?php echo htmlspecialchars($exame['anti_b_validade']); ?>" /></td>
            </tr>
            <tr>
              <td>Anti - D</td>
              <td><input type="text" class="form-control" name="anti_d_lote" value="<?php echo htmlspecialchars($exame['anti_d_lote']); ?>" /></td>
              <td><input type="text" class="form-control" name="anti_d_validade" value="<?php echo htmlspecialchars($exame['anti_d_validade']); ?>" /></td>
            </tr>
            <tr>
              <td>Água destilada esterilizada</td>
              <td><input type="text" class="form-control" name="agua_lote" value="<?php echo htmlspecialchars($exame['agua_lote']); ?>" /></td>
              <td><input type="text" class="form-control" name="agua_validade" value="<?php echo htmlspecialchars($exame['agua_validade']); ?>" /></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="text-center mt-4">
        <input type="submit" class="btn btn-leac" name="acao" value="atualizar" />
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
