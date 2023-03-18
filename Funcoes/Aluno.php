<?php
require_once('../libs/conexao.php');

// Função para cadastrar um novo aluno
function cadastrarAluno($nome, $ra, $idCurso, $senha)
{
    global $pdo;
    // Encripta a senha com bcrypt
    $senhaCriptografada = password_hash($senha, PASSWORD_BCRYPT);

    // Prepara o SQL para inserir o novo aluno
    $sql = "INSERT INTO alunos (nome, ra, idCurso, senha) VALUES (:nome, :ra, :idCurso, :senha)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':ra', $ra, PDO::PARAM_STR);
    $stmt->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);
    $stmt->bindParam(':senha', $senhaCriptografada, PDO::PARAM_STR);
    // Executa a query passando os parâmetros
    $stmt->execute();


    // Retorna o ID do novo aluno inserido
    return $pdo->lastInsertId();
}

function verificarAlunoExistente($ra)
{
    global $pdo;
    // Seleciona o aluno pelo RA
    $sql = "SELECT * FROM alunos WHERE ra = :ra";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':ra', $ra, PDO::PARAM_STR);
    $stmt->execute();
    $aluno = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se o aluno foi encontrado
    if ($aluno) {
        return true;
    } else {
        return false;
    }
}

// Função para verificar se o login é válido
function verificarLoginAluno($ra, $senha)
{
    global $pdo;
    // Busca o aluno pelo RA
    $stmt = $pdo->prepare("SELECT * FROM alunos WHERE ra = ?");
    $stmt->execute([$ra]);
    $aluno = $stmt->fetch();
    // Verifica se o RA existe e se a senha está correta
    if ($aluno && password_verify($senha, $aluno['senha'])) {
        return $aluno;
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


// Função para atualizar o curso do aluno
function atualizarCursoAluno($idAluno, $idCurso)
{
    global $pdo;
    // Prepara o SQL para atualizar o curso do aluno
    $sql = "UPDATE alunos SET idCurso = :idCurso WHERE idAluno = :idAluno";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':idCurso', $idCurso);
    $stmt->bindParam(':idAluno', $idAluno);
    // Executa a query passando os parâmetros
    $stmt->execute();

    // Retorna verdadeiro se a atualização foi bem sucedida
    return $stmt->rowCount() > 0;
}


