<?php
// date_default_timezone_set("America/Sao_Paulo");
// $dataAtual = date('d/m/Y'); // fazer o negocio de nao puxar evento que ja passou
// echo $dataAtual;

$sql = "SELECT *
FROM eventos
WHERE idEvento IN (
  SELECT DISTINCT e.idEvento
  FROM eventos e
  INNER JOIN presenca p ON e.idEvento = p.idEvento 
  WHERE p.ra = '$ra'
)
";

$resultado = $Aluno->pdo->prepare($sql);
$resultado->execute();
$eventos = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="row d-flex flex-wrap">
    <?php foreach ($eventos as $evento) : ?>
        <div class="card col-md-4">
            <div>
                <p><?= $evento['idEvento'] ?></p>
                <h5> <?= $evento['nomeEvento'] ?> </h5>
                <p> <?= date('d/m/Y', strtotime($evento['dataEvento'])) ?> </p>
                <p>Local: <?= $evento['local'] ?> </p>
                <a href="./Views/Evento.php?id=<?= $evento['idEvento'] ?>" class="btn btn-primary">Saber mais</a>
            </div>
            
            <!-- <form action="../Controllers/controllerPresenca.php" method="POST" autocomplete="off">
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
            </form> -->
        </div>
    <?php endforeach; ?>
</div>


