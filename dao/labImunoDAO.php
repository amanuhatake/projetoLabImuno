<?php
class LabImunoDAO {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "laboratorio",3307);

        if ($this->conn->connect_error) {
            die("Conexão falhou: " . $this->conn->connect_error);
        }
    }

    // Inserir um novo exame
    public function inserirExame($dados) {
        $sql = "INSERT INTO exames (
            nome_paciente, numero_registro, lote_lugol, validade_lugol,
            entrada, centrifuga, data_exame, data_entrega,
            tubo_lote, tubo_validade, anti_a_lote, anti_a_validade,
            anti_b_lote, anti_b_validade, anti_d_lote, anti_d_validade,
            agua_lote, agua_validade
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Erro na preparação da query: " . $this->conn->error);
        }

        $stmt->bind_param(
            "ssssssssssssssssss",
            $dados['nome_paciente'],
            $dados['numero_registro'],
            $dados['lote_lugol'],
            $dados['validade_lugol'],
            $dados['entrada'],
            $dados['centrifuga'],
            $dados['data_exame'],
            $dados['data_entrega'],
            $dados['tubo_lote'],
            $dados['tubo_validade'],
            $dados['anti_a_lote'],
            $dados['anti_a_validade'],
            $dados['anti_b_lote'],
            $dados['anti_b_validade'],
            $dados['anti_d_lote'],
            $dados['anti_d_validade'],
            $dados['agua_lote'],
            $dados['agua_validade']
        );

        $resultado = $stmt->execute();

        $stmt->close();
        return $resultado;
    }

    // Buscar exame pelo ID
    public function buscarExamePorId($id) {
        $sql = "SELECT * FROM exames WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        if (!$stmt) {
            die("Erro na preparação da query: " . $this->conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $resultado = $stmt->get_result();

        return $resultado->fetch_assoc(); // retorna um array associativo com os dados do exame
    }

    // Atualizar exame existente
    public function atualizarExame($id, $dados) {
        $sql = "UPDATE exames SET 
            nome_paciente=?, numero_registro=?, lote_lugol=?, validade_lugol=?,
            entrada=?, centrifuga=?, data_exame=?, data_entrega=?,
            tubo_lote=?, tubo_validade=?, anti_a_lote=?, anti_a_validade=?,
            anti_b_lote=?, anti_b_validade=?, anti_d_lote=?, anti_d_validade=?,
            agua_lote=?, agua_validade=? 
            WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        if (!$stmt) {
            die("Erro na preparação da query: " . $this->conn->error);
        }

        $stmt->bind_param(
            "ssssssssssssssssssi",
            $dados['nome_paciente'],
            $dados['numero_registro'],
            $dados['lote_lugol'],
            $dados['validade_lugol'],
            $dados['entrada'],
            $dados['centrifuga'],
            $dados['data_exame'],
            $dados['data_entrega'],
            $dados['tubo_lote'],
            $dados['tubo_validade'],
            $dados['anti_a_lote'],
            $dados['anti_a_validade'],
            $dados['anti_b_lote'],
            $dados['anti_b_validade'],
            $dados['anti_d_lote'],
            $dados['anti_d_validade'],
            $dados['agua_lote'],
            $dados['agua_validade'],
            $id
        );

        $resultado = $stmt->execute();
        $stmt->close();
        return $resultado;
    }
    
    public function listarTodos() {
    $sql = "SELECT * FROM exames ORDER BY id DESC";
    $result = $this->conn->query($sql);

    $exames = [];
    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $exames[] = $row;
        }
    }
    return $exames;
}

}
?>
