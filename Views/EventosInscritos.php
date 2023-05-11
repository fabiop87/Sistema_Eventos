<?php
// date_default_timezone_set("America/Sao_Paulo");
// $dataAtual = date('d/m/Y'); // fazer o negocio de nao puxar evento que ja passou
require_once('./Funcoes/Presenca.php');


$sql = "SELECT *
FROM eventos
WHERE idEvento IN (
  SELECT DISTINCT e.idEvento
  FROM eventos e
  INNER JOIN presenca p ON e.idEvento = p.idEvento 
  WHERE p.ra = :ra
)
  ORDER BY dataEvento DESC
";

$stmt = $Aluno->getPDO()->prepare($sql);
$stmt->bindParam(':ra', $ra, PDO::PARAM_STR);
$stmt->execute();
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);


$VerificarSeOAlunoJaConfirmouPresenca = new Presenca();



?>

<div class="container-fluid">
    <div class="row d-flex flex-wrap ">
        <?php foreach ($eventos as $evento) : ?>
            <?php if ($VerificarSeOAlunoJaConfirmouPresenca->validarCertificado($evento['idEvento'], $_SESSION['ra'])) {
                $corDoCard = 'yellow';
            } else {
                $corDoCard = 'aqua';
            } ?>
            <div class="col-12 col-md-3 col-lg-4 col-xl-2 mb-4">
                <div class="card" style="background-color: <?php echo $corDoCard; ?>;">
                    <p><?= $evento['idEvento'] ?></p>
                    <h5><?= $evento['nomeEvento'] ?></h5>
                    <p>Data: <?= date('d/m/Y', strtotime($evento['dataEvento'])) ?></p>
                    <p>Local: <?= $evento['local'] ?></p>
                    <?php if ($corDoCard == 'yellow') { ?>
                        <small>Presença já confirmada!</small>

                    <?php } else { ?>
                        <small>|</small>
                    <?php } ?>
                    
                    <a href="./Views/Evento.php?id=<?= $evento['idEvento'] ?>" class="btn btn-secondary">Saber mais</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
