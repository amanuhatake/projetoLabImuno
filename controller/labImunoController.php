<?php
// Ativa exibição de erros para debug (remova em produção)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Inclui a classe DAO (confira o caminho se necessário)
require_once '../dao/labImunoDAO.php';

// Verifica se a requisição é POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Verifica se o campo 'acao' existe no POST
    if (isset($_POST['acao'])) {
        $acao = $_POST['acao'];

        // Instancia o DAO (com letra maiúscula!)
        try {
            $dao = new LabImunoDAO();
        } catch (Exception $e) {
            // Se falhar a conexão ou instanciamento, mostra erro e para
            echo "Erro ao conectar com o banco: " . $e->getMessage();
            exit();
        }

        // Se for para inserir exame
        if ($acao === 'inserir') {
            // Monta o array de dados vindos do formulário
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

            // Tenta inserir e captura erro se der
            try {
                $resultado = $dao->inserirExame($dados);
            } catch (Exception $e) {
                echo "Erro ao inserir exame: " . $e->getMessage();
                exit();
            }

            // Se inseriu com sucesso, redireciona para a lista
            if ($resultado) {
                header("Location: ../views/listaLabImuno.php");
                exit();
            } else {
                echo "Erro ao inserir o exame.";
            }

        // Se for para atualizar exame
        } elseif ($acao === 'atualizar') {

            $id = $_POST['id'] ?? null;
            if (!$id) {
                echo "ID do exame não informado para atualização.";
                exit();
            }

            // Monta o array com os dados do formulário
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

            // Tenta atualizar
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
