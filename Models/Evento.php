<?php
require_once('conexao.php');

$nomeEvento = $_POST['nomeEvento'];
$local = $_POST['local'];
$dataEvento = $_POST['dataEvento'];
$horarioInicio = $_POST['horarioInicio'];
$horarioTermino = $_POST['horarioTermino'];

$sql = "INSERT INTO eventos (nomeEvento, local, dataEvento, horarioInicio, horarioTermino) VALUES (:nomeEvento, :local, :dataEvento, :horarioInicio, :horarioTermino)";
$stmt = $conexao->prepare($sql);
$stmt->bindParam(':nomeEvento', $nomeEvento);
$stmt->bindParam(':local', $local);
$stmt->bindParam(':dataEvento', $dataEvento);
$stmt->bindParam(':horarioInicio', $horarioInicio);
$stmt->bindParam(':horarioTermino', $horarioTermino);

if ($stmt->execute()) {
  header('Location: listar_eventos.php');
} else {
  echo "Erro ao cadastrar o evento.";
}
?>
