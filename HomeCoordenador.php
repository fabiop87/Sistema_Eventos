<?php


session_start();



if (!isset($_SESSION) || !isset($_SESSION['idCoordenador'])) {
    die();
}



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


    <div class="d-flex flex-row-reverse mb-4">
        <div class="p-2">
            <a href="../libs/logout.php"><button class="btn btn-outline-danger">Sair da conta</button></a>
        </div>
        <div class="p-2">
            <a class="btn btn-outline-info" href="./Redefinir_Senha.php">Trocar senha</a>
        </div>
    </div>
</div>

    <nav class="nav justify-content-end">
        <a class="nav-link-active" aria-current="page" href="#">Pagina do Coordenador</a>
        <a class="nav-link" href="./Views/CadastroEventos.php">Cadastrar novo evento</a>
        <form class="d-flex" role="search">
            <input name="search" value="<?php if (isset($_GET['search'])) echo $_GET['search']; ?>" class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Buscar</button>
        </form>
    </nav>

    <?php
    include_once('./Views/ListaEvt_Coord.php');
    // include_once('./Views/CadastroEventos.php');
    ?>



    <script src="../assets/funcoes.js"></script>
    <script src="../assets/bootstrap.bundle.min.js"></script>
</body>

</html>