<?php

if (isset($_POST['tiporeq'])) {
  header('Location:/?erro=url');
  return false;
}


require_once('../Funcoes/Aluno.php');
$Aluno = new Aluno();

$tiporeq = $_POST['LoginouRegister'];
// Os tipos podem ser Login ou Registrar



switch ($tiporeq) {
  case 'Register':
    // Confirmar se as senhas batem
    if ($_POST['senha'] != $_POST['confirm_senha']) {
      echo 'As senhas devem coincidir';
    }

    if (!$Aluno->verificarAlunoExistente($_POST['ra'])) {
      $novoAluno = $Aluno->cadastrarAluno($_POST['nome'], $_POST['ra'], $_POST['idCurso'], $_POST['senha']);
    } else {
      $mensagem = 'Este aluno já está cadastrado';
      header('Location:/index.php?message='. $mensagem);
    }
    // Verifica se o cadastro foi bem sucedido
    if ($novoAluno) {
      // Define uma mensagem de sucesso para ser exibida na página
      $mensagem = 'Aluno-cadastrado-com-sucesso!';
      header('Location:/index.php?message='. $mensagem);
    } else {
      // Define uma mensagem de erro para ser exibida na página
      $mensagem = 'Ocorreu-um-erro-ao-cadastrar-o-aluno.';
      header('Location:/CadastroAluno.php?message='. $mensagem);
    }
    echo $mensagem;


    break;
  case 'Login':

    $aluno = $Aluno->verificarLoginAluno($_POST['ra'], $_POST['senha']);

    if ($aluno) {
      // Define uma mensagem de sucesso para ser exibida na página
      $mensagem = 'Aluno-logado-com-sucesso!';
      session_start();
      $_SESSION['online'] = true;
      $_SESSION['ra'] = $aluno['ra'];
      $_SESSION['nome'] = $aluno['nome'];
      header('Location:/HomeAluno.php?message='. $mensagem);

    } else {
      // Define uma mensagem de erro para ser exibida na página
      $mensagem = 'Ocorreu-um-erro-ao-fazer-login.';
      header('Location:/index.php?message='. $mensagem);
    }
    echo $mensagem;
    // Redireciona o usuário para a página desejada
    break;
  default:
    throw new Exception('deu ruim');
    break;
}
