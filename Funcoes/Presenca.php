<?php

require_once('Model.php');
class Presenca extends conexao
{



    public function inscrever($idEvento, $ra)
    {


        $sql = "INSERT INTO presenca(idEvento, ra) VALUES (:idEvento, :ra)";
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam(':idEvento', $idEvento, PDO::PARAM_INT);
        $stmt->bindParam(':ra', $ra, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function verificarInscricao($idEvento, $ra)
    {

        $sql = "SELECT * FROM presenca WHERE idEvento = :idEvento AND ra = :ra";
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam(':idEvento', $idEvento, PDO::PARAM_INT);
        $stmt->bindParam(':ra', $ra, PDO::PARAM_STR);
        $stmt->execute();
        $verificacao = $stmt->fetch(PDO::FETCH_ASSOC);

        return $verificacao;
    }

    public function validarCertificado($idEvento, $ra)
    {


        $sql = "SELECT e.*, p.*
    FROM eventos e
    INNER JOIN presenca p ON p.idEvento = e.idEvento
    WHERE p.idEvento = :idEvento AND p.ra = :ra AND p.codigoAluno = e.codigoCoord;";

        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam(':idEvento', $idEvento, PDO::PARAM_INT);
        $stmt->bindParam(':ra', $ra, PDO::PARAM_STR);
        $stmt->execute();


        return $stmt->fetch();
    }

    public function confirmarPresenca($idEvento, $ra, $codigoAluno)
    {

        //verificar quantidade de tentativas
        // pegar update 
        $limiteTentativas = 3;

        $sql = "UPDATE presenca SET codigoAluno = :codigoAluno, qtdTentativas = qtdTentativas + 1 WHERE idEvento = :idEvento AND ra = :ra  AND qtdTentativas <= '$limiteTentativas'";

        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam(':idEvento', $idEvento, PDO::PARAM_INT);
        $stmt->bindParam(':ra', $ra, PDO::PARAM_STR);
        $stmt->bindParam(':codigoAluno', $codigoAluno, PDO::PARAM_STR);
        $stmt->execute();

        // Retorna verdadeiro se a atualização foi bem sucedida  | true/false
        return $stmt->rowCount() > 0;
    }

    public function EventosComCertificadoLiberado($ra)
    {
        $sql = "SELECT e.idEvento, e.nomeEvento, e.local, e.dataEvento, e.horarioInicio, e.horarioTermino
        FROM presenca p INNER JOIN eventos e ON p.idEvento = e.idEvento 
        AND p.codigoAluno = e.codigoCoord WHERE ra = :ra
        ORDER BY dataEvento DESC
        ";

        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindParam(':ra', $ra, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    function desinscrever($idEvento, $ra)
    {


        $sql = "DELETE FROM presenca WHERE idEvento = :idEvento AND ra = :ra";
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam(':idEvento', $idEvento, PDO::PARAM_INT);
        $stmt->bindParam(':ra', $ra, PDO::PARAM_STR);
        return $stmt->execute();
    }
}
