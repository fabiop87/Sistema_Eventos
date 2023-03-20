<?php
require_once('../libs/conexao.php');



function cadastrarEvento($nomeEvento, $descricao, $local, $dataEvento, $horarioInicio, $horarioTermino, $codigoCoord)
{
  global $pdo;

  $sql = "INSERT INTO eventos (nomeEvento, descricao, local, dataEvento, horarioInicio, horarioTermino, codigoCoord) VALUES (:nomeEvento, :local, :dataEvento, :horarioInicio, :horarioTermino, :codigoCoord)";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':nomeEvento', $nomeEvento, PDO::PARAM_STR);
  $stmt->bindParam(':descricao', $nomeEvento, PDO::PARAM_STR);
  $stmt->bindParam(':local', $local, PDO::PARAM_STR);
  $stmt->bindParam(':dataEvento', $dataEvento);
  $stmt->bindParam(':horarioInicio', $horarioInicio);
  $stmt->bindParam(':horarioTermino', $horarioTermino);
  $stmt->bindParam('codigoCoord', $codigoCoord);

  if ($stmt->execute()) {
    header('Location: ../HomeCoordenador.php');
  } else {
    echo "Erro ao cadastrar o evento.";
  }
}

function consultarEvento($idEvento)
{
  global $pdo;

  $sql = "SELECT * FROM eventos WHERE idEvento = :idEvento";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':idEvento', $idEvento);
  $stmt->execute();
  return $stmt->fetch();
}

function atualizarEvento($idEvento, $nomeEvento, $local, $dataEvento, $horarioInicio, $horarioTermino, $codigoCoord)
{
  global $pdo;

  $sql = "UPDATE eventos SET nomeEvento = :nomeEvento, descricao = :descricao, local = :local, dataEvento = :dataEvento, horarioInicio = :horarioInicio, horarioTermino = :horarioTermino, codigoCoord = :codigoCoord WHERE idEvento = :idEvento";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':idEvento', $idEvento, PDO::PARAM_INT);
  $stmt->bindParam(':nomeEvento', $nomeEvento, PDO::PARAM_STR);
  $stmt->bindParam(':descricao', $nomeEvento, PDO::PARAM_STR);
  $stmt->bindParam(':local', $local, PDO::PARAM_STR);
  $stmt->bindParam(':dataEvento', $dataEvento);
  $stmt->bindParam(':horarioInicio', $horarioInicio);
  $stmt->bindParam(':horarioTermino', $horarioTermino);
  $stmt->bindParam('codigoCoord', $codigoCoord);
  return $stmt->execute();
}

function excluirEvento($idEvento)
{
  global $pdo;

  $sql = "DELETE FROM eventos WHERE idEvento = :idEvento";
  $stmt = $pdo->prepare($sql);
  $stmt->bindParam(':idEvento', $idEvento);
  return $stmt->execute();
}


// fazer o controller
$nomeEvento = $_POST['nomeEvento'];
$local = $_POST['local'];
$dataEvento = $_POST['dataEvento'];
$horarioInicio = $_POST['horarioInicio'];
$horarioTermino = $_POST['horarioTermino'];
$codigoCoord = $_POST['codigoCoord'];
