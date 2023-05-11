<?php

if (isset($_GET['erro']) && $_GET['erro'] == "url") {
    echo "<marquee> Você é um bobão sai daqui </marquee>";
    die();
}

if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['ra'])) {
    header('Location: /HomeAluno.php');
}

if (isset($_SESSION['idCoordenador'])) {
    header('Location: /HomeCoordenador.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/app.css">
    <title>Eventos Einstein Limeira</title>
</head>

<body>
    <div class="position-absolute top-0 start-0 nav navIndex">
        <button id="coordenador-btn">Coordenador</button>
        <button id="aluno-btn">Aluno</button>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 mt-5">

                <form action="./Controllers/controllerAluno.php" method="POST" autocomplete="off" id="aluno-form"> <!--  action  -->

                    <fieldset>
                        <legend class="text-center">Login Aluno</legend>

                        <div class="form-group">
                            <label for="ra" class="form-label">RA:</label>
                            <input type="text" name="ra" id="ra" required class="form-control" placeholder="000000" maxlength="7" onkeypress="validarNumeros(event)">
                        </div>

                        <div class="form-group">
                            <label for="senha" class="form-label">Senha:</label>
                            <input type="password" name="senha" id="senha" required class="form-control" placeholder="******">
                        </div>

                        <input type="hidden" name="LoginouRegister" value="Login">

                        <input type="submit" value="Login" class="btn btn-outline-warning">

                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 mt-5">

                <form action="./Controllers/controllerCoordenador.php" method="POST" autocomplete="off" id="coordenador-form"> <!--  action  -->

                    <fieldset>
                        <legend class="text-center">Login Coordenador</legend>

                        <div class="form-group">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" name="nome" id="nome" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="senha" class="form-label">Senha:</label>
                            <input type="password" name="senha" id="senhaC" required class="form-control" placeholder="******">
                        </div>

                        <input type="hidden" name="LoginouRegister" value="Login">

                        <input type="submit" value="Login" class="btn btn-outline-warning">


                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <?php include_once('./Views/MensagemGET.php') ?>

    <div class="row-gap-4 p-4">
        <a class="btn btn-secondary btn-sm" href="CadastroAluno.php">Novo Aluno</a>
        <a class="btn btn-secondary btn-sm" href="CadastroCoord.php">Novo Coordenador</a>

    </div>
    <a href="../libs/logout.php"><button class="btn btn-outline-danger">Sair da conta</button></a>
    </div>
    <script src="./assets/validacoesaluno.js"></script>
    <script src="./assets/bootstrap.bundle.min.js"></script>
    <script src="./assets/funcoes.js"></script>
</body>

</html>

<?php
