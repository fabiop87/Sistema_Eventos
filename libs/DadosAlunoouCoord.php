<?php
require_once('conexao.php');
// global $pdo;

if (!isset($_SESSION) && !$_SESSION['online']) {
    die('nao era pra acontecer isso....');
}elseif(isset($_SESSION['idAluno'])){
    $idAluno = $_SESSION['idAluno'];
    $sqlAluno = "SELECT * FROM alunos WHERE idAluno = '$idAluno'";
    $resultado = $pdo->query($sqlAluno);
    $dadosAluno = $resultado->fetchAll(PDO::FETCH_ASSOC);
}elseif(isset($_SESSION['idCoordenador'])){
    $idCoordenador = $_SESSION['idCoordenador'];
    $sqlCoordenador = "SELECT * FROM coordenadores WHERE idCoordenador = '$idCoordenador'";
    
    $resultado = $pdo->query($sqlCoordenador);
    $dadosCoordenador = $resultado->fetchAll(PDO::FETCH_ASSOC);
}
echo '<pre>';
if(isset($dadosAluno)){
    var_dump($dadosAluno);
}

if(isset($dadosCoordenador)){
    var_dump($dadosCoordenador);
}
echo '<hr>';
var_dump($_SESSION);
echo 'awawawawawaa';
echo '<br>';

print_r($dadosAluno);

// Nao pode pegar a senha no select  **importante**

// É, confuso