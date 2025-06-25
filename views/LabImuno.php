<!DOCTYPE html>
<html lang="pt-BR">
<!--CALVIN-->
<head>
  <meta charset="UTF-8">
  <title>Laboratório de Imunologia</title>
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
    <h1 class="text-center mb-4 text-leac">Laboratório de Imunologia</h1>

    <form action="../controller/labImunoController.php" method="post">
      <!-- INPUT ESCONDIDO PARA INFORMAR A AÇÃO -->
      <input type="hidden" name="acao" value="inserir">

      <div class="row g-3">
        <div class="col-md-6">
          <label class="form-label">Nome do Paciente:</label>
          <input type="text" class="form-control" name="nome_paciente">
        </div>
        <div class="col-md-6">
          <label class="form-label">Número de registro:</label>
          <!-- Corrigido o name para "numero_registro" -->
          <input type="text" class="form-control" name="numero_registro">
        </div>
        <div class="col-md-6">
          <label class="form-label">Lote de lugol:</label>
          <input type="text" class="form-control" name="lote_lugol">
        </div>
        <div class="col-md-6">
          <label class="form-label">Validade do Lugol:</label>
          <input type="text" class="form-control" name="validade_lugol">
        </div>
        <div class="col-md-6">
          <label class="form-label">Entrada:</label>
          <input type="text" class="form-control" name="entrada">
        </div>
        <div class="col-md-6">
          <label class="form-label">Centrífuga Utilizada:</label>
          <input type="text" class="form-control" name="centrifuga">
        </div>
        <div class="col-md-6">
          <label class="form-label">Data e hora de realização do exame:</label>
          <input type="datetime-local" class="form-control" name="data_exame">
        </div>
        <div class="col-md-6">
          <label class="form-label">Data prevista para entrega do laudo:</label>
          <input type="date" class="form-control" name="data_entrega">
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
              <td><input type="text" class="form-control" name="tubo_lote"></td>
              <td><input type="text" class="form-control" name="tubo_validade"></td>
            </tr>
            <tr>
              <td>Anti - A</td>
              <td><input type="text" class="form-control" name="anti_a_lote"></td>
              <td><input type="text" class="form-control" name="anti_a_validade"></td>
            </tr>
            <tr>
              <td>Anti - B</td>
              <td><input type="text" class="form-control" name="anti_b_lote"></td>
              <td><input type="text" class="form-control" name="anti_b_validade"></td>
            </tr>
            <tr>
              <td>Anti - D</td>
              <td><input type="text" class="form-control" name="anti_d_lote"></td>
              <td><input type="text" class="form-control" name="anti_d_validade"></td>
            </tr>
            <tr>
              <td>Água destilada esterilizada</td>
              <td><input type="text" class="form-control" name="agua_lote"></td>
              <td><input type="text" class="form-control" name="agua_validade"></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="text-center mt-4">
        <input type="submit" class="btn btn-leac" value="Salvar">
      </div>
    </form>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
