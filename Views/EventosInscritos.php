<?php
// date_default_timezone_set("America/Sao_Paulo");
// $dataAtual = date('d/m/Y'); // fazer o negocio de nao puxar evento que ja passou


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

<div class="container-fluid">

<div class="row d-flex flex-wrap ">
    <?php foreach ($eventos as $evento) : ?>
        <div class="col-12 col-md-3 col-lg-4 col-xl-2 mb-4">
            <div class="card corzinha-evento-inscrito">
                <p><?= $evento['idEvento'] ?></p>
                <h5> <?= $evento['nomeEvento'] ?> </h5>
                <p> Data: <?= date('d/m/Y', strtotime($evento['dataEvento'])) ?> </p>
                <p>Local: <?= $evento['local'] ?> </p>
                <a href="./Views/Evento.php?id=<?= $evento['idEvento'] ?>" class="btn btn-secondary">Saber mais</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</div>