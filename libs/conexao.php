<?php
$host = "localhost";
$dbname = '';
$username = '';
$password = '';

try {
  $conexao = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
  $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "Erro de conexão: " . $e->getMessage();
}

