<?php
// Configuração da API
$api_url = 'http://localhost:3001/api/exames-solicitados';

// Função para fazer requisição à API
function fetchExamesSolicitados($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode === 200) {
        $data = json_decode($response, true);
        return $data['success'] ? $data['examesSolicitados'] : [];
    }
    return [];
}

// Buscar exames solicitados
$examesSolicitados = [];
$buscarPaciente = isset($_GET['buscar']) ? $_GET['buscar'] : '';

try {
    $examesSolicitados = fetchExamesSolicitados($api_url);
    
    // Filtrar por nome do paciente se busca foi fornecida
    if (!empty($buscarPaciente)) {
        $examesSolicitados = array_filter($examesSolicitados, function($exame) use ($buscarPaciente) {
            return stripos($exame['nome_paciente'], $buscarPaciente) !== false;
        });
    }
} catch (Exception $e) {
    error_log("Erro ao buscar exames: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Exames Solicitados</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Lista de Exames Solicitados</h2>

<?php if (isset($_GET['msg']) && $_GET['msg'] == 'exames_atualizados'): ?>
    <div class="message">Exames atualizados com sucesso!</div>
<?php endif; ?>

<div class="search-box">
    <form method="GET" action="ListaExames.php">
        <input type="text" name="buscar" placeholder="Buscar por nome do paciente..." value="<?= htmlspecialchars($buscarPaciente) ?>">
        <input type="submit" value="Buscar">
        <a href="ListaExames.php">Limpar</a>
    </form>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Paciente</th>
            <th>Exame</th>
            <th>Data de Registro</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if (count($examesSolicitados) > 0): ?>
            <?php foreach ($examesSolicitados as $exame): ?>
            <tr>
                <td><?= htmlspecialchars($exame['id_exame_solicitado']) ?></td>
                <td><?= htmlspecialchars($exame['nome_paciente']) ?></td>
                <td><?= htmlspecialchars($exame['nome_exame']) ?></td>
                <td><?= htmlspecialchars(date('d/m/Y', strtotime($exame['data_registro']))) ?></td>
                <td>
                    <a href="editar_exames.php?id_paciente=<?= $exame['id_paciente'] ?>">Editar Exames</a>
                    <a href="javascript:void(0)" onclick="removerExame(<?= $exame['id_exame_solicitado'] ?>)">Remover</a>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php else: ?>
        <tr><td colspan="5">Nenhum exame solicitado encontrado.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<script>
function removerExame(id_exame_solicitado) {
    if (confirm('Tem certeza que deseja remover este exame solicitado?')) {
        fetch('http://localhost:3001/api/exames-solicitados', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({id_exame_solicitado: id_exame_solicitado})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Exame removido com sucesso!');
                location.reload();
            } else {
                alert('Erro ao remover exame!');
            }
        })
        .catch(error => {
            console.error('Erro:', error);
            alert('Erro ao remover exame!');
        });
    }
}
</script>

</body>
</html>

