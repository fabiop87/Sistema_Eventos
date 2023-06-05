<?php


if (!isset($_POST['tiporeq_presenca'])) {
    header('Location: ../?erro=url');
    return false;
}

require_once('../Funcoes/Presenca.php');

$Presenca = new Presenca();



switch ($_POST['tiporeq_presenca']) {
    case 'Inscrever':
        if(!$Presenca->verificarInscricao($_POST['idEvento'], $_POST['ra'])){
            $Presenca->inscrever($_POST['idEvento'], $_POST['ra']);
            $mensagem = 'Inscricao realizada!';  
        } else {
            $mensagem = 'Deu algum erro para realizar a inscricao';
        }
        break;
        case 'Confirmar':
        if($Presenca->validarCertificado($_POST['idEvento'], $_POST['ra'])){
                $mensagem = "você ja tem acesso ao certificado";
        }
        if($Presenca->verificarInscricao($_POST['idEvento'], $_POST['ra'])){
            $Presenca->confirmarPresenca($_POST['idEvento'], $_POST['ra'], $_POST['codigoAluno']);
            $mensagem = 'Código Enviado';
        }
        break;
    case 'Certificado':
        if($Presenca->validarCertificado($_POST['idEvento'], $_POST['ra'])){
            $mensagem = 'Certificado Validado';
        }
        break;
    case 'Desinscrever':
        $Presenca->desinscrever($_POST['idEvento'], $_POST['ra']);
        $mensagem = "Inscricao retirada";
        break;
    default:
    $mensagem = 'Deu algum erro na hora de salvar';
        break;
}

header('Location: ../HomeAluno.php?message='. json_encode($mensagem));