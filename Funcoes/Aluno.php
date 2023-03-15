<?php


    // Função para cadastrar um novo aluno
function cadastrarAluno($nome, $ra, $idCurso, $senha) {
    global $pdo;
    
    // Encripta a senha com bcrypt
    $senhaCriptografada = password_hash($senha, PASSWORD_BCRYPT);

    // Prepara o SQL para inserir o novo aluno
    $sql = "INSERT INTO alunos (nome, ra, idCurso, senha) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);

    // Executa a query passando os parâmetros
    $stmt->execute([$nome, $ra, $idCurso, $senhaCriptografada]);

    // Retorna o ID do novo aluno inserido
    return $pdo->lastInsertId();
}

// Função para verificar se o login é válido
function verificarLogin($ra, $senha) {
    global $pdo;

    // Busca o aluno pelo RA
    $stmt = $pdo->prepare("SELECT * FROM alunos WHERE ra = ?");
    $stmt->execute([$ra]);
    $aluno = $stmt->fetch();

    // Verifica se o RA existe e se a senha está correta
    if ($aluno && password_verify($senha, $aluno['senha'])) {
        return $aluno;
    } else {
        return false;
    }
}


    

    
