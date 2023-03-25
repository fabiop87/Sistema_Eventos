<?php

var_dump($_POST);



if (!isset($_POST['tiporeq_evt'])) {
  header('Location:/?erro=url');
  return false;
}

require('../Funcoes/Evento.php');
$Evento = new Evento();

//converter data para inserir 


switch ($_POST['tiporeq_evt']) {
  case 'Register':
    if (!$Evento->verificareventoExistente($_POST['nomeEvento'])) {
      $novoEvento = $Evento->cadastrarEvento($_POST['nomeEvento'], $_POST['descricao'], $_POST['local'], $_POST['dataEvento'], $_POST['horarioInicio'], $_POST['horarioTermino'], $_POST['codigoCoord']);
    } else {
      echo 'Este evento ja foi cadastrado.';
    }
    
    break;
  case 'Delete':
    $Evento->excluirEvento($_POST['idEvento']);
    
    break;
  case 'Update':
    $evento = $Evento->atualizarEvento($_POST['idEvento'], $_POST['nomeEvento'], $_POST['descricao'], $_POST['local'], $_POST['dataEvento'], $_POST['horarioInicio'], $_POST['horarioTermino'], $_POST['codigoCoord']);
    if (!$evento) {
      die('Erro ao atualizar evento');
    }

    break;

  default:
    die('calma que deu merda');
    break;
}

header('Location: ../HomeCoordenador.php');