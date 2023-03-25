<?php

require_once('Model.php');
class Presenca extends conexao
{



    public function inscrever($idEvento, $idAluno)
{


    $sql ="INSERT INTO presenca(idEvento, idAluno) VALUES (:idEvento, :idAluno)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':idEvento', $idEvento, PDO::PARAM_INT);
    $stmt->bindParam(':idAluno', $idAluno, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header('Location: ../HomeAluno.php');
    } else {
        echo 'deu errado pra te inscrever';
    }
}

public function verificarInscricao($idEvento, $idAluno)
{

    $sql = "SELECT * FROM presenca WHERE idEvento = :idEvento AND idAluno = :idAluno";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':idEvento', $idEvento, PDO::PARAM_INT);
    $stmt->bindParam(':idAluno', $idAluno, PDO::PARAM_INT);
    var_dump($stmt);
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

public function validarCertificado($idEvento, $idAluno)
{


    $sql = "SELECT e.*, p.*
    FROM eventos e
    INNER JOIN presenca p ON p.idEvento = e.idEvento
    WHERE p.idEvento = :idEvento AND p.idAluno = :idAluno AND p.codigoAluno = e.codigoCoord;";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':idEvento', $idEvento, PDO::PARAM_INT);
    $stmt->bindParam(':idAluno', $idAluno, PDO::PARAM_INT);
    $stmt->execute();


    return $stmt->fetch();
    
}

public function confirmarPresenca($idEvento, $idAluno, $codigoAluno)
{

    //verificar quantidade de tentativas
    // pegar update 
    $limiteTentativas = 3;
    
    $sql = "UPDATE presenca SET codigoAluno = :codigoAluno, qtdTentativas = qtdTentativas + 1 WHERE idEvento = :idEvento AND idAluno = :idAluno  AND qtdTentativas <= '$limiteTentativas'";

    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':idEvento', $idEvento, PDO::PARAM_INT);
    $stmt->bindParam(':idAluno', $idAluno, PDO::PARAM_INT);
    $stmt->bindParam(':codigoAluno', $codigoAluno, PDO::PARAM_STR);
    $stmt->execute();

    // Retorna verdadeiro se a atualização foi bem sucedida  | true/false
    return $stmt->rowCount() > 0;

}



function desinscrever($idEvento, $idAluno)
{


    $sql = "DELETE FROM presenca WHERE idEvento = :idEvento AND idAluno = :idAluno";
    $stmt = $this->pdo->prepare($sql);
    $stmt->bindParam(':idEvento', $idEvento, PDO::PARAM_INT);
    $stmt->bindParam(':idAluno', $idAluno, PDO::PARAM_INT);
    return $stmt->execute();
}

}
/* 
update
UPDATE presenca SET qtdTentativas = 1 WHERE idEvento = 1 AND idAluno = 2;
UPDATE presenca
SET qtdTentativas = qtdTentativas + 1
WHERE idEvento = valor_idEvento AND idAluno = valor_idAluno;
(fazer um if qtd tentativas >= 3 nao pode mais)

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




delete
DELETE FROM presenca WHERE idEvento = 1 AND idAluno = 2;
DELETE FROM presenca
WHERE idEvento = valor_idEvento AND idAluno = valor_idAluno;








*/