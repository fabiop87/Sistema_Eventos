<?php
echo '<pre>';
session_start();
var_dump($_SESSION);

print_r($_POST);


if (!isset($_SESSION) || !$_SESSION['online']) {
    die('nao tem permissao pra entrar aqui');
}

$idAluno = $_SESSION['idAluno'];



require_once('./Funcoes/Presenca.php');
// require_once('../Funcoes/Aluno.php');
$Presenca = new Presenca();

$sql = "SELECT a.nome, c.nomeCurso, a.ra FROM alunos a INNER JOIN cursos c WHERE a.idAluno = $idAluno AND c.idCurso = a.idCurso ";
$resultado = $Presenca->pdo->query($sql);
$dadosAluno = $resultado->fetch(PDO::FETCH_ASSOC);

print_r($dadosAluno);

$nome = $dadosAluno['nome'];
$curso = $dadosAluno['nomeCurso'];
$ra = $dadosAluno['ra'];
$nomeEvento = $_POST['nomeEvento'];
$local = $_POST['local'];
$horarioInicio = $_POST['horarioInicio'];
$horarioTermino = $_POST['horarioTermino'];



//fazer o pdf

use Dompdf\Dompdf;
use Dompdf\Options;

require __DIR__ . '/PDF/vendor/autoload.php';

$options = new Options();
$options->setChroot(__DIR__);

$pdf = new Dompdf($options);
//$options->setIsRemoteEnabled(true);

$pdf->setPaper('A4', 'landscape');


// $html = file_get_contents(__DIR__.'/arquivo.php');

//Carrega o arquivo html
// $pdf->loadHtmlFile(__DIR__.'/arquivo.php');

$certificado = "
    <style>
    p {
        text-align: justify;
        line-height: 1.5em;
        font-size: 18pt;
    }
    #center {
        display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
    justify-content: center;
    align-items: center;
      }
      
    h1, h2, h3, h4 {
        color: #372991;
        margin: 0 0 10px 0;
        text-align:center;
    }
    
    </style>

    <h1>EINSTEIN LIMEIRA</h1>
<div id='center'>
<img src='./PDF/img/logo.png' alt=''>
</div>

    <p>O aluno $nome ra: $ra do curso $curso tem presença confirmada no evento $nomeEvento no $local</p>

    <p>Data: $dataEvento   Horario de inicio: $horarioInicio       Horario de término: $horarioTermino</p>
    <p>'?assinatura da pessoa que precisa assinar?'</p>

";

// $pdf->loadHtml($html);

$pdf->loadHtml($certificado);
//Renderizar o pdf
$pdf->render();


//Imprime o pdf na tela
header('Content-type: application/pdf');
echo $pdf->output();
