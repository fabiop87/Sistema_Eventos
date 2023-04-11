<?php


if(isset($_GET['search']) && $_GET['search'] != ''){
  $pesquisa = ($_GET['search']);
  $sql = "SELECT * FROM eventos WHERE nomeEvento LIKE '$pesquisa'";
}else{
  $sql = "SELECT * FROM eventos";
}

$resultado = $Coordenador->pdo->prepare($sql);
$resultado->execute();
$eventos = $resultado->fetchAll(PDO::FETCH_ASSOC);




?>

<h1>Eventos cadastrados</h1>

<table class="table">
  <thead>
    <tr>
      <th>ID</th>
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
          <form action="../Controllers/controllerEvento.php" method="POST">
            <input type="hidden" name="idEvento" value="<?= $evento['idEvento'] ?>">
            <button class="btn btn-danger" type="submit">Excluir</button>
            <input type="hidden" name="tiporeq_evt" value="Delete">
          </form>
        </td>






        <!-- acho que aqui fazer um jhonson pra se inscrever -->
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php


?>


<?php
/*
Exemplo de fazer o update e delete pelo formulario


<td>
          <form action="controllerEvento.php" method="post">
            <input type="hidden" name="idEvento" value="<?= $evento['idEvento'] ?>">
            <button type="submit">Atualizar</button>
            <input type="hidden" name="tipo_req_evt" value="update">
          </form>
        </td>
        <td>
          <form action="controllerEvento.php" method="post">
            <input type="hidden" name="idEvento" value="<?= $evento['idEvento'] ?>">
            <button type="submit">Excluir</button>
          <input type="hidden" name="tipo_req_evt" value="delete">
          </form>
        </td>



*/

?>