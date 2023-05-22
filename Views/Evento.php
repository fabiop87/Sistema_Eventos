<?php

$ano = date('Y');

session_start();
//pegando os dados do aluno e do evento
$idEvento = $_GET['id'];
$ra = $_SESSION['ra'];

require_once('../Funcoes/Presenca.php');
$Presenca = new Presenca();

require_once('../Funcoes/Evento.php');
$Evento = new Evento();

$evento = $Evento->consultarEvento($idEvento);

// $sql = "SELECT *
// FROM eventos
// WHERE idEvento = '$idEvento'
// ";

// $resultado = $Presenca->getPDO()->prepare($sql);
// $resultado->execute();
// $evento = $resultado->fetch(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/app.css">
    <title>Eventos</title>
</head>

<body>

    <div class="container text-center">
        <h1><?= $evento['nomeEvento']  ?></h1>

        <p> <?= $evento['descricao'] ?> </p>

        <h2>Local: <?= $evento['local'] ?> </h2>

        <p>Data: <?= date('d/m/Y', strtotime($evento['dataEvento'])) ?></p>
        <p>Horário de Início: <?= date('H:i', strtotime($evento['horarioInicio'])) ?></p>
        <p>Horário de Término: <?= date('H:i', strtotime($evento['horarioTermino'])) ?></p>

        <div class="container text-center">
            <div class="row-gap-4">
                <div class="col-12 p-2">


                    <?php if (!$Presenca->verificarInscricao($evento['idEvento'], $ra)) : ?>
                        <form action="../Controllers/controllerPresenca.php" method="POST">
                            <input type="hidden" name="idEvento" value="<?= $evento['idEvento'] ?>">
                            <input type="hidden" name="ra" value="<?= $_SESSION['ra'] ?>">

                            <button class="btn btn-danger" type="submit">Inscrever</button>
                            <input type="hidden" name="tiporeq_presenca" value="Inscrever">
                        </form>



                    <?php elseif ($Presenca->verificarInscricao($evento['idEvento'], $ra) && !$Presenca->validarCertificado($evento['idEvento'], $ra)) : ?>



                        <form action="../Controllers/controllerPresenca.php" method="POST" autocomplete="off">
                            <input type="hidden" name="idEvento" value="<?= $evento['idEvento'] ?>">
                            <input type="hidden" name="ra" value="<?= $_SESSION['ra'] ?>">
                            <label for="codigoAluno">Código para registrar presença:</label>
                            <input type="text" name="codigoAluno" class="codigoAluno" maxlength="8" id="codigoAluno-<?= $evento['idEvento'] ?>">
                            <input type="submit" class="codigo_submit btn btn-secondary" value="Enviar">
                            <input type="hidden" name="tiporeq_presenca" value="Confirmar">
                        </form>



                        <form action="../Controllers/controllerPresenca.php" method="POST" onsubmit="return pedirConfirmacao();">
                            <input type="hidden" name="idEvento" value="<?= $evento['idEvento'] ?>">
                            <input type="hidden" name="ra" value="<?= $_SESSION['ra'] ?>">
                            <input type="submit" class="codigo_submit btn btn-dark" value="Desinscrever">
                            <input type="hidden" name="tiporeq_presenca" value="Desinscrever">
                        </form>



                    <?php else : ?>
                        <p> Você já tem presença confirmada neste evento, para obter o seu certificado vá para a pagina inicial e acesse a aba Certificados </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>





    <div class="mt-4">
        <a class="btn btn-secondary btn-sm" href="../HomeAluno.php">Voltar à pagina do aluno</a>
    </div>


    <footer class="footer text-center fixed-bottom">Einstein Limeira <?= $ano ?></footer>
    <script src="../assets/funcoes.js"></script>
    <script src="../assets/bootstrap.bundle.min.js"></script>
</body>

</html>