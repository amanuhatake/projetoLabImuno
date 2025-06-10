<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Cadastro de Pacientes - LEAC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
</head>
<body class="bg-light">

<div class="container mt-5">
    <form action="ControllerPaciente.php" method="post">
        <h1 class="text-center">Cadastro de Pacientes - LEAC</h1>

        <div class="card p-4 mt-3">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome completo:</label>
                <input type="text" id="nome" name="nome" class="form-control" placeholder="Digite seu nome..." required
                    value="<?php echo isset($paciente) && $paciente->getRegistro() ? $paciente->getnome() : ''; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Período:</label><br />
                <input type="radio" value="Matutino" id="ex7" name="periodo" required <?php if (isset($_POST['periodo']) && $_POST['periodo'] === 'Matutino') echo 'checked'; ?>>
                <label for="ex7">Matutino</label><br />
                <input type="radio" value="Noturno" id="ex8" name="periodo" required <?php if (isset($_POST['periodo']) && $_POST['periodo'] === 'Noturno') echo 'checked'; ?>>
                <label for="ex8">Noturno</label>
            </div>

            <div class="mb-3">
                <label for="datanascimento" class="form-label">Data de Nascimento:</label>
                <input type="date" id="datanascimento" name="datanascimento" class="form-control" required
                    value="<?php echo isset($paciente) && $paciente->getdataNascimento() ? $paciente->getdataNascimento() : ''; ?>">
            </div>

            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone para contato:</label>
                <input type="tel" name="telefone" id="telefone" class="form-control" placeholder="(DDD) 99999-9999" required
                    value="<?php echo isset($paciente) && $paciente->getTelefone() ? $paciente->getTelefone() : ''; ?>">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email para contato:</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Digite o email" required
                    value="<?php echo isset($paciente) && $paciente->getEmail() ? $paciente->getEmail() : ''; ?>">
            </div>

            <div class="mb-3">
                <label for="mae" class="form-label">Nome da mãe:</label>

                <input type="text" name="nomeMae" id="mae" class="form-control" placeholder="Digite o nome da mãe" required
                   value="<?php isset($paciente) && $paciente->getnomeMae() ? $Paciente->getnomeMae(): '' ?>">

                <input type="text" name="mae" id="mae" class="form-control" placeholder="Digite o nome da mãe" required
                    value="<?php echo isset($paciente) && $paciente->getnomeMae() ? $paciente->getnomeMae() : ''; ?>">

            </div>

            <div class="mb-3">
                <label class="form-label">Toma algum medicamento contínuo? Qual?</label><br />
                <input type="radio" value="Sim" id="medicamentoSim" name="medicamento" required <?php if (isset($_POST['medicamento']) && $_POST['medicamento'] === 'Sim') echo 'checked'; ?>>
                <label for="medicamentoSim">Sim</label><br />
                <input type="radio" value="Não" id="medicamentoNao" name="medicamento" required <?php if (isset($_POST['medicamento']) && $_POST['medicamento'] === 'Não') echo 'checked'; ?>>
                <label for="medicamentoNao">Não</label><br />
                <input type="text" name="medicamentoNome" id="medicamentoNome" class="form-control mt-2" placeholder="Qual medicamento?"
                    value="<?php echo $_POST['medicamentoNome'] ?? ''; ?>">
            </div>

            <div class="mb-3">
                <label for="patologia" class="form-label">Tem alguma patologia que trata?</label>
                <input type="text" name="patologia" id="patologia" class="form-control" placeholder="Se sim, qual?" required
                    value="<?php echo $_POST['patologia'] ?? ''; ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Exames solicitados:</label><br />
                <?php
                $exames = ['Microbiologia', 'Parasitologia', 'Hematologia', 'Bioquímica', 'Urinálise'];
                foreach ($exames as $exame) {
                    $checked = (isset($_POST['exame']) && in_array($exame, $_POST['exame'])) ? 'checked' : '';
                    echo "<input type='checkbox' value='$exame' id='ex_$exame' name='exame[]' $checked>";
                    echo "<label for='ex_$exame'>$exame</label><br />";
                }
                ?>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Enviar</button>

            <div class="mt-4">
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "GET") {
                    require_once '../controller/pacienteController.php';
                    lista(); 
                }
                ?>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const medSim = document.getElementById('medicamentoSim');
        const medNao = document.getElementById('medicamentoNao');
        const medNome = document.getElementById('medicamentoNome');

        function toggleMedicamentoNome() {
            if (medSim.checked) {
                medNome.style.display = 'block';
                medNome.setAttribute('required', 'required');
            } else {
                medNome.style.display = 'none';
                medNome.removeAttribute('required');
                medNome.value = '';
            }
        }

        toggleMedicamentoNome();
        medSim.addEventListener('change', toggleMedicamentoNome);
        medNao.addEventListener('change', toggleMedicamentoNome);
    });
</script>

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

</body>
</html>
