
CREATE TABLE presenca (
    idEvento INT NOT NULL,
    idAluno INT NOT NULL,
    --codigoCoord VARCHAR(25),  -> alterado para a tabela eventos e fazer um join para comparar
    codigoAluno VARCHAR(25),
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
                     ON UPDATE CURRENT_TIMESTAMP,
  KEY (updated_at),
    qtdTentativas TINYINT unsigned DEFAULT 0,
    PRIMARY KEY (idEvento, idAluno),
    CONSTRAINT fk_evt FOREIGN KEY (idEvento) REFERENCES eventos(idEvento),
    CONSTRAINT fk_aln FOREIGN KEY (idAluno) REFERENCES alunos(idAluno)
);
<?php

require_once('../libs/conexao.php');

function inscrever($idEvento, $idAluno)
{
    global $pdo;

    $sql ="INSERT INTO presenca(idEvento, idAluno) VALUES (:idEvento, :idAluno)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idEvento', $idEvento, PDO::PARAM_INT);
    $stmt->bindParam(':idAluno', $idAluno, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: ../HomeAluno.php');
    } else {
        echo 'deu errado pra te inscrever';
    }
}

function verificarInscricao($idEvento, $idAluno)
{
    global $pdo;

    $sql = "SELECT * FROM presenca WHERE nomeEvento = :nomeEvento  && idAluno = :idAluno";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idEvento', $idEvento, PDO::PARAM_INT);
    $stmt->bindParam(':idAluno', $idAluno, PDO::PARAM_INT);
    $stmt->execute();
    $verificacao = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($verificacao) 
    {
        return true;

    } else 
    {
        return false;
    }
}

function validarPresenca($idEvento, $idAluno)
{
    global $pdo;

    $sql = "SELECT e.*, p.*
    FROM eventos e
    INNER JOIN presenca p ON p.idEvento = e.idEvento
    WHERE p.idEvento = :idEvento AND p.idAluno = :idAluno AND p.codigoAluno = e.codigoCoord;";

    $stmt = $pdo->prepare($sql);
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idEvento', $idEvento, PDO::PARAM_INT);
    $stmt->bindParam(':idAluno', $idAluno, PDO::PARAM_INT);
    $stmt->execute();


    return $stmt->fetch();
    

}


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