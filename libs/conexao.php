<?php
// $host = "localhost";
// $dbname = 'eventosfaculdade';
// $username = 'fabio';
// $password = 'sapato';
$dsn = "mysql:host=" . $_ENV['db']['host'] . ";dbname=" . $_ENV['db']['database'];
try{
$pdo = new PDO($dsn, $_ENV['db']['user'], $_ENV['db']['pass']);

 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Não foi possível conectar." . $e->getMessage());
}