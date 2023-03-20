<?php

// session_start();
// require_once('../libs/conexao.php');
// require_once('../libs/DadosAlunoouCoord.php');

// var_dump($_POST);

// ?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
</head>

<body>
    <h1>Inscricao Eventos</h1>




    <?php require_once('ListarEventos.php');
        //fazer um botao na lista dos eventos com o nome INSCREVER que pega os dados do aluno e faz os bagulho (insert)

        //depois ver como fazer o update pra fazer a presença

    ?>


    <?php var_dump($_SESSION) ?>

    <script src="../assets/bootstrap.bundle.min.js"></script>
</body>

</html>