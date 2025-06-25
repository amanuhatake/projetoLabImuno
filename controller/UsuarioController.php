<?php
session_start();
include_once 'UsuarioDAO.php';

class UsuarioController {
    private $usuarioDAO;

    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }

    // Processar requisições
    public function processar() {
        $acao = isset($_REQUEST['acao']) ? $_REQUEST['acao'] : 'listar';

        switch ($acao) {
            case 'listar':
                $this->listar();
                break;
            case 'buscar':
                $this->buscar();
                break;
            case 'salvar':
                $this->salvar();
                break;
            case 'editar':
                $this->editar();
                break;
            case 'deletar':
                $this->deletar();
                break;
            case 'ativar':
                $this->ativar();
                break;
            case 'estatisticas':
                $this->estatisticas();
                break;
            case 'verificarEmail':
                $this->verificarEmail();
                break;
            case 'verificarCpf':
                $this->verificarCpf();
                break;
            default:
                $this->listar();
        }
    }

    // Listar usuários com filtros
    private function listar() {
        $filtros = array(
            'busca' => isset($_GET['busca']) ? $_GET['busca'] : '',
            'tipo_usuario' => isset($_GET['tipo_usuario']) ? $_GET['tipo_usuario'] : '',
            'status' => isset($_GET['status']) ? $_GET['status'] : ''
        );

        $usuarios = $this->usuarioDAO->listar($filtros);
        
        $response = array(
            'sucesso' => true,
            'dados' => array()
        );

        foreach ($usuarios as $usuario) {
            $response['dados'][] = array(
                'id' => $usuario->getId(),
                'nome' => $usuario->getNome(),
                'email' => $usuario->getEmail(),
                'tipo_usuario' => $usuario->getTipoUsuario(),
                'registro_profissional' => $usuario->getRegistroProfissional(),
                'status' => $usuario->getStatus(),
                'ultimo_login' => $usuario->getUltimoLogin() ? 
                    date('d/m/Y H:i', strtotime($usuario->getUltimoLogin())) : 
                    'Nunca'
            );
        }

        $this->enviarResposta($response);
    }

    // Buscar usuário por ID
    private function buscar() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        
        if ($id <= 0) {
            $this->enviarResposta(array('sucesso' => false, 'mensagem' => 'ID inválido'));
            return;
        }

        $usuario = $this->usuarioDAO->buscarPorId($id);
        
        if ($usuario) {
            $response = array(
                'sucesso' => true,
                'dados' => array(
                    'id' => $usuario->getId(),
                    'nome' => $usuario->getNome(),
                    'nome_social' => $usuario->getNomeSocial(),
                    'cpf' => $usuario->getCpf(),
                    'data_nascimento' => $usuario->getData_Nascimento(),
                    'telefone' => $usuario->getTelefone(),
                    'email' => $usuario->getEmail(),
                    'sexo' => $usuario->getSexo(),
                    'tipo_usuario' => $usuario->getTipoUsuario(),
                    'registro_profissional' => $usuario->getRegistroProfissional(),
                    'status' => $usuario->getStatus(),
                    'permissao_admin' => $usuario->getPermissaoAdmin()
                )
            );
        } else {
            $response = array('sucesso' => false, 'mensagem' => 'Usuário não encontrado');
        }

        $this->enviarResposta($response);
    }

    // Salvar usuário (criar ou atualizar)
    private function salvar() {
        // Validar dados
        $erros = $this->validarDados($_POST);
        
        if (!empty($erros)) {
            $this->enviarResposta(array('sucesso' => false, 'mensagem' => implode('<br>', $erros)));
            return;
        }

        $usuario = new Usuario();
        
        // Se tem ID, está editando
        if (!empty($_POST['id'])) {
            $usuario->setId(intval($_POST['id']));
        }

        // Setar dados do usuário
        $usuario->setNome($_POST['nome']);
        $usuario->setNomeSocial($_POST['nome_social'] ?? '');
        $usuario->setCpf($this->limparCpf($_POST['cpf']));
        $usuario->setData_Nascimento($_POST['data_nascimento']);
        $usuario->setTelefone($_POST['telefone'] ?? '');
        $usuario->setEmail($_POST['email']);
        $usuario->setSexo($_POST['sexo'] ?? '');
        $usuario->setTipoUsuario($_POST['tipo_usuario']);
        $usuario->setRegistroProfissional($_POST['registro_profissional'] ?? '');
        $usuario->setStatus($_POST['status'] ?? 'ativo');
        $usuario->setPermissaoAdmin(isset($_POST['permissao_admin']) && $_POST['permissao_admin'] == '1');

        // Salvar no banco
        if (empty($_POST['id'])) {
            // Novo usuário - setar senha
            if (!empty($_POST['senha'])) {
                $usuario->setSenha($_POST['senha']);
            }
            $resultado = $this->usuarioDAO->inserir($usuario);
            $mensagem = $resultado ? 'Usuário cadastrado com sucesso!' : 'Erro ao cadastrar usuário';
        } else {
            // Atualizar usuário existente
            $resultado = $this->usuarioDAO->atualizar($usuario);
            
            // Se mudou a senha, atualizar separadamente
            if (!empty($_POST['senha'])) {
                $this->usuarioDAO->atualizarSenha($usuario->getId(), $_POST['senha']);
            }
            
            $mensagem = $resultado ? 'Usuário atualizado com sucesso!' : 'Erro ao atualizar usuário';
        }

        $this->enviarResposta(array('sucesso' => $resultado, 'mensagem' => $mensagem));
    }

    // Editar usuário (redirecionar para formulário)
    private function editar() {
        $id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        
        if ($id <= 0) {
            $_SESSION['erro'] = 'ID inválido';
            header('Location: usuarios.php');
            return;
        }

        $usuario = $this->usuarioDAO->buscarPorId($id);
        
        if (!$usuario) {
            $_SESSION['erro'] = 'Usuário não encontrado';
            header('Location: usuarios.php');
            return;
        }

        $_SESSION['usuario_edicao'] = $usuario;
        header('Location: usuarios.php?acao=formulario&id=' . $id);
    }

    // Deletar usuário (soft delete)
    private function deletar() {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        
        if ($id <= 0) {
            $this->enviarResposta(array('sucesso' => false, 'mensagem' => 'ID inválido'));
            return;
        }

        $resultado = $this->usuarioDAO->deletar($id);
        $mensagem = $resultado ? 'Usuário desativado com sucesso!' : 'Erro ao desativar usuário';

        $this->enviarResposta(array('sucesso' => $resultado, 'mensagem' => $mensagem));
    }

    // Ativar usuário
    private function ativar() {
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        
        if ($id <= 0) {
            $this->enviarResposta(array('sucesso' => false, 'mensagem' => 'ID inválido'));
            return;
        }

        $usuario = $this->usuarioDAO->buscarPorId($id);
        
        if (!$usuario) {
            $this->enviarResposta(array('sucesso' => false, 'mensagem' => 'Usuário não encontrado'));
            return;
        }

        $usuario->setStatus('ativo');
        $resultado = $this->usuarioDAO->atualizar($usuario);
        $mensagem = $resultado ? 'Usuário ativado com sucesso!' : 'Erro ao ativar usuário';

        $this->enviarResposta(array('sucesso' => $resultado, 'mensagem' => $mensagem));
    }

    // Obter estatísticas
    private function estatisticas() {
        $stats = $this->usuarioDAO->contarPorStatus();
        $total = array_sum($stats);
        
        $response = array(
            'sucesso' => true,
            'dados' => array(
                'total' => $total,
                'ativos' => $stats['ativo'] ?? 0,
                'inativos' => $stats['inativo'] ?? 0,
                'tipos' => 4 // Número fixo de tipos no sistema
            )
        );

        $this->enviarResposta($response);
    }

    // Verificar se email já existe
    private function verificarEmail() {
        $email = isset($_GET['email']) ? $_GET['email'] : '';
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;
        
        $existe = $this->usuarioDAO->emailExiste($email, $id);
        
        $this->enviarResposta(array('existe' => $existe));
    }

    // Verificar se CPF já existe
    private function verificarCpf() {
        $cpf = isset($_GET['cpf']) ? $this->limparCpf($_GET['cpf']) : '';
        $id = isset($_GET['id']) ? intval($_GET['id']) : null;
        
        $existe = $this->usuarioDAO->cpfExiste($cpf, $id);
        
        $this->enviarResposta(array('existe' => $existe));
    }

    // Validar dados do formulário
    private function validarDados($dados) {
        $erros = array();

        // Validações básicas
        if (empty($dados['nome'])) {
            $erros[] = 'Nome é obrigatório';
        }

        if (empty($dados['cpf'])) {
            $erros[] = 'CPF é obrigatório';
        } elseif (!$this->validarCpf($dados['cpf'])) {
            $erros[] = 'CPF inválido';
        }

        if (empty($dados['data_nascimento'])) {
            $erros[] = 'Data de nascimento é obrigatória';
        }

        if (empty($dados['email'])) {
            $erros[] = 'Email é obrigatório';
        } elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            $erros[] = 'Email inválido';
        }

        if (empty($dados['tipo_usuario'])) {
            $erros[] = 'Tipo de usuário é obrigatório';
        }

        // Se é novo usuário, senha é obrigatória
        if (empty($dados['id']) && empty($dados['senha'])) {
            $erros[] = 'Senha é obrigatória';
        }

        // Validar confirmação de senha
        if (!empty($dados['senha']) && $dados['senha'] !== $dados['confirmar_senha']) {
            $erros[] = 'As senhas não coincidem';
        }

        // Validar tamanho mínimo da senha
        if (!empty($dados['senha']) && strlen($dados['senha']) < 6) {
            $erros[] = 'A senha deve ter no mínimo 6 caracteres';
        }

        return $erros;
    }

    // Limpar CPF
    private function limparCpf($cpf) {
        return preg_replace('/[^0-9]/', '', $cpf);
    }

    // Validar CPF
    private function validarCpf($cpf) {
        $cpf = $this->limparCpf($cpf);

        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica sequências inválidas
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Validação do dígito verificador
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    // Enviar resposta JSON
    private function enviarResposta($dados) {
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($dados);
        exit;
    }
}

// Executar controller
$controller = new UsuarioController();
$controller->processar();
?>