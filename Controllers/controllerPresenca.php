<?php
session_start();
echo '<pre>';
var_dump($_POST);
var_dump($_SESSION);

if (!isset($_POST['tiporeq_presenca'])) {
    header('Location:/?erro=url');
    return false;
}

require('../Funcoes/Presenca.php');

$Presenca = new Presenca();



switch ($_POST['tiporeq_presenca']) {
    case 'Inscrever':
        if(!$Presenca->verificarInscricao($_POST['idEvento'], $_POST['idAluno'])){
            $Presenca->inscrever($_POST['idEvento'], $_POST['idAluno']);
        } else {
            echo 'ja está inscrito' ;
        }
        break;
    case 'Confirmar':
        # code...
        break;
    case 'Certificado':
        # code...
        break;

    default:
        die('deu merda');
        break;
}
