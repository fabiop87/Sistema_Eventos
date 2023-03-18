<?php
require_once('../libs/conexao.php');

// Função para cadastrar um novo coordenador
function cadastrarCoordenador($nome, $idCurso, $senha)
{
    global $pdo;
    // Encripta a senha com bcrypt
    $senhaCriptografada = password_hash($senha, PASSWORD_BCRYPT);

    // Prepara o SQL para inserir o novo coordenador
    $sql = "INSERT INTO coordenadores (nome, idCurso, senha) VALUES (:nome, :idCurso, :senha)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);
    $stmt->bindParam(':senha', $senhaCriptografada, PDO::PARAM_STR);
    // Executa a query passando os parâmetros
    $stmt->execute();


    // Retorna o ID do novo coordenador inserido
    return $pdo->lastInsertId();
}

function verificarCoordenadorExistente($nome)
{
    global $pdo;
    // Seleciona o coordenador pelo nome
    $sql = "SELECT * FROM coordenadores WHERE nome = :nome";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->execute();
    $coordenador = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o coordenador foi encontrado
    if ($coordenador) {
        return true;
    } else {
        return false;
    }
}

// Função para verificar se o login é válido
function verificarLoginCoordenador($nome, $senha)
{
    global $pdo;
    // Busca o coordenador pelo nome

    $sql = "SELECT * FROM coordenadores WHERE nome = :nome";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->execute();
    // Verifica se o RA existe e se a senha está correta
    if ($nome && password_verify($senha, $nome['senha'])) {
        return $nome;
        /*        session_start();
        $_SESSION['online'] = true;
        $_SESSION['id'] = $user['id'];
 */
    } else {
        return false;
    }
}

// Função para buscar todos os eventos
function buscarEvento()
{
    global $pdo;
    // Prepara o SQL para buscar todos os eventos
    $sql = "SELECT * FROM eventos";
    $stmt = $pdo->prepare($sql);

    // Executa a query
    $stmt->execute();

    // Retorna um array com todos os eventos
    return $stmt->fetchAll();
}



function atualizarCursoCoordenador($idCoordenador, $idCurso)
{
    global $pdo;

    $sql = "UPDATE coordenadores SET idCurso = :idCurso WHERE idCoordenador = :idCoordenador";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idCurso', $idCurso);
    $stmt->bindParam(':idCoordenador', $idCoordenador);
    // Executa a query passando os parâmetros
    $stmt->execute();

    // Retorna verdadeiro se a atualização foi bem sucedida
    return $stmt->rowCount() > 0;
}


