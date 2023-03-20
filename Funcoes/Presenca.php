<?php

/* 

confirmar presenca

SELECT e.*, p.*
FROM eventos e
INNER JOIN presenca p ON p.idEvento = e.idEvento
WHERE p.idEvento = 1 AND p.idAluno = 2 AND p.codigoAluno = e.codigoCoord;



insert 

INSERT INTO presenca (idEvento, idAluno, codigoAluno) VALUES (1, 2, 'CODIGO_ALUNO');

INSERT INTO presenca (idEvento, idAluno, codigoAluno)
VALUES (valor_idEvento, valor_idAluno, valor_codigoAluno);



read
SELECT * FROM presenca;
SELECT e.nomeEvento, e.local, e.dataEvento, e.horarioInicio, e.horarioTermino, p.codigoAluno, p.qtdTentativas
FROM presenca p
INNER JOIN eventos e ON p.idEvento = e.idEvento
WHERE p.codigoAluno = e.codigoCoord;


update
UPDATE presenca SET qtdTentativas = 1 WHERE idEvento = 1 AND idAluno = 2;
UPDATE presenca
SET qtdTentativas = qtdTentativas + 1
WHERE idEvento = valor_idEvento AND idAluno = valor_idAluno;
(fazer um if qtd tentativas >= 3 nao pode mais)


delete
DELETE FROM presenca WHERE idEvento = 1 AND idAluno = 2;
DELETE FROM presenca
WHERE idEvento = valor_idEvento AND idAluno = valor_idAluno;











*/