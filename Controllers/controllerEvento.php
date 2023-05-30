<?php

if (!isset($_POST['tiporeq_evt'])) {
  header('Location: ../?erro=url');
  return false;
}

require_once('../Funcoes/Evento.php');
$Evento = new Evento();



switch ($_POST['tiporeq_evt']) {
  case 'Register':
    if (!$Evento->verificareventoExistente($_POST['nomeEvento'])) {
      $novoEvento = $Evento->cadastrarEvento($_POST['nomeEvento'], $_POST['descricao'], $_POST['local'], $_POST['dataEvento'], $_POST['horarioInicio'], $_POST['horarioTermino'], $_POST['codigoCoord']);
      $mensagem = 'Evento cadastrado com sucesso.';
    } else {
      $mensagem = 'Este evento ja foi cadastrado.';
    }

    break;
  case 'Delete':
    try {
      // Seu código de exclusão do evento aqui
      $Evento->excluirEvento($_POST['idEvento']);
      $mensagem = 'Evento deletado';
      // Exibir mensagem de sucesso se a exclusão for bem-sucedida
      echo "Evento excluído com sucesso!";
    } catch (PDOException $e) {
      // Verificar se a exceção é devido a uma violação de chave estrangeira
      if ($e->getCode() === '23000') {
        // Exibir uma mensagem de erro personalizada para o usuário
        $mensagem = "Nao e possivel excluir o evento devido a restricoes de integridade referencial. (Tem alunos inscritos nesse evento)";
      } else {
        // Lidar com outras exceções caso necessário
        $mensagem = "Ocorreu um erro ao excluir o evento.";
      }
    }


    break;
  case 'Update':
    $evento = $Evento->atualizarEvento($_POST['idEvento'], $_POST['nomeEvento'], $_POST['descricao'], $_POST['local'], $_POST['dataEvento'], $_POST['horarioInicio'], $_POST['horarioTermino'], $_POST['codigoCoord']);
    $mensagem = "Evento atualizado";
    if (!$evento) {
      $mensagem = 'Erro ao atualizar evento';
    }

    break;

  default:
    $mensagem = 'Deu algum erro na hora de salvar no banco, calma lá';
    break;
}

header('Location: ../HomeCoordenador.php?message=' . json_encode($mensagem));
