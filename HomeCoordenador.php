<?php

date_default_timezone_set("America/Sao_Paulo");
$dataAtual = date('d/m/Y');

session_start();

if (!isset($_SESSION) || !isset($_SESSION['idCoordenador'])) {
    session_destroy();
    header('Location: ./index.php');
}

if (isset($_SESSION['idAluno'])) {
    die('calma lá que nao era pra acontecer isso');
}


require_once('./Funcoes/Coordenador.php');
$Coordenador = new Coordenador();

$nome = $_SESSION['nome'];


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/app.css">
    <link rel="shortcut icon" href="./assets/favicon.ico" type="image/x-icon">
    <title>Eventos Einstein Limeira</title>
</head>

<body>
    <img class="rounded mx-start d-block" src="/assets/vaiissomesmo2.png" alt="logoescola">

    <?php include_once('./Views/MensagemGET.php') ?>

    <h1 class="text-center">Página Inicial Coordenador</h1>

    <p> Olá, <?= $nome ?></p>

    <div class="d-flex flex-row-reverse mb-4">
        <div class="p-2">
            <a href="../libs/logout.php"><button class="btn btn-outline-danger">Sair da conta</button></a>
        </div>
        <div class="p-2">
            <a class="btn btn-outline-info" href="./Redefinir_Senha.php">Trocar senha</a>
        </div>
    </div>


    <nav class="nav justify-content-end">
        <a class="nav-link-active btn" aria-current="page" href="#">Página do Coordenador</a>
        <a class="nav-link" href="./Views/Coordenadores/CadastroEventos.php">Cadastrar novo evento</a>
        <form class="d-flex" role="search">
            <input name="search" value="<?php if (isset($_GET['search'])) echo $_GET['search']; ?>" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" autocomplete="on">
            <button class="btn btn-outline-success" type="submit">Buscar</button>
        </form>
    </nav>

    <hr>
    <?php
    include_once('./Views/Coordenadores/ListaEvt_Coord.php');
    ?>
    <hr>
    <?php
    include_once('./Views/Coordenadores/Eventos_passados.php');
    ?>


    <footer class="footer text-center fixed-bottom">Einstein Limeira <?= $dataAtual ?></footer>

    <script src="../assets/funcoes.js"></script>
    <script src="../assets/bootstrap.bundle.min.js"></script>
</body>

</html>