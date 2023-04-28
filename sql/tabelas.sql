`codigoAluno` e `codigoCoord`: usados para verificar a presença do aluno no evento em que ele se inscreveu, se o valor de `codigoAluno` for null: ele só está inscrito, se estiver com o mesmo valor de `codigoCoord`: tem presença.
os campos de senha irão ser criptografados usando a função password_BCRYPT do php.

CREATE DATABASE eventosfaculdade;
USE eventosfaculdade;

CREATE TABLE eventos (
    idEvento INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nomeEvento VARCHAR(100) NOT NULL,
    descricao VARCHAR(255),
    local VARCHAR(100),
    dataEvento DATE,
    horarioInicio TIME,
    horarioTermino TIME,
    codigoCoord VARCHAR(25), 
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
                     ON UPDATE CURRENT_TIMESTAMP,
  KEY (updated_at)
);
-- Os eventos de mais de um dia poderão ser colocados um dia em cada (parte 1, parte2 ...) ou (colocar outra ideia)

CREATE TABLE cursos (
    idCurso INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nomeCurso VARCHAR(50) NOT NULL UNIQUE,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE coordenadores (
    idCoordenador INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL UNIQUE,
    idCurso int NOT NULL,
    senha VARCHAR(80) NOT NULL, -- password hash 
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idCurso) REFERENCES Cursos(idCurso)
);

CREATE TABLE alunos (
    ra VARCHAR(7) NOT NULL PRIMARY KEY ,
    nome VARCHAR(100) NOT NULL,
    idCurso int NOT NULL,   
    senha VARCHAR(80) NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (idCurso) REFERENCES Cursos(idCurso)
);

CREATE TABLE presenca (
    idEvento INT NOT NULL,
    ra VARCHAR(7) NOT NULL,
    codigoAluno VARCHAR(25),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
                     ON UPDATE CURRENT_TIMESTAMP,
  KEY (updated_at),
    qtdTentativas TINYINT unsigned DEFAULT 0,
    PRIMARY KEY (idEvento, ra),
    CONSTRAINT fk_evt FOREIGN KEY (idEvento) REFERENCES eventos(idEvento),
    CONSTRAINT fk_aln FOREIGN KEY (ra) REFERENCES alunos(ra)
);


INSERT INTO `cursos` (`idCurso`, `nomeCurso`, `created_at`) VALUES (1, 'TADS', current_timestamp());
INSERT INTO `cursos` (`idCurso`, `nomeCurso`, `created_at`) VALUES (2, 'Psicologia', current_timestamp());
INSERT INTO `cursos` (`idCurso`, `nomeCurso`, `created_at`) VALUES (3, 'Eng Civil', current_timestamp());
INSERT INTO `cursos` (`idCurso`, `nomeCurso`, `created_at`) VALUES (4, 'Eng Mecanica', current_timestamp());
INSERT INTO `cursos` (`idCurso`, `nomeCurso`, `created_at`) VALUES (6, 'Eng Eletrica', current_timestamp());
INSERT INTO `cursos` (`idCurso`, `nomeCurso`, `created_at`) VALUES (7, 'Eng Producao', current_timestamp());
INSERT INTO `cursos` (`idCurso`, `nomeCurso`, `created_at`) VALUES (8, 'Nutricao', current_timestamp());
INSERT INTO `cursos` (`idCurso`, `nomeCurso`, `created_at`) VALUES (9, 'Arquitetura e Urbanismo', current_timestamp());
INSERT INTO `cursos` (`idCurso`, `nomeCurso`, `created_at`) VALUES (10, 'Ciencias Contabeis', current_timestamp());
INSERT INTO `cursos` (`idCurso`, `nomeCurso`, `created_at`) VALUES (11, 'Educacao Fisica', current_timestamp());
INSERT INTO `cursos` (`idCurso`, `nomeCurso`, `created_at`) VALUES (12, 'Enfermagem', current_timestamp());
INSERT INTO `cursos` (`idCurso`, `nomeCurso`, `created_at`) VALUES (13, 'Biomedicina', current_timestamp());
INSERT INTO `cursos` (`idCurso`, `nomeCurso`, `created_at`) VALUES (14, 'Estetica', current_timestamp());
INSERT INTO `cursos` (`idCurso`, `nomeCurso`, `created_at`) VALUES (15, 'Fisioterapia', current_timestamp());
INSERT INTO `cursos` (`idCurso`, `nomeCurso`, `created_at`) VALUES (16, 'Pedagogia', current_timestamp());


INSERT INTO `eventos`(`nomeEvento`, `local`, `dataEvento`, `horarioInicio`, `horarioTermino`,`descricao`) VALUES ('nometeste','localteste','2023-03-18','12:00','15:00', 'descricaoteste awawawa  awawawaawaawawa');

INSERT INTO `eventos`(`nomeEvento`, `local`, `dataEvento`, `horarioInicio`, `horarioTermino`,`descricao`) VALUES ('nometeste2','localteste2','2024-04-19','11:00','16:00', 'descricaoteste awawawa  rsrsads awawawaawaawawa');

-- Usuario do banco de dados
--senha: sapatosalsicha

GRANT USAGE ON *.* TO `Josney`@`%` IDENTIFIED BY PASSWORD '*8BFD8FDC94D4D184466B849261B3C51BE7043CD0';

GRANT ALL PRIVILEGES ON `eventosfaculdade`.* TO `Josney`@`%` WITH GRANT OPTION;

-- Se precisar excluir um evento que tenha alunos com presença
ALTER TABLE `presenca` DROP FOREIGN KEY `fk_aln`; ALTER TABLE `presenca` ADD CONSTRAINT `fk_aln` FOREIGN KEY (`ra`) REFERENCES `alunos`(`ra`) ON DELETE CASCADE ON UPDATE RESTRICT; ALTER TABLE `presenca` DROP FOREIGN KEY `fk_evt`; ALTER TABLE `presenca` ADD CONSTRAINT `fk_evt` FOREIGN KEY (`idEvento`) REFERENCES `eventos`(`idEvento`) ON DELETE CASCADE ON UPDATE RESTRICT;

-- Voltar ao normal
ALTER TABLE `presenca` DROP FOREIGN KEY `fk_aln`; ALTER TABLE `presenca` ADD CONSTRAINT `fk_aln` FOREIGN KEY (`ra`) REFERENCES `alunos`(`ra`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `presenca` DROP FOREIGN KEY `fk_evt`; ALTER TABLE `presenca` ADD CONSTRAINT `fk_evt` FOREIGN KEY (`idEvento`) REFERENCES `eventos`(`idEvento`) ON DELETE RESTRICT ON UPDATE RESTRICT;



INSERT INTO `presenca`(`idEvento`, `ra`) VALUES (1,'0391221');

-- Exemplos de Procedure

-- DELIMITER //

-- CREATE PROCEDURE GetAllProducts()
-- BEGIN
-- 	SELECT *  FROM products;
-- END //

-- DELIMITER ;

CREATE PROCEDURE procurarAluno(IN ra int)
BEGIN
	SELECT *  FROM alunos WHERE ra = ra;
END;


