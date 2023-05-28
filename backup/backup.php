<?php

/*
* Created by @Fabio Pilon  ( foi um inferno de fazer )
* ó, isso aqui escreve o script para criar as tabelas denovo, já que o mysql_dump estava dando problema
* Pra fazer o backup é só rodar esse código com o comando no terminal ->  { php backup.php } <- este arquivo (dã)
* Pra ter certeza dá cd \backup e chega na pasta que tem o arquivo e usa o comando
* Se ainda não conseguir ainda só faz manualmente no mysql lá (opções né)
*/


// Configurações do banco de dados
$host = 'localhost';
$user = 'Josney';
$pass = 'sapatosalsicha';
$dbname = 'eventosfaculdade';

// Conecta ao banco de dados
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Erro ao conectar ao banco de dados: ' . $e->getMessage());
}

// Nome do arquivo de backup
$backupFile = './Pasta_de_Backups/backup_eventosfaculdade' . date('Y-m-d') . '.sql';

// Obtém todas as tabelas do banco de dados
$tables = array();
$query = $conn->query("SHOW TABLES");
$tables = $query->fetchAll(PDO::FETCH_COLUMN);

// Cria o arquivo de backup
$handle = fopen($backupFile, 'w');

// Itera sobre as tabelas e escreve os dados no arquivo
foreach ($tables as $table) {
    // Escreve o comando para criar a tabela no arquivo
    $query = $conn->query("SHOW CREATE TABLE $table");
    $tableInfo = $query->fetch(PDO::FETCH_ASSOC);
    fwrite($handle, $tableInfo['Create Table'] . ";\n");

    // Escreve os dados da tabela no arquivo
    $query = $conn->query("SELECT * FROM $table");
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $rowValues = implode(', ', array_map(function ($value) use ($conn) {
            return $conn->quote($value);
        }, $row));
        fwrite($handle, "INSERT INTO $table VALUES ($rowValues);\n");
    }
}

// Fecha o arquivo
fclose($handle);

// Fecha a conexão com o banco de dados
$conn = null;

echo 'Backup criado com sucesso!';
?>