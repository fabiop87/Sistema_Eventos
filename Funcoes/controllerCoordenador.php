<?php

require('./Coordenador.php');

var_dump($_POST);
//die();
$tiporeq = $_POST['LoginouRegister'];
// Os tipos podem ser Login ou Registrar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $tiporeq == 'Register') {


  // Confirmar se as senhas batem
  if ($_POST['senha'] != $_POST['confirm_senha']) {
    echo 'As senhas devem coincidir';
  }
  var_dump($_POST);

  if (!verificarCoordenadorExistente($_POST['nome'])) {
    $Coordenador = cadastrarCoordenador($_POST['nome'], $_POST['idCurso'], $_POST['senha']);
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
  // Redireciona o usuário para a página desejada
  //header('Location: ../index.php');
}



if ($_SERVER['REQUEST_METHOD'] == 'POST' && $tiporeq == 'Login') {
  $Coordenador = verificarLoginCoordenador($_POST['nome'], $_POST['senha']);

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
  // Redireciona o usuário para a página desejada
}
header('Location: ../Views/InscricaoEventos.php');
