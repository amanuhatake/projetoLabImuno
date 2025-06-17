DROP TABLE IF EXISTS `paciente`;

CREATE TABLE `paciente` (
  `registro` int(11) DEFAULT NULL,
  `data` date DEFAULT NULL,
  `periodo` varchar(50) DEFAULT NULL,
  `nomeMae` varchar(255) DEFAULT NULL,
  `exames_solicitados` text DEFAULT NULL
);



DROP TABLE IF EXISTS `pessoa`;

CREATE TABLE `pessoa` (

  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `Data_Nascimento` date DEFAULT NULL,
  `exames_solicitados` varchar(255) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) 

INSERT INTO `pessoa` VALUES (1,'oi',NULL,NULL,'43984092304','kleberu2r@gmail.com'),(2,'oi',NULL,NULL,'43984092304','kleberu2r@gmail.com'),(3,'oi',NULL,NULL,'43984092304','kleberu2r@gmail.com'),(4,'oi',NULL,NULL,'43984092304','kleberu2r@gmail.com'),(5,'oi',NULL,NULL,'43984092304','kleberu2r@gmail.com'),(6,'oi',NULL,NULL,'43984092304','kleberu2r@gmail.com'),(7,'oi',NULL,NULL,'43984092304','kleberu2r@gmail.com'),(8,'oi',NULL,NULL,'43984092304','kleberu2r@gmail.com'),(9,'oi',NULL,NULL,'43984092304','kleberu2r@gmail.com'),(10,'oi','2004-08-02',NULL,'43984092304','kleberu2r@gmail.com'),(11,'oi','2004-08-02',NULL,'43984092304','kleberu2r@gmail.com');

SELECT * FROM paciente

DROP TABLE IF EXISTS paciente;

CREATE TABLE paciente (
  registro INT(11) NOT NULL AUTO_INCREMENT,
  nome VARCHAR(255) NOT NULL,
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



