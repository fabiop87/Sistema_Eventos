<?php

if (!isset($_POST['tiporeq_evt'])) {
  header('Location:/?erro=url');
  return false;
}

require_once('../Funcoes/Evento.php');
$Evento = new Evento();



switch ($_POST['tiporeq_evt']) {
  case 'Register':
    if (!$Evento->verificareventoExistente($_POST['nomeEvento'])) {
      $novoEvento = $Evento->cadastrarEvento($_POST['nomeEvento'], $_POST['descricao'], $_POST['local'], $_POST['dataEvento'], $_POST['horarioInicio'], $_POST['horarioTermino'], $_POST['codigoCoord']);
    } else {
      $mensagem = 'Este evento ja foi cadastrado.';
    }
    
    break;
  case 'Delete':
    $Evento->excluirEvento($_POST['idEvento']);
    
    break;
  case 'Update':
    $evento = $Evento->atualizarEvento($_POST['idEvento'], $_POST['nomeEvento'], $_POST['descricao'], $_POST['local'], $_POST['dataEvento'], $_POST['horarioInicio'], $_POST['horarioTermino'], $_POST['codigoCoord']);
    if (!$evento) {
      $mensagem = 'Erro ao atualizar evento';

    }

    break;

  default:
    $mensagem = 'Deu algum erro na hora de salvar no banco, calma lá';
    break;
}

header('Location: ../HomeCoordenador.php?message='. json_encode($mensagem));