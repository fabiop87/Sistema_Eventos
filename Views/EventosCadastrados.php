<?php
require_once('conexao.php');

$sql = "SELECT * FROM eventos";
$resultado = $conexao->query($sql);
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
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
