<?php
session_start();
var_dump($_SESSION);

if (!isset($_SESSION) || !$_SESSION['online']) {
    die('nao tem permissao pra entrar aqui');
}

$idAluno = $_SESSION['idAluno'];

echo '<pre>';
// var_dump($_SESSION);

var_dump($_POST);

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
echo $_POST['local'];
echo $nome;


// fazer o pdf

