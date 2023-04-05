<?php
session_start();
echo '<pre>';
var_dump($_POST);
var_dump($_SESSION);

if (!isset($_POST['tiporeq_presenca'])) {
    header('Location:/?erro=url');
    return false;
}

require_once('../Funcoes/Presenca.php');

$Presenca = new Presenca();



switch ($_POST['tiporeq_presenca']) {
    case 'Inscrever':
        if(!$Presenca->verificarInscricao($_POST['idEvento'], $_POST['idAluno'])){
            $Presenca->inscrever($_POST['idEvento'], $_POST['idAluno']);
        } else {
            $mensagem = 'ja-está-inscrito';  
        }
        break;
        case 'Confirmar':
        if($Presenca->validarCertificado($_POST['idEvento'], $_POST['idAluno'])){
                $mensagem = "você ja tem acesso ao certificado";
        }
        if($Presenca->verificarInscricao($_POST['idEvento'], $_POST['idAluno'])){
            $Presenca->confirmarPresenca($_POST['idEvento'], $_POST['idAluno'], $_POST['codigoAluno']);
            $mensagem = 'código-enviado';
        }
        break;
    case 'Certificado':
        if($Presenca->validarCertificado($_POST['idEvento'], $_POST['idAluno'])){
            echo 'validado';
        }
        break;
    case 'Desinscrever':
        $Presenca->desinscrever($_POST['idEvento'], $_POST['idAluno']);
        $mensagem = 'desinscrito';
        break;
    default:
        die('deu merda');
        break;
}

header('Location:/HomeAluno.php?message='. $mensagem);