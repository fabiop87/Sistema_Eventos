<?php

if(isset($_GET['erro']) && $_GET['erro'] == "url") {
    echo "<marquee> Você é um bobão sai daqui </marquee>";
    die();
}

if (!isset($_SESSION)) {
    session_start();
  }


var_dump($_SESSION);

if(isset($_SESSION['idAluno'])){
    header('Location: ./HomeAluno.php');
}elseif(isset($_SESSION['idCoordenador'])){
    header('Location: ./HomeCoordenador.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/bootstrap.min.css">
    <title>Document</title>
</head>

<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 mt-5">

                <form action="./Controllers/controllerAluno.php" method="POST" autocomplete="off"> <!--  action  -->

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

                        <input type="submit" value="Login" class="btn btn-primary">


                    </fieldset>
                </form>
            </div>
        </div>
    </div>

    <!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 mt-5">

                <form action="./Controllers/controllerCoordenador.php" method="POST" autocomplete="off"> <!--  action  -->

                    <fieldset>
                        <legend class="text-center">Login Coordenador</legend>

                        <div class="form-group">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" name="nome" id="nome" required class="form-control">
                        </div>


                        <div class="form-group">
                            <label for="senha" class="form-label">Senha:</label>
                            <input type="password" name="senha" id="senha" required class="form-control" placeholder="******">
                        </div>

                        <input type="hidden" name="LoginouRegister" value="Login">

                        <input type="submit" value="Login" class="btn btn-primary">


                    </fieldset>
                </form>
            </div>
        </div>
    </div>


    <a href="Cadastro.php">Novo Usuário</a>

    <script src="./assets/validacoes.js"></script>
    <script src="./assets/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
var_dump($_POST);
