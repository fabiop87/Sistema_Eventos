<?php

session_start();
var_dump($_GET);

$idEvento = $_GET['id'];
$ra = $_SESSION['ra'];
require_once('../Funcoes/Presenca.php');
$Presenca = new Presenca();



$sql = "SELECT *
FROM eventos
WHERE idEvento = '$idEvento'
";

$resultado = $Presenca->pdo->prepare($sql);
$resultado->execute();
$evento = $resultado->fetch(PDO::FETCH_ASSOC);


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

    <div class="container text-center">
        <h1><?= $evento['nomeEvento']  ?></h1>

        <p> <?= $evento['descricao'] ?> </p>

        <h2>Local: <?= $evento['local'] ?> </h2>

        <p>Data: <?= date('d/m/Y', strtotime($evento['dataEvento'])) ?></p>
        <p>Horario de Inicio: <?= date('H:i', strtotime($evento['horarioInicio'])) ?></p>
        <p>Horario de Término: <?= date('H:i', strtotime($evento['horarioTermino'])) ?></p>

        <?php if (!$Presenca->verificarInscricao($evento['idEvento'], $ra)) { ?>
            <form action="../Controllers/controllerPresenca.php" method="POST">
                <input type="hidden" name="idEvento" value="<?= $evento['idEvento'] ?>">
                <input type="hidden" name="ra" value="<?= $_SESSION['ra'] ?>">

                <button class="btn btn-danger" type="submit">Inscrever</button>
                <input type="hidden" name="tiporeq_presenca" value="Inscrever">
            </form>

        <?php } ?>

    </div>


</body>

</html>