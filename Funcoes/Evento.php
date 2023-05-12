<?php
require('Model.php');

class Evento extends conexao
{

  public function cadastrarEvento($nomeEvento, $descricao, $local, $dataEvento, $horarioInicio, $horarioTermino, $codigoCoord): bool
  {


    $sql = "INSERT INTO eventos (nomeEvento, descricao, local, dataEvento, horarioInicio, horarioTermino, codigoCoord) VALUES (:nomeEvento, :descricao, :local, :dataEvento, :horarioInicio, :horarioTermino, :codigoCoord)";
    $stmt = $this->getPdo()->prepare($sql);

    $stmt->bindParam(':nomeEvento', $nomeEvento, PDO::PARAM_STR);
    $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
    $stmt->bindParam(':local', $local, PDO::PARAM_STR);
    $stmt->bindParam(':dataEvento', $dataEvento, PDO::PARAM_STR);
    $stmt->bindParam(':horarioInicio', $horarioInicio, PDO::PARAM_STR);
    $stmt->bindParam(':horarioTermino', $horarioTermino, PDO::PARAM_STR);
    $stmt->bindParam('codigoCoord', $codigoCoord, PDO::PARAM_STR);

    return $stmt->execute();
  }

  public function verificareventoExistente($nomeEvento)
  {

    // Seleciona o evento
    $sql = "SELECT * FROM eventos WHERE nomeEvento = :nomeEvento";
    $stmt = $this->getPdo()->prepare($sql);
    $stmt->bindParam(':nomeEvento', $nomeEvento, PDO::PARAM_STR);
    $stmt->execute();
    $nomeEvento = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o envento foi encontrado

    return $nomeEvento;
  }

  public function consultarEvento($idEvento)
  {


    $sql = "SELECT * FROM eventos WHERE idEvento = :idEvento";
    $stmt = $this->getPdo()->prepare($sql);
    $stmt->bindParam(':idEvento', $idEvento);
    $stmt->execute();
    return $stmt->fetch();
  }

  function atualizarEvento($idEvento, $nomeEvento, $descricao, $local, $dataEvento, $horarioInicio, $horarioTermino, $codigoCoord): bool
  {


    $sql = "UPDATE eventos SET nomeEvento = :nomeEvento, descricao = :descricao, local = :local, dataEvento = :dataEvento, horarioInicio = :horarioInicio, horarioTermino = :horarioTermino, codigoCoord = :codigoCoord WHERE idEvento = :idEvento";
    $stmt = $this->getPdo()->prepare($sql);
    $stmt->bindParam(':idEvento', $idEvento, PDO::PARAM_INT);
    $stmt->bindParam(':nomeEvento', $nomeEvento, PDO::PARAM_STR);
    $stmt->bindParam(':descricao', $descricao, PDO::PARAM_STR);
    $stmt->bindParam(':local', $local, PDO::PARAM_STR);
    $stmt->bindParam(':dataEvento', $dataEvento);
    $stmt->bindParam(':horarioInicio', $horarioInicio);
    $stmt->bindParam(':horarioTermino', $horarioTermino);
    $stmt->bindParam('codigoCoord', $codigoCoord);
    return $stmt->execute();
  }

  public function excluirEvento($idEvento): bool
  {


    $sql = "DELETE FROM eventos WHERE idEvento = :idEvento";
    $stmt = $this->getPdo()->prepare($sql);
    $stmt->bindParam(':idEvento', $idEvento);
    return $stmt->execute();
  }
}
