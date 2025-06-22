<?php
require_once __DIR__ . '/../dao/PacienteDaoSQL.php';

$pacienteDao = new PacienteDaoSQL();
$pacientes = [];

if (isset($_GET['buscar'])) {
    $nomeBusca = $_GET['buscar'];
    $pacientes = $pacienteDao->buscarPorNome($nomeBusca);
} else {
    $pacientes = $pacienteDao->read();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pacientes</title>
    <!-- Link para o CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Lista de Pacientes</h2>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'exames_atualizados'): ?>
    <div class="message">Exames atualizados com sucesso!</div>
<?php endif; ?>

<div class="search-box">
    <form method="GET" action="ListaPacientes.php">
        <input type="text" name="buscar" placeholder="Buscar por nome..." value="<?= isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : '' ?>">
        <input type="submit" value="Buscar">
        <a href="ListaPacientes.php">Limpar</a>
    </form>
</div>

<table>
    <thead>
        <tr>
            <th>Registro</th>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Data</th>
            <th>Período</th>
            <th>Nome Mãe</th>
            <th>Exames</th>
            <th>Email</th>
            <th>Data Nascimento</th>
            <th>Medicamento</th>
            <th>Nome Medicamento</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($pacientes) > 0): ?>
            <?php foreach ($pacientes as $pac): ?>
            <tr>
                <td><?= htmlspecialchars($pac->getRegistro()) ?></td>
                <td><?= htmlspecialchars($pac->getNome()) ?></td>
                <td><?= htmlspecialchars($pac->getTelefone()) ?></td>
                <td><?= htmlspecialchars($pac->getData()) ?></td>
                <td><?= htmlspecialchars($pac->getPeriodo()) ?></td>
                <td><?= htmlspecialchars($pac->getNomeMae()) ?></td>
                <td><?= htmlspecialchars($pac->getExamesSolicitados()) ?></td>
                <td><?= htmlspecialchars($pac->getEmail()) ?></td>
                <td><?= htmlspecialchars($pac->getDataNascimento()) ?></td>
                <td><?= htmlspecialchars($pac->getMedicamento()) ?></td>
                <td><?= htmlspecialchars($pac->getMedicamentoNome()) ?></td>
                <td>
                    <a href="editar_exames.php?registro=<?= $pac->getRegistro() ?>">Editar Exames</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
        <tr><td colspan="12">Nenhum paciente encontrado.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
