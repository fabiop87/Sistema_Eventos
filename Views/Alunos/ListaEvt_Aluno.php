<?php



$offsetEvtDisponivel = $_GET['offsetEvtDisponivel'] ?? 0;

// retorna os eventos disponíveis para inscrição, se ele usar o campo de pesquisa usa o like, senão retorna todos com um offset de 10

if (isset($_GET['search']) && $_GET['search'] != '') {
    $pesquisa = $_GET['search'];
    $pesquisa = '%'.$pesquisa.'%';
    $sql = "SELECT * FROM eventos WHERE nomeEvento LIKE :pesquisa      
      AND dataEvento >= NOW()
       AND idEvento NOT IN (
         SELECT DISTINCT e.idEvento
         FROM eventos e
         INNER JOIN presenca p ON e.idEvento = p.idEvento 
         WHERE p.ra = :ra
       )
       ORDER BY dataEvento DESC LIMIT 10
       ";
    $stmt = $Aluno->getPDO()->prepare($sql);
    $stmt->bindParam(':pesquisa', $pesquisa, PDO::PARAM_STR);
    $stmt->bindParam(':ra', $ra, PDO::PARAM_STR);
} else {
    $sql = "SELECT *
       FROM eventos  
       WHERE dataEvento >= NOW() 
        AND idEvento NOT IN (
         SELECT DISTINCT e.idEvento
         FROM eventos e
         INNER JOIN presenca p ON e.idEvento = p.idEvento 
         WHERE p.ra = :ra
       )
       ORDER BY dataEvento DESC LIMIT 10 OFFSET :offset
       ";
    $stmt = $Aluno->getPDO()->prepare($sql);
    $stmt->bindParam(':ra', $ra, PDO::PARAM_STR);
    $stmt->bindParam(':offset', $offsetEvtDisponivel, PDO::PARAM_INT);
}

$stmt->execute();
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>


<div class="container-fluid">


    <div class="row d-flex flex-wrap">
        <?php foreach ($eventos as $evento) : ?>
            <div class="col-12 col-md-3 col-lg-4 col-xl-2 mb-4">
                <div class="card corzinha-evento">
                    <p><?= $evento['idEvento'] ?></p>
                    <h5> <?= $evento['nomeEvento'] ?> </h5>
                    <p> Data: <?= date('d/m/Y', strtotime($evento['dataEvento'])) ?> </p>
                    <p>Local: <?= $evento['local'] ?> </p>
                    <a href="./Views/Alunos/InfoEventoAluno.php?id=<?= $evento['idEvento'] ?>" class="btn btn-secondary">Saber mais</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>

<div>
    <?php if ($offsetEvtDisponivel > 0) : ?>
        <a href="?offsetEvtDisponivel=<?= max($offsetEvtDisponivel - 10, 0) ?>" class="btn btn-secondary">Anterior</a>
    <?php endif; ?>
    <a href="?offsetEvtDisponivel=<?= $offsetEvtDisponivel + 10 ?>" class="btn btn-secondary">Próximo</a>
</div>
</div>