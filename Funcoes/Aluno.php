<?php
require_once('Model.php');


class Aluno extends conexao
{
    // Função para cadastrar um novo aluno
    public function cadastrarAluno($nome, $ra, $idCurso, $senha): bool
    {

        // Encripta a senha com bcrypt
        $senhaCriptografada = password_hash($senha, PASSWORD_BCRYPT);

        // Prepara o SQL para inserir o novo aluno
        $sql = "INSERT INTO alunos (nome, ra, idCurso, senha) VALUES (:nome, :ra, :idCurso, :senha)";
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':ra', $ra, PDO::PARAM_STR);
        $stmt->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);
        $stmt->bindParam(':senha', $senhaCriptografada, PDO::PARAM_STR);
        // Executa a query passando os parâmetros
        return $stmt->execute();
    }

    // Função para buscar os dados do aluno
    public function getAluno()
    {

        $sql = "SELECT * FROM alunos WHERE ra = :ra";
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam(':ra', $_SESSION['ra'], PDO::PARAM_STR);
        // Executa a query
        $stmt->execute();


        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    public function verificarAlunoExistente($ra): bool
    {

        // Seleciona o aluno pelo RA
        $sql = "SELECT * FROM alunos WHERE ra = :ra";
        $stmt = $this->getPdo()->prepare($sql);
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
    public function verificarLoginAluno($ra, $senha)
    {
        // Busca o aluno pelo RA
        $sql = "SELECT * FROM alunos WHERE ra = :ra";
        $stmt = $this->getPDO()->prepare($sql);
        $stmt->bindParam(':ra', $ra, PDO::PARAM_STR);
        $stmt->execute();
        $aluno = $stmt->fetch();
        // Verifica se o RA existe e se a senha está correta
        if ($aluno && password_verify($senha, $aluno['senha'])) {
            return $aluno;
        } else {
            return false;
        }
    }

    public function excluirAluno($ra): bool
    {
        // Prepara o SQL para excluir o aluno pelo ID
        $sql = "DELETE FROM alunos WHERE ra = :ra";
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam(':ra', $ra, PDO::PARAM_INT);
        // Executa a query passando os parâmetros
        return $stmt->execute();
    }


    // Função para atualizar o curso do aluno
    public function atualizarCursoAluno($ra, $idCurso): bool
    {
        // Prepara o SQL para atualizar o curso do aluno
        $sql = "UPDATE alunos SET idCurso = :idCurso WHERE ra = :ra";
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->bindParam(':idCurso', $idCurso);
        $stmt->bindParam(':ra', $ra);
        // Executa a query passando os parâmetros
        $stmt->execute();

        // Retorna verdadeiro se a atualização foi bem sucedida
        return $stmt->rowCount() > 0;
    }
}
