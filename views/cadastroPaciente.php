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
    <form action="../controller/pacienteController.php" method="POST">

        <input type="hidden" name="registro" 
        value="<?= isset($paciente) && $paciente->getRegistro() ? $paciente->getRegistro() : '' ?>">

        <h1 class="text-center">Cadastro de Pacientes - LEAC</h1>

        <div class="card p-4 mt-3">

            <div class="mb-3">
             <label for="data" class="form-label">Data:</label>
             <input type="date" id="data" name="data" class="form-control" required
             readonly onclick="preencherDataAtual()"
             value="<?= isset($paciente) && $paciente->getData() ? $paciente->getData() : '' ?>">
            </div>  

            <div class="mb-3">
                <label for="nome" class="form-label">Nome completo:</label>
                <input type="text" id="nome" name="nome" class="form-control" placeholder="Digite seu nome..." required
                    value="<?= isset($paciente) && $paciente->getNome() ? $paciente->getNome() : '' ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Período:</label><br />
                <input type="radio" value="Matutino" id="ex7" name="periodo" required <?= (isset($paciente) && $paciente->getPeriodo() === 'Matutino') ? 'checked' : '' ?>>
                <label for="ex7">Matutino</label><br />
                <input type="radio" value="Noturno" id="ex8" name="periodo" required <?= (isset($paciente) && $paciente->getPeriodo() === 'Noturno') ? 'checked' : '' ?>>
                <label for="ex8">Noturno</label>
            </div>

            <div class="mb-3">
                <label for="dataNascimento" class="form-label">Data de Nascimento:</label>
                <input type="date" id="Data_Nascimento" name="Data_Nascimento" class="form-control" required
                    value="<?= isset($paciente) && $paciente->getData_Nascimento() ? $paciente->getData_Nascimento() : '' ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Sexo:</label><br />
                <input type="radio" id="SexoMasculino" name="Sexo" value="Masculino" required
                <?= (isset($paciente) && $paciente->getSexo() === 'Masculino') ? 'checked' : '' ?>>
                <label for="sexoMasculino">Masculino</label><br />

                <input type="radio" id="sexoFeminino" name="Sexo" value="Feminino" required
                <?= (isset($paciente) && $paciente->getSexo() === 'Feminino') ? 'checked' : '' ?>>
                <label for="sexoFeminino">Feminino</label><br />

                <input type="radio" id="sexoOutro" name="Sexo" value="Outro" required
                <?= (isset($paciente) && $paciente->getSexo() === 'Outro') ? 'checked' : '' ?>>
              <label for="sexoOutro">Outro</label>
            </div>

            <div class="mb-3">
                <label for="telefone" class="form-label">Telefone para contato:</label>
                <input type="tel" name="telefone" id="telefone" class="form-control" placeholder="(DDD) 99999-9999" required
                    value="<?= isset($paciente) && $paciente->getTelefone() ? $paciente->getTelefone() : '' ?>">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email para contato:</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Digite o email" required
                    value="<?= isset($paciente) && $paciente->getEmail() ? $paciente->getEmail() : '' ?>">
            </div>

            <div class="mb-3">
                <label for="nomeMae" class="form-label">Nome da mãe:</label>
                <input type="text" name="nomeMae" id="nomeMae" class="form-control" placeholder="Digite o nome da mãe" required
                    value="<?= isset($paciente) && $paciente->getNomeMae() ? $paciente->getNomeMae() : '' ?>">
            </div>

            <div class="mb-3">
                <label class="form-label">Toma algum medicamento contínuo? Qual?</label><br />
                <input type="radio" value="Sim" id="medicamentoSim" name="medicamento" required
                    <?= (isset($paciente) && $paciente->getMedicamento() === 'Sim') ? 'checked' : '' ?>>
                <label for="medicamentoSim">Sim</label><br />

                <input type="radio" value="Não" id="medicamentoNao" name="medicamento" required
                    <?= (isset($paciente) && $paciente->getMedicamento() === 'Não') ? 'checked' : '' ?>>
                <label for="medicamentoNao">Não</label><br />

                <input type="text" name="medicamentoNome" id="medicamentoNome" class="form-control mt-2" placeholder="Qual medicamento?"
                    value="<?= isset($paciente) && $paciente->getMedicamentoNome() ? $paciente->getMedicamentoNome() : '' ?>">
            </div>

            <div class="mb-3">
                <label for="patologia" class="form-label">Tem alguma patologia que trata?</label>
                <input type="text" name="patologia" id="patologia" class="form-control" placeholder="Se sim, qual?" required
                    value="<?= isset($paciente) && $paciente->getPatologia() ? $paciente->getPatologia() : '' ?>">
            </div>

            <div class="mb-3">
              <label class="form-label">Exames solicitados:</label><br />
                 <?php
                 $exames = ['Microbiologia', 'Parasitologia', 'Hematologia', 'Bioquímica', 'Urinálise'];

                 // Só tenta carregar exames selecionados se estiver editando um paciente
                 $examesSelecionados = [];

                 if (isset($paciente) && method_exists($paciente, 'getExamesSolicitados') && $paciente->getExamesSolicitados()) {
                  $examesSelecionados = explode(',', $paciente->getExamesSolicitados());
                 }

                 foreach ($exames as $exame) {
                      $checked = in_array($exame, $examesSelecionados) ? 'checked' : '';
                      echo "<input type='checkbox' value='$exame' id='ex_$exame' name='examesSolicitados[]' $checked>";
                  echo "<label for='ex_$exame'>$exame</label><br />";
                }
            ?>
            </div>
            <div class="mt-4">
                <?php if(isset($paciente) && $paciente->getRegistro()): ?>
                <button type="submit" name="salvar_edicao" class="btn btn-primary">Salvar Edição</button>
                <?php else: ?>
                <button type="submit" name="cadastrar" class="btn btn-success">Cadastrar</button>
             <?php endif; ?>
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


<script>
function preencherDataAtual() {
    const input = document.getElementById('data');
    if (!input.value) {
        const hoje = new Date();
        const ano = hoje.getFullYear();
        const mes = String(hoje.getMonth() + 1).padStart(2, '0');
        const dia = String(hoje.getDate()).padStart(2, '0');
        input.value = `${ano}-${mes}-${dia}`;
    }
}
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
