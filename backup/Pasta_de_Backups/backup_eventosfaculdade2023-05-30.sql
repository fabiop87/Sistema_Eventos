CREATE TABLE `alunos` (
  `ra` varchar(7) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `idCurso` int(11) NOT NULL,
  `senha` varchar(80) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ra`),
  KEY `idCurso` (`idCurso`),
  CONSTRAINT `alunos_ibfk_1` FOREIGN KEY (`idCurso`) REFERENCES `cursos` (`idCurso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO alunos VALUES ('0391221', 'fabio', '1', '$2y$10$MXdFsQ9L9H2BqVk8NrONaeL8J9INGIqpW.LdZPAX3OrZANouugL3C', '2023-04-18 16:08:07');
INSERT INTO alunos VALUES ('1111111', 'awawa', '6', '$2y$10$etGbTA0kWMSOqnN1Zqtw4.CG3ROPbz548DYAf5z5/mVTBhVgzYYKC', '2023-04-20 22:24:37');
INSERT INTO alunos VALUES ('2222222', 'awawa', '6', '$2y$10$bxcknS6C6ZIeyJHfC0f3ZuCpGa84NPTrfppoc.TrBSxbDJbrqpolm', '2023-04-24 22:59:47');
INSERT INTO alunos VALUES ('5555555', 'fabio', '7', '$2y$10$wwQytfWqGk1ZBBtdtWcLWuMsdZ2VogpPKq4xy/f2ReUwY1NKSwtSG', '2023-05-18 11:36:22');
INSERT INTO alunos VALUES ('8888888', 'testejhonson', '2', '$2y$10$4OdAp.NM37Ka8G3azo018uqnt7.GrUg2dTa6H4zNKl6KSD11OB2VK', '2023-05-20 00:34:53');
CREATE TABLE `coordenadores` (
  `idCoordenador` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `idCurso` int(11) NOT NULL,
  `senha` varchar(80) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`idCoordenador`),
  UNIQUE KEY `nome` (`nome`),
  KEY `idCurso` (`idCurso`),
  CONSTRAINT `coordenadores_ibfk_1` FOREIGN KEY (`idCurso`) REFERENCES `cursos` (`idCurso`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO coordenadores VALUES ('1', 'fabio', '1', '$2y$10$J0wDwk5rRc1OUL2Dd5MHEuHamcVD5WA8y.p2DrohATKsAb3O3W..S', '2023-04-18 16:07:41');
INSERT INTO coordenadores VALUES ('2', 'teste', '15', '$2y$10$u1csUEZ/YrQ.b0ti1KTH2e.lgS0Liz.qDlRZS0Gkcu5bUU72nMm.6', '2023-05-11 00:27:10');
INSERT INTO coordenadores VALUES ('3', 'jhonson', '4', '$2y$10$J/Wq1REjwaDzTL9cxo3iNO1twbhsk/MUp1NkUVl.KFhhHkILYOGk2', '2023-05-16 02:34:23');
INSERT INTO coordenadores VALUES ('4', 'nelson', '12', '$2y$10$BtinLdoNJNB8800klXuY7u5PcxSBXZiw1hQAO/lGT9Yr9afM5PiNm', '2023-05-21 21:40:43');
INSERT INTO coordenadores VALUES ('5', 'nelson2', '9', '$2y$10$kQ2ZW/8dMMnoIwf4Imw7AuRxPgb1AMJdcMFkRfIQZj7.BXl3uy3yu', '2023-05-21 22:09:40');
CREATE TABLE `cursos` (
  `idCurso` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCurso` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`idCurso`),
  UNIQUE KEY `nomeCurso` (`nomeCurso`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO cursos VALUES ('1', 'TADS', '2023-04-18 16:06:16');
INSERT INTO cursos VALUES ('2', 'Psicologia', '2023-04-18 16:06:16');
INSERT INTO cursos VALUES ('3', 'Eng Civil', '2023-04-18 16:06:16');
INSERT INTO cursos VALUES ('4', 'Eng Mecanica', '2023-04-18 16:06:16');
INSERT INTO cursos VALUES ('6', 'Eng Eletrica', '2023-04-18 16:06:16');
INSERT INTO cursos VALUES ('7', 'Eng Producao', '2023-04-18 16:06:16');
INSERT INTO cursos VALUES ('8', 'Nutricao', '2023-04-18 16:06:16');
INSERT INTO cursos VALUES ('9', 'Arquitetura e Urbanismo', '2023-04-18 16:06:16');
INSERT INTO cursos VALUES ('10', 'Ciencias Contabeis', '2023-04-18 16:06:16');
INSERT INTO cursos VALUES ('11', 'Educacao Fisica', '2023-04-18 16:06:16');
INSERT INTO cursos VALUES ('12', 'Enfermagem', '2023-04-18 16:06:16');
INSERT INTO cursos VALUES ('13', 'Biomedicina', '2023-04-18 16:06:16');
INSERT INTO cursos VALUES ('14', 'Estetica', '2023-04-18 16:06:16');
INSERT INTO cursos VALUES ('15', 'Fisioterapia', '2023-04-18 16:06:16');
INSERT INTO cursos VALUES ('16', 'Pedagogia', '2023-04-18 16:06:16');
CREATE TABLE `eventos` (
  `idEvento` int(11) NOT NULL AUTO_INCREMENT,
  `nomeEvento` varchar(100) NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `local` varchar(100) DEFAULT NULL,
  `dataEvento` date DEFAULT NULL,
  `horarioInicio` time DEFAULT NULL,
  `horarioTermino` time DEFAULT NULL,
  `codigoCoord` varchar(25) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`idEvento`),
  KEY `updated_at` (`updated_at`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO eventos VALUES ('2', '42424142', 'hyrehe  ', 'efwefwfwfw', '2222-06-09', '04:42:00', '21:02:00', '123', '2023-04-18 16:52:32', '2023-05-19 23:53:01');
INSERT INTO eventos VALUES ('3', 'asdad', 'twtwe  y', '14242', '2023-07-18', '11:11:00', '11:56:00', '123', '2023-04-19 22:29:15', '2023-05-29 23:26:52');
INSERT INTO eventos VALUES ('4', 'y45758', 'dfg  grgr ', 'gfgdg', '2023-06-21', '04:24:00', '05:01:00', '123', '2023-04-20 16:08:13', '2023-05-19 23:53:10');
INSERT INTO eventos VALUES ('5', 'ggsjgdhgdjkgdgd', 'tdsdfsdfs   ', 'fsdfsdfs', '2023-05-29', '11:11:00', '22:22:00', '123', '2023-04-24 23:06:19', '2023-05-19 23:52:54');
INSERT INTO eventos VALUES ('6', 'ssssssssss', 'sffsfs   ', 'adsdad66666666666', '2023-06-29', '11:01:00', '11:01:00', '22112', '2023-04-24 23:23:45', '2023-05-21 22:20:48');
INSERT INTO eventos VALUES ('8', 'aw243', '412ds ', 'asa', '2023-06-27', '12:22:00', '02:41:00', '123', '2023-05-09 17:03:02', '2023-05-19 23:53:07');
INSERT INTO eventos VALUES ('10', 'testeffffff', 'ffffffffffff   ', 'ffffffffffffffffffff', '2023-06-19', '00:11:00', '04:04:00', '123', '2023-05-17 00:09:45', '2023-05-19 23:53:14');
INSERT INTO eventos VALUES ('11', 'fopkw9of', 'dadaddada', 'pokoa', '2023-07-13', '11:11:00', '11:01:00', '123', '2023-05-19 23:53:35', '2023-05-19 23:53:35');
INSERT INTO eventos VALUES ('12', 'nnnnnn6f', 'bbbbb    ', 'bbbbbb', '2023-07-12', '11:01:00', '11:01:00', '123', '2023-05-19 23:53:48', '2023-05-29 23:28:04');
INSERT INTO eventos VALUES ('13', 'teste', 'teste incrivel ', 'não sei', '2023-05-31', '11:00:00', '14:00:00', '123', '2023-05-28 15:35:48', '2023-05-28 16:00:47');
INSERT INTO eventos VALUES ('14', '1', '1', '1', '2023-05-23', '11:11:00', '12:22:00', '1', '2023-05-29 22:38:02', '2023-05-29 22:38:02');
INSERT INTO eventos VALUES ('15', 'testedata', 'testedata', 'testedata', '2023-05-16', '02:42:00', '23:04:00', '1', '2023-05-29 22:39:00', '2023-05-29 22:39:00');
CREATE TABLE `presenca` (
  `idEvento` int(11) NOT NULL,
  `ra` varchar(7) NOT NULL,
  `codigoAluno` varchar(25) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `qtdTentativas` tinyint(3) unsigned DEFAULT 0,
  PRIMARY KEY (`idEvento`,`ra`),
  KEY `updated_at` (`updated_at`),
  KEY `fk_aln` (`ra`),
  CONSTRAINT `fk_aln` FOREIGN KEY (`ra`) REFERENCES `alunos` (`ra`),
  CONSTRAINT `fk_evt` FOREIGN KEY (`idEvento`) REFERENCES `eventos` (`idEvento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
INSERT INTO presenca VALUES ('2', '0391221', '123', '2023-05-08 23:30:50', '2023-05-08 23:30:55', '1');
INSERT INTO presenca VALUES ('2', '1111111', '123', '2023-05-18 11:31:10', '2023-05-18 11:31:56', '1');
INSERT INTO presenca VALUES ('3', '1111111', '123', '2023-05-20 00:21:07', '2023-05-20 00:21:10', '1');
INSERT INTO presenca VALUES ('4', '0391221', '123', '2023-05-10 23:35:04', '2023-05-16 02:33:12', '1');
INSERT INTO presenca VALUES ('5', '1111111', '123', '2023-05-18 11:28:04', '2023-05-18 11:28:16', '1');
INSERT INTO presenca VALUES ('6', '0391221', '', '2023-05-21 22:29:30', '2023-05-21 22:29:30', '0');
INSERT INTO presenca VALUES ('6', '1111111', '22112', '2023-05-29 23:38:43', '2023-05-29 23:40:23', '3');
INSERT INTO presenca VALUES ('8', '0391221', '123', '2023-05-09 17:03:26', '2023-05-09 17:03:33', '1');
INSERT INTO presenca VALUES ('12', '0391221', '123', '2023-05-24 23:23:57', '2023-05-24 23:24:07', '1');
INSERT INTO presenca VALUES ('13', '0391221', '123', '2023-05-28 16:00:56', '2023-05-28 16:02:26', '1');
