<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pacientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f8f9fa;
        }

        h1 {
            color: #0c4299;
            font-weight: bold;
        }

        .card {
            background-color: white;
            border: 2px solid #0c4299;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        label {
            font-weight: 500;
        }

        button.btn-primary {
            background-color: #0c4299;
            border-color: #0c4299;
        }

        button.btn-primary:hover {
            background-color: #092f6b;
            border-color: #092f6b;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
      <?php
      include 'formPaciente.php'
      ?>
      
    </div>

    <script>
        // Mostrar campo de medicamento se a resposta for "Sim"
        const medicamentoSim = document.getElementById('medicamentoSim');
        const medicamentoNao = document.getElementById('medicamentoNao');
        const medicamentoNome = document.getElementById('medicamentoNome');

        medicamentoSim.addEventListener('change', function() {
            medicamentoNome.style.display = 'block';
        });

        medicamentoNao.addEventListener('change', function() {
            medicamentoNome.style.display = 'none';
        });
    </script>
</body>
</html>
