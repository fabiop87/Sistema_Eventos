<?php

if(isset($_POST['tiporeq'])){
  header('Location:/?erro=url');
  return false;
}

require('../Funcoes/Aluno.php');

var_dump($_POST);
//die();
$tiporeq = $_POST['LoginouRegister'];
// Os tipos podem ser Login ou Registrar

$nome = $_POST['nome'];
$ra = $_POST['ra'];
$idCurso = $_POST['idCurso'];
$senha = $_POST['senha'];
$confirm_senha = $_POST['confirm_senha'];


switch ($tiporeq) {
  case 'Register':
    // Confirmar se as senhas batem
    if ($senha != $confirm_senha) {
      echo 'As senhas devem coincidir';
      die('tem que confirmar a senha...');
    }
    var_dump($_POST);

    if (!verificarAlunoExistente($ra)) {
      $Aluno = cadastrarAluno($nome, $ra, $idCurso, $senha);
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


    break;
  case 'Login':

    $Aluno = verificarLoginAluno($ra, $senha);

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
    break;
  default:
    throw new Exception('deu ruim');
    break;
}

header('Location: ../HomeAluno.php');
