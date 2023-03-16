<?php

session_start();
require_once('../libs/conexao.php');
global $pdo;

if (!isset($_SESSION) && !$_SESSION['online']) {
    die('nao era pra acontecer isso....');
}elseif(isset($_SESSION['idAluno'])){
    $idAluno = $_SESSION['idAluno'];
    $sqlAluno = "SELECT * FROM alunos WHERE idAluno = '$idAluno'";
    
    $resultado = $pdo->query($sqlAluno);
    $dadosCoordenador = $resultado->fetchAll(PDO::FETCH_ASSOC);
}elseif(isset($_SESSION['idCoordenador'])){
    $idCoordenador = $_SESSION['idCoordenador'];
    $sqlCoordenador = "SELECT * FROM coordenadores WHERE idCoordenador = '$idCoordenador'";
    
    $resultado = $pdo->query($sqlCoordenador);
    $dadosCoordenador = $resultado->fetchAll(PDO::FETCH_ASSOC);
}
 

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

    <?php require_once('ListarEventos.php'); ?>
</body>
</html>