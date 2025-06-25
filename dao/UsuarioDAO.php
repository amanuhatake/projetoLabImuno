<?php
include_once 'Usuario.php';
include_once 'Conexao.php';

class UsuarioDAO {
    private $conexao;

    public function __construct() {
        $this->conexao = new Conexao();
    }

    // Inserir novo usuário
    public function inserir(Usuario $usuario) {
        try {
            $sql = "INSERT INTO usuarios (nome, nome_social, data_nascimento, telefone, email, sexo, cpf, 
                    tipo_usuario, registro_profissional, senha, status, permissao_admin, data_cadastro) 
                    VALUES (:nome, :nome_social, :data_nascimento, :telefone, :email, :sexo, :cpf, 
                    :tipo_usuario, :registro_profissional, :senha, :status, :permissao_admin, :data_cadastro)";

            $stmt = $this->conexao->getConexao()->prepare($sql);
            
            $stmt->bindValue(':nome', $usuario->getNome());
            $stmt->bindValue(':nome_social', $usuario->getNomeSocial());
            $stmt->bindValue(':data_nascimento', $usuario->getData_Nascimento());
            $stmt->bindValue(':telefone', $usuario->getTelefone());
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':sexo', $usuario->getSexo());
            $stmt->bindValue(':cpf', $usuario->getCpf());
            $stmt->bindValue(':tipo_usuario', $usuario->getTipoUsuario());
            $stmt->bindValue(':registro_profissional', $usuario->getRegistroProfissional());
            $stmt->bindValue(':senha', $usuario->getSenha());
            $stmt->bindValue(':status', $usuario->getStatus());
            $stmt->bindValue(':permissao_admin', $usuario->getPermissaoAdmin() ? 1 : 0);
            $stmt->bindValue(':data_cadastro', $usuario->getDataCadastro());

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao inserir usuário: " . $e->getMessage());
            return false;
        }
    }

    // Atualizar usuário
    public function atualizar(Usuario $usuario) {
        try {
            $sql = "UPDATE usuarios SET nome = :nome, nome_social = :nome_social, 
                    data_nascimento = :data_nascimento, telefone = :telefone, email = :email, 
                    sexo = :sexo, cpf = :cpf, tipo_usuario = :tipo_usuario, 
                    registro_profissional = :registro_profissional, status = :status, 
                    permissao_admin = :permissao_admin WHERE id = :id";

            $stmt = $this->conexao->getConexao()->prepare($sql);
            
            $stmt->bindValue(':id', $usuario->getId());
            $stmt->bindValue(':nome', $usuario->getNome());
            $stmt->bindValue(':nome_social', $usuario->getNomeSocial());
            $stmt->bindValue(':data_nascimento', $usuario->getData_Nascimento());
            $stmt->bindValue(':telefone', $usuario->getTelefone());
            $stmt->bindValue(':email', $usuario->getEmail());
            $stmt->bindValue(':sexo', $usuario->getSexo());
            $stmt->bindValue(':cpf', $usuario->getCpf());
            $stmt->bindValue(':tipo_usuario', $usuario->getTipoUsuario());
            $stmt->bindValue(':registro_profissional', $usuario->getRegistroProfissional());
            $stmt->bindValue(':status', $usuario->getStatus());
            $stmt->bindValue(':permissao_admin', $usuario->getPermissaoAdmin() ? 1 : 0);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao atualizar usuário: " . $e->getMessage());
            return false;
        }
    }

    // Atualizar senha
    public function atualizarSenha($id, $novaSenha) {
        try {
            $sql = "UPDATE usuarios SET senha = :senha WHERE id = :id";
            $stmt = $this->conexao->getConexao()->prepare($sql);
            
            $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
            $stmt->bindValue(':id', $id);
            $stmt->bindValue(':senha', $senhaHash);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao atualizar senha: " . $e->getMessage());
            return false;
        }
    }

    // Deletar usuário (soft delete - apenas muda status)
    public function deletar($id) {
        try {
            $sql = "UPDATE usuarios SET status = 'inativo' WHERE id = :id";
            $stmt = $this->conexao->getConexao()->prepare($sql);
            $stmt->bindValue(':id', $id);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao deletar usuário: " . $e->getMessage());
            return false;
        }
    }

    // Buscar por ID
    public function buscarPorId($id) {
        try {
            $sql = "SELECT * FROM usuarios WHERE id = :id";
            $stmt = $this->conexao->getConexao()->prepare($sql);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $this->criarUsuarioDeArray($row);
            }
            return null;
        } catch (PDOException $e) {
            error_log("Erro ao buscar usuário por ID: " . $e->getMessage());
            return null;
        }
    }

    // Buscar por email
    public function buscarPorEmail($email) {
        try {
            $sql = "SELECT * FROM usuarios WHERE email = :email";
            $stmt = $this->conexao->getConexao()->prepare($sql);
            $stmt->bindValue(':email', $email);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return $this->criarUsuarioDeArray($row);
            }
            return null;
        } catch (PDOException $e) {
            error_log("Erro ao buscar usuário por email: " . $e->getMessage());
            return null;
        }
    }

    // Listar todos com filtros
    public function listar($filtros = array()) {
        try {
            $sql = "SELECT * FROM usuarios WHERE 1=1";
            $params = array();

            // Aplicar filtros
            if (!empty($filtros['busca'])) {
                $sql .= " AND (nome LIKE :busca OR email LIKE :busca)";
                $params[':busca'] = '%' . $filtros['busca'] . '%';
            }

            if (!empty($filtros['tipo_usuario'])) {
                $sql .= " AND tipo_usuario = :tipo_usuario";
                $params[':tipo_usuario'] = $filtros['tipo_usuario'];
            }

            if (!empty($filtros['status'])) {
                $sql .= " AND status = :status";
                $params[':status'] = $filtros['status'];
            }

            $sql .= " ORDER BY nome ASC";

            $stmt = $this->conexao->getConexao()->prepare($sql);
            
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }

            $stmt->execute();
            
            $usuarios = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $usuarios[] = $this->criarUsuarioDeArray($row);
            }

            return $usuarios;
        } catch (PDOException $e) {
            error_log("Erro ao listar usuários: " . $e->getMessage());
            return array();
        }
    }

    // Atualizar último login
    public function atualizarUltimoLogin($id) {
        try {
            $sql = "UPDATE usuarios SET ultimo_login = NOW() WHERE id = :id";
            $stmt = $this->conexao->getConexao()->prepare($sql);
            $stmt->bindValue(':id', $id);

            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao atualizar último login: " . $e->getMessage());
            return false;
        }
    }

    // Verificar se CPF já existe
    public function cpfExiste($cpf, $idExcluir = null) {
        try {
            $sql = "SELECT COUNT(*) FROM usuarios WHERE cpf = :cpf";
            if ($idExcluir) {
                $sql .= " AND id != :id";
            }

            $stmt = $this->conexao->getConexao()->prepare($sql);
            $stmt->bindValue(':cpf', $cpf);
            if ($idExcluir) {
                $stmt->bindValue(':id', $idExcluir);
            }

            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Erro ao verificar CPF: " . $e->getMessage());
            return true; // Retorna true para evitar cadastro em caso de erro
        }
    }

    // Verificar se email já existe
    public function emailExiste($email, $idExcluir = null) {
        try {
            $sql = "SELECT COUNT(*) FROM usuarios WHERE email = :email";
            if ($idExcluir) {
                $sql .= " AND id != :id";
            }

            $stmt = $this->conexao->getConexao()->prepare($sql);
            $stmt->bindValue(':email', $email);
            if ($idExcluir) {
                $stmt->bindValue(':id', $idExcluir);
            }

            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        } catch (PDOException $e) {
            error_log("Erro ao verificar email: " . $e->getMessage());
            return true;
        }
    }

    // Contar usuários por status
    public function contarPorStatus() {
        try {
            $sql = "SELECT status, COUNT(*) as total FROM usuarios GROUP BY status";
            $stmt = $this->conexao->getConexao()->prepare($sql);
            $stmt->execute();

            $resultado = array();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $resultado[$row['status']] = $row['total'];
            }

            return $resultado;
        } catch (PDOException $e) {
            error_log("Erro ao contar usuários por status: " . $e->getMessage());
            return array();
        }
    }

    // Método auxiliar para criar objeto Usuario a partir de array
    private function criarUsuarioDeArray($row) {
        $usuario = new Usuario();
        $usuario->setId($row['id']);
        $usuario->setNome($row['nome']);
        $usuario->setNomeSocial($row['nome_social']);
        $usuario->setData_Nascimento($row['data_nascimento']);
        $usuario->setTelefone($row['telefone']);
        $usuario->setEmail($row['email']);
        $usuario->setSexo($row['sexo']);
        $usuario->setCpf($row['cpf']);
        $usuario->setTipoUsuario($row['tipo_usuario']);
        $usuario->setRegistroProfissional($row['registro_profissional']);
        $usuario->setStatus($row['status']);
        $usuario->setPermissaoAdmin($row['permissao_admin'] == 1);
        $usuario->setUltimoLogin($row['ultimo_login']);
        $usuario->setDataCadastro($row['data_cadastro']);

        return $usuario;
    }
}
?>