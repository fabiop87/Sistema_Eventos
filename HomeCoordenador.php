<?php


session_start();

// require_once('./libs/DadosAlunoouCoord.php');



if (!isset($_SESSION) && !$_SESSION['idCoordenador']) {
    header('Location: /index.php');
}

var_dump($_POST);
var_dump($_SESSION);

require_once('./Funcoes/Coordenador.php');
$Coordenador = new Coordenador();


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
</head>

<body>
    <h1>HOME Coordenador</h1>

    <nav class="nav justify-content-end">
        <a class="nav-link-active" aria-current="page" href="#">Pagina do Coordenador</a>
        <a class="nav-link" href="./Views/Certificados.php">Certificados</a>
        <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Buscar</button>
        </form>
    </nav>

    <?php
    include_once('./Views/CadastroEventos.php');
    include_once('./Views/ListaEvt_Coord.php');
    ?>


    <a href="../libs/logout.php" class="btn btn-danger ml-3"><button class="btn btn-danger">Sair da conta</button></a>



    <div>
        <a href="./Redefinir_Senha.php">Trocar senha</a>
    </div>


    <script src="../assets/funcoes.js"></script>
    <script src="../assets/bootstrap.bundle.min.js"></script>
</body>

</html>