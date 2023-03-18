<?php

session_start();
require_once('../libs/conexao.php');
require_once('../libs/DadosAlunoouCoord.php');



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Inscricao Eventos</h1>

    <?php require_once('ListarEventos.php');
    
    
    ?>
<a href="../libs/logout.php" class="btn btn-danger ml-3">Sair da conta</a>



</body>
</html>