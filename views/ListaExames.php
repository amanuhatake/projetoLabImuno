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
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Lista de Pacientes</h2>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'exames_atualizados'): ?>
    <div class="message">Exames atualizados com sucesso!</div>
<?php endif; ?>

<div class="search-box">
    <form method="GET" action="ListaExames.php">
        <input type="text" name="buscar" placeholder="Buscar por nome..." value="<?= isset($_GET['buscar']) ? htmlspecialchars($_GET['buscar']) : '' ?>">
        <input type="submit" value="Buscar">
        <a href="ListaExames.php">Limpar</a>
    </form>
</div>

<table>
    <thead>
        <tr>
            <th>Registro</th>
            <th>Nome</th>
            <th>Exames</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($pacientes) > 0): ?>
            <?php foreach ($pacientes as $pac): ?>
            <tr>
                <td><?= htmlspecialchars($pac->getRegistro()) ?></td>
                <td><?= htmlspecialchars($pac->getNome()) ?></td>
                <td><?= htmlspecialchars($pac->getExamesSolicitados()) ?></td>
                <td>
                    <a href="editar_exames.php?registro=<?= $pac->getRegistro() ?>">Editar Exames</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
        <tr><td colspan="4">Nenhum paciente encontrado.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
