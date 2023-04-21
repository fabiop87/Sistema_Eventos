<?php


session_start();


if (!isset($_SESSION) && !isset($_SESSION['ra'])) {
    die('faz o login mano');
}

if (isset($_SESSION['idCoordenador'])) {
    die('calma lá que nao era pra acontecer isso, faz o logout ai');
}

$ano = date('Y');
require_once('./Funcoes/Aluno.php');
$Aluno = new Aluno();

$ra = $_SESSION['ra'];

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/app.css">
</head>

<body>
    <h1 class="text-center">Pagina Inicial Aluno</h1>

    <div class="d-flex flex-row-reverse mb-4">
        <div class="p-2">
            <a href="../libs/logout.php"><button class="btn btn-outline-danger">Sair da conta</button></a>
        </div>
        <div class="p-2">
            <a class="btn btn-outline-info" href="./Redefinir_Senha.php">Trocar senha</a>
        </div>
    </div>


    <nav class="nav justify-content-end">
        <a class="nav-link-active" aria-current="page" href="#">Pagina do Aluno</a>
        <a class="nav-link" href="./Views/Certificados.php">Certificados</a>
        <form class="d-flex" role="search">
            <input name="search" value="<?php if (isset($_GET['search'])) echo $_GET['search']; ?>" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Buscar</button>
        </form>
    </nav>


    <h2>Eventos Disponíveis</h2>

    <?php include_once('./Views/ListaEvt_Aluno.php'); ?>

    <h2>Eventos Inscritos</h2>
    <?php include_once('./Views/EventosInscritos.php') ?>

    <footer class="footer text-center fixed-bottom">Einstein Limeira <?= $ano ?></footer>

    <script src="../assets/funcoes.js"></script>
    <script src="./assets/bootstrap.bundle.min.js"></script>
</body>

</html>