<?php 

if(isset($_SESSION['online'])){
    header('Location: ../index.php');
}



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
    <h1>PROBLEMAS TECNICOS</h1>
    <h2>TORCEDORES CALMA</h2>

    <br>


    <a href="../libs/logout.php" class="btn btn-danger ml-3"><button class="btn btn-danger">Sair da conta</button></a>
    <script src="../assets/bootstrap.bundle.min.js"></script>
</body>

</html>