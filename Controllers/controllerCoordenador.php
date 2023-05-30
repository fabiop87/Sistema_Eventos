<?php

if (isset($_POST['tiporeq'])) {
  header('Location: ../?erro=url');
  return false;
}

require_once('../Funcoes/Coordenador.php');
$Coordenador = new Coordenador();
$tiporeq = $_POST['LoginouRegister'];

// Os tipos podem ser Login ou Registrar


switch ($tiporeq) {
  case 'Register':

    // Confirmar se as senhas batem
    if ($_POST['senha'] != $_POST['confirm_senha']) {
      echo 'As senhas devem coincidir';
    }

    if ($_POST['cdcod'] !== 'sanxJsjM9Yx3Y') {
      die('<marquee> Tem que colocar o código para cadastrar </marquee>');
    }

    if (!$Coordenador->verificarCoordenadorExistente($_POST['nome'])) {
      $novoCoordenador = $Coordenador->cadastrarCoordenador($_POST['nome'], $_POST['idCurso'], $_POST['senha']);
    } else {
      $mensagem = 'Este coordenador já está cadastrado';
      header('Location: ../CadastroCoord.php?message='. $mensagem);
    }

    // Verifica se o cadastro foi bem sucedido
    if ($Coordenador) {
      // Define uma mensagem de sucesso para ser exibida na página
      $mensagem = 'Coordenador cadastrado com sucesso!';
      header('Location: ../index.php?message='. json_encode($mensagem));
    } else {
      // Define uma mensagem de erro para ser exibida na página
      $mensagem = 'Ocorreu um erro ao cadastrar o coordenador.';
      header('Location: ../CadastroCoord.php?message='. json_encode($mensagem));
    }

    break;
  case 'Login':

    $coordenador = $Coordenador->verificarLoginCoordenador($_POST['nome'], $_POST['senha']);

    if ($coordenador) {
      // Define uma mensagem de sucesso para ser exibida na página
      $mensagem = 'Coordenador logado com sucesso!';
      session_start();
      $_SESSION['online'] = true;
      $_SESSION['idCoordenador'] = $coordenador['idCoordenador'];
      $_SESSION['nome'] = $coordenador['nome'];
      header('Location: ../HomeCoordenador.php?message='. json_encode($mensagem));
  
 
    } else {
      // Define uma mensagem de erro para ser exibida na página
      $mensagem = 'Ocorreu um erro ao fazer login.';
      header('Location: ../index.php?message='. json_encode($mensagem));
    }

    break;
  default:
    throw new Exception('deu ruim');
    break;
}





