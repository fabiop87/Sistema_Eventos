<?php

$ano = date('Y');

session_start();
//pegando os dados do aluno e do evento
$idEvento = $_GET['id'];

require_once('../../Funcoes/Evento.php');
$Evento = new Evento();

// Acessa a função para pegar o evento selecionado
$evento = $Evento->consultarEvento($idEvento);

// Jogar o aluno para fora da página se ele tentar mudar para um id que não existe
if (!$evento) {
    header('Location: ../HomeAluno.php?message=sai fora pilantra');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/bootstrap.min.css">
    <link rel="stylesheet" href="../../assets/app.css">
    <link rel="shortcut icon" href="../../assets/favicon.ico" type="image/x-icon">
    <title>Eventos</title>

</head>

<body>

    <div class="container text-center centralizar">
        <div class="row">
            <div class="col-12 p-2 event-container">
                <h1><?= $evento['nomeEvento']  ?></h1>

                <p class="descricao"> <?= $evento['descricao'] ?> </p>

                <h4>Local: <?= $evento['local'] ?> </h4>

                <p>Data: <?= date('d/m/Y', strtotime($evento['dataEvento'])) ?></p>
                <p>Horário de Início: <?= date('H:i', strtotime($evento['horarioInicio'])) ?></p>
                <p>Horário de Término: <?= date('H:i', strtotime($evento['horarioTermino'])) ?></p>

            </div>
        </div>
    </div>



    <div class="container mt-4">
        <a class="btn btn-secondary btn-sm" href="../../HomeCoordenador.php">Voltar à página do coordenador</a>
    </div>


    <footer class="footer text-center fixed-bottom">Einstein Limeira <?= $ano ?></footer>
    <script src="../../assets/funcoes.js"></script>
    <script src="../../assets/bootstrap.bundle.min.js"></script>
</body>

</html>