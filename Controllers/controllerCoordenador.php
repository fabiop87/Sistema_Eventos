<?php

require('../Funcoes/Coordenador.php');

var_dump($_POST);
//die();
$tiporeq = $_POST['LoginouRegister'];
// Os tipos podem ser Login ou Registrar


$nome = $_POST['nome'];
$idCurso = $_POST['idCurso'];
$senha = $_POST['senha'];
$confirm_senha = $_POST['confirm_senha'];


switch ($tiporeq) {
  case 'Register':

    // Confirmar se as senhas batem
    if ($senha != $confirm_senha) {
      echo 'As senhas devem coincidir';
    }


    if (!verificarCoordenadorExistente($nome)) {
      $Coordenador = cadastrarCoordenador($nome, $idCurso, $senha);
    } else {
      echo 'Este coordenador já está cadastrado';
    }

    // Verifica se o cadastro foi bem sucedido
    if ($Coordenador) {
      // Define uma mensagem de sucesso para ser exibida na página
      $mensagem = 'Coordenador cadastrado com sucesso!';
    } else {
      // Define uma mensagem de erro para ser exibida na página
      $mensagem = 'Ocorreu um erro ao cadastrar o coordenador.';
    }
    echo $mensagem;

    break;
  case 'login':

    $Coordenador = verificarLoginCoordenador($nome, $senha);

    if ($Coordenador) {
      // Define uma mensagem de sucesso para ser exibida na página
      $mensagem = 'Coordenador logado com sucesso!';
      session_start();
      $_SESSION['online'] = true;
      $_SESSION['idCoordenador'] = $Coordenador['idCoordenador'];
      var_dump($_SESSION);
      ///  TA ERRADO ISSO AQUI
    } else {
      // Define uma mensagem de erro para ser exibida na página
      $mensagem = 'Ocorreu um erro ao fazer login.';
    }
    echo $mensagem;
    break;
  default:
    throw new Exception('deu ruim');
    break;
}




header('Location: ../HomeCoordenador.php');
