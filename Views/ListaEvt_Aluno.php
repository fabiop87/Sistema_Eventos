<?php

date_default_timezone_set("America/Sao_Paulo");
$dataAtual = date('d/m/Y'); // fazer o negocio de nao puxar evento que ja passou
echo $dataAtual;

if (isset($_GET['search']) && $_GET['search'] != '') {
    $pesquisa = ($_GET['search']);
    $sql = "SELECT * FROM eventos WHERE nomeEvento LIKE '%$pesquisa%'      
    AND dataEvento >= NOW()
     AND idEvento NOT IN (
       SELECT DISTINCT e.idEvento
       FROM eventos e
       INNER JOIN presenca p ON e.idEvento = p.idEvento 
       WHERE p.ra = '$ra'
     )
     ORDER BY dataEvento DESC LIMIT 10
     ";
} else {
    $sql = "SELECT *
     FROM eventos  
     WHERE dataEvento >= NOW() 
      AND idEvento NOT IN (
       SELECT DISTINCT e.idEvento
       FROM eventos e
       INNER JOIN presenca p ON e.idEvento = p.idEvento 
       WHERE p.ra = '$ra'
     )
     ORDER BY dataEvento DESC
     ";
}


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
        </div>
    <?php endforeach; ?>
</div>

