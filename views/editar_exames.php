<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../dao/PacienteDaoSQL.php';

if (!isset($_GET['registro'])) {
    header("Location: ListaPacientes.php?erro=registro_nao_informado");
    exit();
}

$registro = $_GET['registro'];

$dao = new PacienteDaoSQL();
$paciente = $dao->buscarPorRegistro($registro);

if (!$paciente) {
    header("Location: ListaPacientes.php?erro=paciente_nao_encontrado");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Editar Exames</title>
    <link rel="stylesheet" href="style_editar_exames.css">
</head>

<body>
    <div class="form-container">
        <h2>Editar Exames do Paciente</h2>

        <div class="info-section">
            <div class="info-field">
                <span class="info-label">Nome:</span>
                <?= htmlspecialchars($paciente->getNome()) ?>
            </div>
            <div class="info-field">
                <span class="info-label">Telefone:</span>
                <?= htmlspecialchars($paciente->getTelefone()) ?>
            </div>
        </div>

        <form method="POST" action="../controller/PacienteController.php">
            <input type="hidden" name="registro" value="<?= $paciente->getRegistro() ?>">
            <input type="hidden" name="atualizar_exames" value="1">

            <label for="exames">Exames Solicitados:</label><br>
            <textarea name="examesSolicitados" id="exames" rows="4" cols="50"><?= htmlspecialchars($paciente->getExamesSolicitados()) ?></textarea><br><br>

            <button type="submit">Salvar Alterações</button>
        </form>

    </div>
</body>

</html>
