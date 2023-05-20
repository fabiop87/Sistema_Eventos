<?php

$offsetEvt = $_GET['offsetEvt'] ?? 0;

if (isset($_GET['search']) && $_GET['search'] != '') {
  $pesquisa = ($_GET['search']);
  $sql = "SELECT * FROM eventos WHERE nomeEvento LIKE :pesquisa";
  $stmt = $Coordenador->getPDO()->prepare($sql);
  $stmt->execute([':pesquisa' => "%$pesquisa%"]);
} else {
  $sql = "SELECT * FROM eventos ORDER BY dataEvento DESC LIMIT 10 OFFSET :offset";
  $stmt = $Coordenador->getPDO()->prepare($sql);
  $stmt->bindParam(':offset', $offsetEvt, PDO::PARAM_INT);
  $stmt->execute();
}

$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);





?>

<h1>Eventos cadastrados</h1>
<div class="container-fluid">

  <div class="row d-flex flex-wrap">
    <?php foreach ($eventos as $evento) : ?>
      <div class="col-12 col-md-3 col-lg-4 col-xl-2 mb-4">
        <div class="card corzinha-evento">
          <p><?= $evento['idEvento'] ?></p>
          <h5> <?= $evento['nomeEvento'] ?> </h5>
          <p> Data: <?= date('d/m/Y', strtotime($evento['dataEvento'])) ?> </p>
          <p>Local: <?= $evento['local'] ?> </p>
          <p>desc: <?= $evento['descricao'] ?></p>
          <div class="d-flex m-2">
            <form action="../Funcoes/updateEvento.php" method="POST">
              <input type="hidden" name="idEvento" value="<?= $evento['idEvento'] ?>">
              <button class="btn btn-warning" type="submit">Atualizar</button>
              <input type="hidden" name="tiporeq_evt" value="Update">
            </form>
            <div class="d-flex mx-2">
              <form action="../Controllers/controllerEvento.php" method="POST" onsubmit="return pedirConfirmacao();">
                <input type="hidden" name="idEvento" value="<?= $evento['idEvento'] ?>">
                <button class="btn btn-danger" type="submit">Excluir</button>
                <input type="hidden" name="tiporeq_evt" value="Delete">
              </form>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

</div>

<div>
    <?php if ($offsetEvt > 0) : ?>
        <a href="?offsetEvt=<?= max($offsetEvt - 10, 0) ?>" class="btn btn-secondary">Anterior</a>
    <?php endif; ?>
    <a href="?offsetEvt=<?= $offsetEvt + 10 ?>" class="btn btn-secondary">Próximo</a>
</div>
</div>