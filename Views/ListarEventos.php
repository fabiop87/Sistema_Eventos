<?php
require_once('conexao.php');

global $pdo;

$sql = "SELECT * FROM eventos";
$resultado = $pdo->query($sql);
$eventos = $resultado->fetchAll(PDO::FETCH_ASSOC);
?>

<h1>Eventos cadastrados</h1>

<table>
  <thead>
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Local</th>
      <th>Data</th>
      <th>Início</th>
      <th>Término</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($eventos as $evento): ?>
      <tr>
        <td><?= $evento['idEvento'] ?></td>
        <td><?= $evento['nomeEvento'] ?></td>
        <td><?= $evento['local'] ?></td>
        <td><?= date('d/m/Y', strtotime($evento['dataEvento'])) ?></td>
        <td><?= date('H:i', strtotime($evento['horarioInicio'])) ?></td>
        <td><?= date('H:i', strtotime($evento['horarioTermino'])) ?></td>
        <!-- acho que aqui fazer um jhonson pra se inscrever -->
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

