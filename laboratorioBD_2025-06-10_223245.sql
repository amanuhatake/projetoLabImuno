SELECT * FROM paciente

DROP TABLE IF EXISTS paciente;

CREATE TABLE paciente (
  registro INT(11) NOT NULL AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
  nomeSocial VARCHAR(255) NOT NULL,
  Sexo VARCHAR(255) NOT NULL,
  telefone VARCHAR(20) DEFAULT NULL,
  data DATE DEFAULT NULL,
  periodo VARCHAR(50) DEFAULT NULL,
  nomeMae VARCHAR(255) DEFAULT NULL,
  examesSolicitados VARCHAR(255) DEFAULT NULL,
  Email VARCHAR(255) DEFAULT NULL,
  Data_Nascimento DATE DEFAULT NULL,
  medicamento VARCHAR(255) DEFAULT NULL,
  medicamentoNome VARCHAR(255) DEFAULT NULL,
  patologia VARCHAR(255) DEFAULT NULL,
  PRIMARY KEY (registro)
);


--nome VARCJAR(255) NOT NULL,
--registro INT(11) NOT NULL AUTO_INCREMENT
--loteLugol
--valodadeLugol
--entrada:
--centrifugaUtilizada
--dataExame
--dataPrevistaLaudo
--tuboEnsaio
--antiA
--antiB
--antiC

-- Tabela exames (catálogo de exames)
CREATE TABLE exames (
    id_exame INT PRIMARY KEY AUTO_INCREMENT,
    nome_exame VARCHAR(200)
);

-- Tabela exames_solicitados (tabela de junção com data)
CREATE TABLE exames_solicitados (
    id_exame_solicitado INT PRIMARY KEY AUTO_INCREMENT,
    id_paciente INT,
    id_exame INT,
    data_registro DATE,
    FOREIGN KEY (id_exame) REFERENCES exames(id_exame)
);

