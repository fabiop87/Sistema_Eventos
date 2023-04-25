<?php


if (isset($_GET['search']) && $_GET['search'] != '') {
  $pesquisa = ($_GET['search']);
  $sql = "SELECT * FROM eventos WHERE nomeEvento LIKE '%$pesquisa%'";
} else {
  $sql = "SELECT * FROM eventos ORDER BY dataEvento DESC LIMIT 10";
}

$resultado = $Coordenador->pdo->prepare($sql);
$resultado->execute();
$eventos = $resultado->fetchAll(PDO::FETCH_ASSOC);




?>

<h1>Eventos cadastrados</h1>

<div class="row d-flex flex-wrap">
  <?php foreach ($eventos as $evento) : ?>
    <div class="card col-md-2 corzinha-evento m-2">
      <div>
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