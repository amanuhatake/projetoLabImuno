<?php
//Feito pelo chat, pois ao salvar as informações, ele estava ficando preso aqui, e não estava indo para a listaLab
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../dao/labImunoDAO.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['acao'])) {
        $acao = $_POST['acao'];

        try {
            $dao = new LabImunoDAO();
        } catch (Exception $e) {
            echo "Erro ao conectar com o banco: " . $e->getMessage();
            exit();
        }

        if ($acao === 'inserir') {
            $dados = [
                'nome_paciente'      => $_POST['nome_paciente'] ?? '',
                'numero_registro'    => $_POST['numero_registro'] ?? '',
                'lote_lugol'         => $_POST['lote_lugol'] ?? '',
                'validade_lugol'     => $_POST['validade_lugol'] ?? '',
                'entrada'            => $_POST['entrada'] ?? '',
                'centrifuga'         => $_POST['centrifuga'] ?? '',
                'data_exame'         => $_POST['data_exame'] ?? '',
                'data_entrega'       => $_POST['data_entrega'] ?? '',
                'tubo_lote'          => $_POST['tubo_lote'] ?? '',
                'tubo_validade'      => $_POST['tubo_validade'] ?? '',
                'anti_a_lote'        => $_POST['anti_a_lote'] ?? '',
                'anti_a_validade'    => $_POST['anti_a_validade'] ?? '',
                'anti_b_lote'        => $_POST['anti_b_lote'] ?? '',
                'anti_b_validade'    => $_POST['anti_b_validade'] ?? '',
                'anti_d_lote'        => $_POST['anti_d_lote'] ?? '',
                'anti_d_validade'    => $_POST['anti_d_validade'] ?? '',
                'agua_lote'          => $_POST['agua_lote'] ?? '',
                'agua_validade'      => $_POST['agua_validade'] ?? ''
            ];

            try {
                $resultado = $dao->inserirExame($dados);
            } catch (Exception $e) {
                echo "Erro ao inserir exame: " . $e->getMessage();
                exit();
            }

            if ($resultado) {
                header("Location: ../views/listaLabImuno.php");
                exit();
            } else {
                echo "Erro ao inserir o exame.";
            }

        } elseif ($acao === 'atualizar') {

            $id = $_POST['id'] ?? null;
            if (!$id) {
                echo "ID do exame não informado para atualização.";
                exit();
            }

            $dados = [
                'nome_paciente'      => $_POST['nome_paciente'] ?? '',
                'numero_registro'    => $_POST['numero_registro'] ?? '',
                'lote_lugol'         => $_POST['lote_lugol'] ?? '',
                'validade_lugol'     => $_POST['validade_lugol'] ?? '',
                'entrada'            => $_POST['entrada'] ?? '',
                'centrifuga'         => $_POST['centrifuga'] ?? '',
                'data_exame'         => $_POST['data_exame'] ?? '',
                'data_entrega'       => $_POST['data_entrega'] ?? '',
                'tubo_lote'          => $_POST['tubo_lote'] ?? '',
                'tubo_validade'      => $_POST['tubo_validade'] ?? '',
                'anti_a_lote'        => $_POST['anti_a_lote'] ?? '',
                'anti_a_validade'    => $_POST['anti_a_validade'] ?? '',
                'anti_b_lote'        => $_POST['anti_b_lote'] ?? '',
                'anti_b_validade'    => $_POST['anti_b_validade'] ?? '',
                'anti_d_lote'        => $_POST['anti_d_lote'] ?? '',
                'anti_d_validade'    => $_POST['anti_d_validade'] ?? '',
                'agua_lote'          => $_POST['agua_lote'] ?? '',
                'agua_validade'      => $_POST['agua_validade'] ?? ''
            ];

            try {
                $resultado = $dao->atualizarExame($id, $dados);
            } catch (Exception $e) {
                echo "Erro ao atualizar exame: " . $e->getMessage();
                exit();
            }

            if ($resultado) {
                header("Location: ../views/listaLabImuno.php");
                exit();
            } else {
                echo "Erro ao atualizar o exame.";
            }

           
        } else {
            echo "Ação desconhecida: $acao";
        }

    } else {
        echo "Campo 'acao' não foi enviado no formulário.";
    }

} else {
    echo "Método HTTP não suportado.";
}
?>
