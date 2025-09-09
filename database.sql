-- Criar banco de dados (se não existir)
CREATE DATABASE IF NOT EXISTS labimuno 
CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

USE exames;

-- Criar tabela de usuários
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    nome_social VARCHAR(255),
    data_nascimento DATE NOT NULL,
    telefone VARCHAR(20),
    email VARCHAR(255) NOT NULL UNIQUE,
    sexo CHAR(1),
    cpf VARCHAR(14) NOT NULL UNIQUE,
    tipo_usuario ENUM('administrador', 'biomedico', 'tecnico', 'recepcao') NOT NULL,
    registro_profissional VARCHAR(50),
    senha VARCHAR(255) NOT NULL,
    status ENUM('ativo', 'inativo') DEFAULT 'ativo',
    permissao_admin BOOLEAN DEFAULT FALSE,
    ultimo_login DATETIME,
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_cpf (cpf),
    INDEX idx_tipo_usuario (tipo_usuario),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Inserir usuários de exemplo
INSERT INTO usuarios (nome, email, cpf, data_nascimento, tipo_usuario, registro_profissional, senha, status, permissao_admin, ultimo_login) VALUES
('Dr. João Silva', 'joao.silva@labimuno.com', '12345678901', '1980-05-15', 'administrador', 'CRM: 12345', '$2y$10$YourHashedPasswordHere', 'ativo', TRUE, '2025-06-04 14:30:00'),
('Dra. Maria Oliveira', 'maria.oliveira@labimuno.com', '98765432109', '1985-08-22', 'biomedico', 'CRBM: 54321', '$2y$10$YourHashedPasswordHere', 'ativo', FALSE, '2025-06-04 13:15:00'),
('Carlos Santos', 'carlos.santos@labimuno.com', '11122233344', '1990-03-10', 'tecnico', NULL, '$2y$10$YourHashedPasswordHere', 'ativo', FALSE, '2025-06-04 11:45:00'),
('Ana Costa', 'ana.costa@labimuno.com', '55566677788', '1988-12-25', 'recepcao', NULL, '$2y$10$YourHashedPasswordHere', 'inativo', FALSE, '2025-06-01 09:20:00');

-- Nota: As senhas precisam ser geradas usando password_hash() do PHP
-- Exemplo: $2y$10$YourHashedPasswordHere seria substituído por password_hash('senha123', PASSWORD_DEFAULT)