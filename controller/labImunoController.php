<?php
require_once __DIR__ . '/../dao/labImunoDAO.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $dados = array(
        "nome_paciente" => $_POST["nome_paciente"] ?? "",
        "numero_registro" => $_POST["registro"] ?? "",
        "lote_lugol" => $_POST["lote_lugol"] ?? "",
        "validade_lugol" => $_POST["validade_lugol"] ?? "",
        "entrada" => $_POST["entrada"] ?? "",
        "centrifuga" => $_POST["centrifuga"] ?? "",
        "data_exame" => $_POST["data_realizacao"] ?? "",
        "data_entrega" => $_POST["data_entrega"] ?? "",
        "tubo_lote" => $_POST["tubo_lote"] ?? "",
        "tubo_validade" => $_POST["tubo_validade"] ?? "",
        "anti_a_lote" => $_POST["anti_a_lote"] ?? "",
        "anti_a_validade" => $_POST["anti_a_validade"] ?? "",
        "anti_b_lote" => $_POST["anti_b_lote"] ?? "",
        "anti_b_validade" => $_POST["anti_b_validade"] ?? "",
        "anti_d_lote" => $_POST["anti_d_lote"] ?? "",
        "anti_d_validade" => $_POST["anti_d_validade"] ?? "",
        "agua_lote" => $_POST["agua_lote"] ?? "",
        "agua_validade" => $_POST["agua_validade"] ?? ""
    );

    $dao = new LabImunoDAO();
    $sucesso = $dao->inserirExame($dados);

    if ($sucesso) {
        echo "<h2 style='color:green;'>Dados salvos com sucesso no banco!</h2>";
    } else {
        echo "<h2 style='color:red;'>Erro ao salvar os dados no banco.</h2>";
    }

    echo "<h3>Resumo:</h3>";
    foreach ($dados as $campo => $valor) {
        echo "<strong>$campo:</strong> $valor <br>";
    }
} else {
    echo "Método de requisição inválido.";
}
?>
