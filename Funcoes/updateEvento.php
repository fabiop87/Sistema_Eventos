<?php
// fazer a permissao só para coordenador
session_start();


var_dump($_POST);
var_dump($_SESSION);
require('../Funcoes/Coordenador.php');
$Coordenador = new Coordenador();


if(!isset($_SESSION) && !isset($_SESSION['idCoordenador'])){
    die('sem permissao para alterar dados dos eventos');
}



$idEvento =  $_POST['idEvento'];


$sql = "SELECT * FROM eventos WHERE idEvento = $idEvento";
$resultado = $Coordenador->pdo->prepare($sql);
$resultado->execute();
$evento = $resultado->fetch(PDO::FETCH_ASSOC);
echo '<pre>';
print_r($evento);


// $nomeEvento = $evento['idEvento'] ?? null;
// $descricao = $_POST['descricao'] ?? null;
// $local = $_POST['local'] ?? null;
// $dataEvento = $_POST['dataEvento'] ?? null;
// $horarioInicio = $_POST['horarioInicio'] ?? null;
// $horarioTermino = $_POST['horarioTermino'] ?? null;
// $codigoCoord = $_POST['codigoCoord'] ?? null;


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
    </h1>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 mt-5">

                <form action="../Controllers/controllerEvento.php" method="POST" autocomplete="off">

                    <fieldset>
                        <legend class="text-center">Atualizar Evento</legend>

                        <div class="form-group">
                            <label for="nomeEvento" class="form-label">Nome do evento:</label>
                            <input type="text" name="nomeEvento" id="nomeEvento" class="form-control" value="<?= $evento['nomeEvento'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="descricao" class="form-label">Descrição:</label>
                            <textarea name="descricao" id="descricao" cols="50" rows="10"></textarea value="<?= $evento['descricao'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="local" class="form-label">Local:</label>
                            <input type="text" name="local" id="local" class="form-control" value="<?= $evento['local']  ?>">
                        </div>

                        <div class="form-group">
                            <label for="dataEvento" class="form-label">Data do evento:</label>
                            <input type="date" name="dataEvento" id="dataEvento" class="form-control" value="<?= $evento['dataEvento'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="horarioInicio" class="form-label">Horário de início:</label>
                            <input type="time" name="horarioInicio" id="horarioInicio" class="form-control" value="<?= $evento['horarioInicio'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="horarioTermino" class="form-label">Horário de término:</label>
                            <input type="time" name="horarioTermino" id="horarioTermino" class="form-control" value="<?= $evento['horarioTermino'] ?>">
                        </div>

                        <div class="form-group">
                            <label for="codigoCoord" class="form-label">Código para a presença dos alunos:</label>
                            <input type="text" name="codigoCoord" id="codigoCoord" class="form-control" value="<?= $evento['codigoCoord'] ?>">
                            <button type="button" class="btn btn-secondary" onclick="stringAleatoria()">Gerar Código</button>
                        </div>
                        <input type="hidden" name="idEvento" value="<?= $idEvento?>">
                        <input type="hidden" name="tiporeq_evt" value="Update">

                        <input type="submit" value="Salvar Alterações" class="btn btn-primary">



                    </fieldset>


                </form>


            </div>
        </div>
    </div>
    <div>
        <a class="link-primary" href="../HomeCoordenador.php">Voltar</a>
    </div>


    <script src="../assets/validacoes.js"></script>
    <script src="../assets/bootstrap.bundle.min.js"></script>
</body>

</html>
