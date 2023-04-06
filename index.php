<?php

use Dompdf\Dompdf;
use Dompdf\Options;

require __DIR__.'/vendor/autoload.php';

$options = new Options();
$options->setChroot(__DIR__);

$pdf = new Dompdf($options);
$options->setIsRemoteEnabled(true);

$pdf->setPaper('A4', 'landscape');

$html = file_get_contents(__DIR__.'/arquivo.php');

//Carrega o arquivo html
// $pdf->loadHtmlFile(__DIR__.'/arquivo.php');
$pdf->loadHtml($html);
//Renderizar o pdf
$pdf->render();



//Imprime o pdf na tela
header('Content-type: application/pdf');
echo $pdf->output();


