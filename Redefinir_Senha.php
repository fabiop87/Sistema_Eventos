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

$novaSenha = $confirmaSenha = "";
$novaSenha_err = $confirmaSenha_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Validar nova senha
    if (empty(trim($_POST["novaSenha"]))) {
        $novaSenha_err = "Por favor insira a nova senha.";
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
    // Verifique os erros de entrada antes de atualizar o banco de dados
    if (empty($novaSenha_err) && empty($confirmaSenha_err)) {
        // Prepare uma declaração de atualização

        if ($tipo_usuario == 'aluno') {
            $id = $_SESSION['ra'];
            $sql = "UPDATE alunos SET senha = :senha WHERE ra = :id";
        } elseif ($tipo_usuario == 'coordenador') {
            $id = $_SESSION['idCoordenador'];
            $sql = "UPDATE coordenadores SET senha = :senha WHERE idCoordenador = :id";
        } else {
            die('ué');
        }

        $senhaCriptografada = password_hash($novaSenha, PASSWORD_BCRYPT);


        $stmt = $conn->pdo->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':senha', $senhaCriptografada);
        var_dump($stmt);
        // Executa a query passando os parâmetros
        if ($stmt->execute()) {
            // Senha atualizada com sucesso. Destrua a sessão e redirecione para a página de login
            session_destroy();
            header("location: index.php");
            exit();
        } else {
            echo "ae deu merda";
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

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" autocomplete="off"> <!--  action  -->

                    <fieldset>

                        <div class="form-group">
                            <label for="novaSenha" class="form-label">Senha:</label>
                            <input type="password" name="novaSenha" id="novaSenha" required class="form-control" placeholder="******">
                        </div>
                        <div class="form-group">
                            <label for="confirmaSenha" class="form-label">Confirme a nova senha:</label>
                            <input type="password" name="confirmaSenha" id="confirmaSenha" required class="form-control" placeholder="******">
                        </div>


                        <input type="submit" value="Enviar" class="btn btn-primary">


                    </fieldset>
                </form>
            </div>
        </div>
    </div>









    <script src="./assets/validacoesaluno.js"></script>
    <script src="./assets/validacoescoord.js"></script>
    <script src="../assets/bootstrap.bundle.min.js"></script>
</body>

</html>