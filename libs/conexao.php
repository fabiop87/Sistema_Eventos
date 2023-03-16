<?php
$host = 'localhost';
$bd = 'eventosfaculdade';
$user = 'fabio';
$pass = 'sapato';

try{
$pdo = new PDO("mysql:host=$host;dbname=$bd", $user, $pass);

 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Não foi possível conectar." . $e->getMessage());
}