<?php

session_start();

if (!isset($_SESSION["online"]) || $_SESSION["online"] !== true) {
    header("location: /login.php");
    die('ué');
}

if (isset($_SESSION['ra'])) {
    $tipo_usuario = 'aluno';
}

if (isset($_SESSION['idCoordenador'])) {
    $tipo_usuario = 'coordenador';
}

require_once('./Funcoes/Model.php');

$conn = new conexao();

$novaSenha = $confirmaSenha = $senhaAntiga = "";
$novaSenha_err = $confirmaSenha_err = $senhaAntiga_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validar senha antiga
    if (empty(trim($_POST["senhaAntiga"]))) {
        $senhaAntiga_err = "Por favor, insira a senha antiga.";
    } else {
        $senhaAntiga = trim($_POST["senhaAntiga"]);
    }

    // Validar nova senha
    if (empty(trim($_POST["novaSenha"]))) {
        $novaSenha_err = "Por favor, insira a nova senha.";
    } elseif (strlen(trim($_POST["novaSenha"])) < 6) {
        $novaSenha_err = "A senha deve ter pelo menos 6 caracteres.";
    } else {
        $novaSenha = trim($_POST["novaSenha"]);
    }

    // Validar e confirmar a senha
    if (empty(trim($_POST["confirmaSenha"]))) {
        $confirmaSenha_err = "Por favor, confirme a senha.";
    } else {
        $confirmaSenha = trim($_POST["confirmaSenha"]);
        if (empty($novaSenha_err) && ($novaSenha != $confirmaSenha)) {
            $confirmaSenha_err = "A senha não confere.";
        }
    }

    // Verificar os erros de entrada antes de atualizar o banco de dados
    if (empty($senhaAntiga_err) && empty($novaSenha_err) && empty($confirmaSenha_err)) {
        // Verificar a senha antiga

        if ($tipo_usuario == 'aluno') {
            $id = $_SESSION['ra'];
            $sql_verificacao = "SELECT senha FROM alunos WHERE ra = :id";
            $sql_atualizacao = "UPDATE alunos SET senha = :senha WHERE ra = :id";
        } elseif ($tipo_usuario == 'coordenador') {
            $id = $_SESSION['idCoordenador'];
            $sql_verificacao = "SELECT senha FROM coordenadores WHERE idCoordenador = :id";
            $sql_atualizacao = "UPDATE coordenadores SET senha = :senha WHERE idCoordenador = :id";
        } else {
            die('ué');
        }

        $stmt_verificacao = $conn->getPDO()->prepare($sql_verificacao);
        $stmt_verificacao->bindParam(':id', $id);
        $stmt_verificacao->execute();
        $row = $stmt_verificacao->fetch(PDO::FETCH_ASSOC);

        if ($stmt_verificacao->rowCount() == 1) {
            $senhaArmazenada = $row['senha'];
            if (password_verify($senhaAntiga, $senhaArmazenada)) {
                // A senha antiga está correta, continuar com a atualização

                $senhaCriptografada = password_hash($novaSenha, PASSWORD_BCRYPT);

                $stmt_atualizacao = $conn->getPDO()->prepare($sql_atualizacao);
                $stmt_atualizacao->bindParam(':id', $id);
                $stmt_atualizacao->bindParam(':senha', $senhaCriptografada);

                // Executar a query passando os parâmetros
                if ($stmt_atualizacao->execute()) {
                    // Senha atualizada com sucesso. Destruir a sessão e redirecionar para a página de login
                    session_destroy();
                    $mensagem = 'Senha alterada com sucesso, faça login novamente';
                    header('Location: index.php?message=' . $mensagem);
                    exit();
                } else {
                    echo "Erro ao atualizar a senha.";
                }
            } else {
                $senhaAntiga_err = "A senha antiga está incorreta.";
            }
        } else {
            echo "Erro ao buscar a senha antiga.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./assets/bootstrap.min.css">
</head>

<body>

    <h2>Redefinir senha</h2>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 mt-5">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" autocomplete="off">
                    <fieldset>
                        <div class="form-group">
                            <label for="senhaAntiga" class="form-label">Senha antiga:</label>
                            <input type="password" name="senhaAntiga" id="senhaAntiga" required class="form-control" placeholder="******">
                            <?php echo (!empty($senhaAntiga_err)) ? '<span class="text-danger">' . $senhaAntiga_err . '</span>' : ''; ?>
                        </div>
                        <div class="form-group">
                            <label for="novaSenha" class="form-label">Nova senha:</label>
                            <input type="password" name="novaSenha" id="novaSenha" required class="form-control" placeholder="******">
                            <?php echo (!empty($novaSenha_err)) ? '<span class="text-danger">' . $novaSenha_err . '</span>' : ''; ?>
                        </div>
                        <div class="form-group">
                            <label for="confirmaSenha" class="form-label">Confirme a nova senha:</label>
                            <input type="password" name="confirmaSenha" id="confirmaSenha" required class="form-control" placeholder="******">
                            <?php echo (!empty($confirmaSenha_err)) ? '<span class="text-danger">' . $confirmaSenha_err . '</span>' : ''; ?>
                        </div>
                        <input type="submit" value="Enviar" class="btn btn-primary">
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</body>

</html>