<?php

require('./Aluno.php');

var_dump($_POST);
//die();
$tiporeq = $_POST['LoginouRegister'];
// Os tipos podem ser Login ou Registrar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $tiporeq == 'Register') {


  // Confirmar se as senhas batem
  if ($_POST['senha'] != $_POST['confirm_senha']) {
    echo 'As senhas devem coincidir';
    die('aqui');
  }
  var_dump($_POST);

  if (!verificarAlunoExistente($_POST['ra'])) {
    $Aluno = cadastrarAluno($_POST['nome'], $_POST['ra'], $_POST['idCurso'], $_POST['senha']);
  } else {
    echo 'Este aluno já está cadastrado';
  }

  // Verifica se o cadastro foi bem sucedido
  if ($Aluno) {
    // Define uma mensagem de sucesso para ser exibida na página
    $mensagem = 'Aluno cadastrado com sucesso!';
  } else {
    // Define uma mensagem de erro para ser exibida na página
    $mensagem = 'Ocorreu um erro ao cadastrar o aluno.';
  }
  echo $mensagem;
  // Redireciona o usuário para a página desejada
  //header('Location: ../index.php');
}



if ($_SERVER['REQUEST_METHOD'] == 'POST' && $tiporeq == 'Login') {
  echo 'aqui';
  $Aluno = verificarLogin($_POST['ra'], $_POST['senha']);

  if ($Aluno) {
    // Define uma mensagem de sucesso para ser exibida na página
    $mensagem = 'Aluno logado com sucesso!';
    session_start();
    $_SESSION['online'] = true;
    $_SESSION['idAluno'] = $Aluno['idAluno'];
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
