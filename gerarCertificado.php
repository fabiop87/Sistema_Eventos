<?php

session_start();



if (!isset($_SESSION) && !$_SESSION['ra']) {
    die('nao tem permissao pra entrar aqui');
}

$ra = $_SESSION['ra'];


require_once('./Funcoes/Model.php');
// require_once('../Funcoes/Aluno.php');
$Presenca = new conexao();

$sql = "SELECT a.nome, c.nomeCurso
FROM alunos a 
INNER JOIN cursos c ON c.idCurso = a.idCurso
WHERE a.ra = :ra

";
$stmt = $Presenca->getPDO()->prepare($sql);
$stmt->bindParam(':ra', $ra, PDO::PARAM_STR);
$stmt->execute();
$dadosAluno = $stmt->fetch(PDO::FETCH_ASSOC);




$nome = $dadosAluno['nome'];
$curso = $dadosAluno['nomeCurso'];
// $ra = $dadosAluno['ra'];
$nomeEvento = $_POST['nomeEvento'];
$dataEvento = date('d/m/Y', strtotime($_POST['dataEvento']));
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
<title>Certificado {$nomeEvento}</title>
    <style>
    body{background-color: lightgray}
        p {
            text-align: center;
            line-height: 1.5em;
            font-size: 18pt;
        }
        .center {  text-align:center  }
          
        h1, h2, h3, h4 {
            color: #372991;
            margin: 0 0 10px 0;
            text-align:center;
        }
        
        </style>
</head>
<body>
    <h1>EINSTEIN LIMEIRA</h1>
    <div class='center'>
    <img src='./PDF/img/logo.png' alt=''>
    </div>
    
    <p>O aluno <strong>{$nome}</strong> ra: <strong>{$ra}</strong> do curso <strong>{$curso}</strong> tem presença confirmada no evento <strong>{$nomeEvento}</strong> no {$local}</p>
    
    <p>Data: {$dataEvento}   Horário de início: {$horarioInicio}       Horário de término: {$horarioTermino}</p>

";

// $pdf->loadHtml($html);

$pdf->loadHtml($certificado);
//Renderizar o pdf


 $pdf->render();

// Configura o cabeçalho Content-Type para indicar que é um PDF
 header('Content-Type: application/pdf');
 header('Content-Disposition: inline; filename="certificado.pdf"');
// Imprime o pdf na tela
//echo $pdf->output();

//  Baixa o PDF com o nome "Certificado '$nomeEvento' - '$nome'"
$pdf->stream("Certificado '{$nomeEvento}' - '{$nome}'", array("Attachment" => 0));



