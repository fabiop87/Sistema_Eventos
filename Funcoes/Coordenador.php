<?php
require('Model.php');

class Coordenador extends conexao
{

    // Função para cadastrar um novo coordenador
    public function cadastrarCoordenador($nome, $idCurso, $senha): bool
    {
        // Encripta a senha com bcrypt
        $senhaCriptografada = password_hash($senha, PASSWORD_BCRYPT);

        // Prepara o SQL para inserir o novo coordenador
        $sql = "INSERT INTO coordenadores (nome, idCurso, senha) VALUES (:nome, :idCurso, :senha)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->bindParam(':idCurso', $idCurso, PDO::PARAM_INT);
        $stmt->bindParam(':senha', $senhaCriptografada, PDO::PARAM_STR);
        // Executa a query passando os parâmetros
        return $stmt->execute();
    }

    // Função para buscar os dados do coordenador
    public function getCoordenador()
    {
        
        $sql = "SELECT * FROM coordenadores WHERE idCoordenador = :idCoordenador";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idCoordenador', $_SESSION['idCoordenador'], PDO::PARAM_STR);
        // Executa a query
        $stmt->execute();

        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function verificarCoordenadorExistente($nome): bool
    {
        // Seleciona o coordenador pelo nome
        $sql = "SELECT * FROM coordenadores WHERE nome = :nome";
        $stmt = $this->pdo->prepare($sql);
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
    public function verificarLoginCoordenador($nome, $senha)
    {
        // Busca o coordenador pelo nome

        $stmt = $this->pdo->prepare("SELECT * FROM coordenadores WHERE nome = :nome");
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
        $stmt->execute();
        $nome = $stmt->fetch();
        // Verifica se o nome existe e se a senha está correta
        if ($nome && password_verify($senha, $nome['senha'])) {
            return $nome;
        } else {
            return false;
        }
    }


    // Função para excluir um coordenador pelo ID
    public function excluirCoordenador($idCoordenador): bool
    {
        // Prepara o SQL para excluir o coordenador pelo ID
        $sql = "DELETE FROM coordenadores WHERE idCoordenador = :idCoordenador";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':idCoordenador', $idCoordenador, PDO::PARAM_INT);
        // Executa a query passando os parâmetros
        return $stmt->execute();
    }

    public function atualizarCursoCoordenador($idCoordenador, $idCurso): bool
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
}
