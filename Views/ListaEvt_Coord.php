<?php


if (isset($_GET['search']) && $_GET['search'] != '') {
  $pesquisa = ($_GET['search']);
  $sql = "SELECT * FROM eventos WHERE nomeEvento LIKE '%$pesquisa%'";
} else {
  $sql = "SELECT * FROM eventos ORDER BY created_at DESC LIMIT 10";
}

$resultado = $Coordenador->pdo->prepare($sql);
$resultado->execute();
$eventos = $resultado->fetchAll(PDO::FETCH_ASSOC);




?>

<h1>Eventos cadastrados</h1>

<div class="table-responsive">
  <table class="table align-middle">
    <thead>
      <tr>
        <th>Numero</th>
        <th>Nome</th>
        <th>Descricao</th>
        <th>Local</th>
        <th>Data</th>
        <th>Início</th>
        <th>Término</th>
        <th>Código</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($eventos as $evento) : ?>
        <tr>
          <td><?= $evento['idEvento'] ?></td>
          <td><?= $evento['nomeEvento'] ?></td>
          <td><?= $evento['descricao'] ?></td>
          <td><?= $evento['local'] ?></td>
          <td><?= date('d/m/Y', strtotime($evento['dataEvento'])) ?></td>
          <td><?= date('H:i', strtotime($evento['horarioInicio'])) ?></td>
          <td><?= date('H:i', strtotime($evento['horarioTermino'])) ?></td>
          <td><?= $evento['codigoCoord'] ?></td>
          <td>
            <form action="../Funcoes/updateEvento.php" method="POST">
              <input type="hidden" name="idEvento" value="<?= $evento['idEvento'] ?>">
              <button class="btn btn-warning" type="submit">Atualizar</button>
              <input type="hidden" name="tiporeq_evt" value="Update">
            </form>
          </td>
          <td>
            <form action="../Controllers/controllerEvento.php" method="POST" onsubmit="return pedirConfirmacao();">
              <input type="hidden" name="idEvento" value="<?= $evento['idEvento'] ?>">
              <button class="btn btn-danger" type="submit">Excluir</button>
              <input type="hidden" name="tiporeq_evt" value="Delete">
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>