<?php

var_dump($_POST);



if (!isset($_POST['tiporeq_evt'])) {
  header('Location:/?erro=url');
  return false;
}

require('../Funcoes/Evento.php');

$idEvento = $_POST['idEvento'] ?? null;
$nomeEvento = $_POST['nomeEvento'] ?? null;
$descricao = $_POST['descricao'] ?? null;
$local = $_POST['local'] ?? null;
$dataEvento = $_POST['dataEvento'] ?? null;
$horarioInicio = $_POST['horarioInicio'] ?? null;
$horarioTermino = $_POST['horarioTermino'] ?? null;
$codigoCoord = $_POST['codigoCoord'] ?? null;

switch ($_POST['tiporeq_evt']) {
  case 'Register':
    if (!verificareventoExistente($nomeEvento)) {
      $evento = cadastrarEvento($nomeEvento, $descricao, $local, $dataEvento, $horarioInicio, $horarioTermino, $codigoCoord);
    } else {
      echo 'Este envento ja foi cadastrado.';
    }
    break;
  case 'Delete':
    excluirEvento($idEvento);
    $fallback = '../HomeCoordenador.php';

    $anterior = isset($_SERVER['HTTP_REFERER']) ??  $fallback;

    header("location: {$anterior}");
    exit;
    break;

  default:
    # code...
    break;
}
