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

//converter data para inserir 


switch ($_POST['tiporeq_evt']) {
  case 'Register':
    if (!verificareventoExistente($nomeEvento)) {
      $evento = cadastrarEvento($nomeEvento, $descricao, $local, $dataEvento, $horarioInicio, $horarioTermino, $codigoCoord);
    } else {
      echo 'Este evento ja foi cadastrado.';
    }
    
    break;
  case 'Delete':
    excluirEvento($idEvento);
    
    break;
  case 'Update':
    $evento = atualizarEvento($idEvento, $nomeEvento, $descricao, $local, $dataEvento, $horarioInicio, $horarioTermino, $codigoCoord);
    if (!$evento) {
      die('Erro ao atualizar evento');
    }

    break;

  default:
    die('calma que deu merda');
    break;
}

header('Location: ../HomeCoordenador.php');