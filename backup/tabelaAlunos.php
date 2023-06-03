<?php

/*
* Created by @Fabio Pilon  
*    Arquivo que cria as senhas no formato correto a partir de uma tabela/view em que há RA, nome e id do curso dos alunos
*    Como o professor disse que a tabela de alunos viria pronta mas por motivos de ansiedade fiquei pensando se a criptografia da senha viria no formato certo, fiz esse script para pegar e fazer a senha no formato usado no sistema (BCRYPT)
* Se for necessário usar, está funcionando, vai criar um arquivo SQL com os inserts  

--> Para rodar o script aqui mesmo:  cd backup -> php tabelaAlunos.php
*/

// Função para gerar o valor criptografado para a senha
function criptografarSenha($senha)
{
    return password_hash($senha, PASSWORD_BCRYPT);
}

// Configurações de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projintteste";

try {
    // Criar conexão com o banco de dados usando o PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Configurar o modo de erro do PDO para exceções
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta SQL para buscar os alunos
    $sql = "SELECT ra, nome, idCurso FROM alunos";
    $stmt = $conn->query($sql);

    // Nome do arquivo .sql que será gerado
    $nomeArquivo = './Pasta_de_Table_Alunos/alunos_inserts.sql';

    // Abre o arquivo para escrita
    $arquivo = fopen($nomeArquivo, 'w');

    // Verifica se a consulta retornou resultados
    if ($stmt->rowCount() > 0) {
        // Gera os inserts para cada aluno
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // Criptografa a senha (utilizando o próprio RA como senha)
            $senhaCriptografada = criptografarSenha($row["ra"]);
            // Cria o insert
            $insert = "INSERT INTO alunos VALUES ('{$row["ra"]}', '{$row["nome"]}', {$row["idCurso"]}, '$senhaCriptografada', current_timestamp());\n";
            // Escreve o insert no arquivo
            fwrite($arquivo, $insert);
        }
    } else {
        echo "Nenhum aluno encontrado na tabela.";
    }

    // Fecha o arquivo
    fclose($arquivo);

    echo "Arquivo $nomeArquivo gerado com sucesso.";

} catch (PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
}

// Fecha a conexão com o banco de dados
$conn = null;

?>
