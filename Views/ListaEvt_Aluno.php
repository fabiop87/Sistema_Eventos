<?php

//$data = date('d/m/Y'); // fazer o negocio de nao puxar evento que ja passou

if (isset($_GET['search']) && $_GET['search'] != '') {
    $pesquisa = ($_GET['search']);
    $sql = "SELECT * FROM eventos WHERE nomeEvento LIKE '%$pesquisa%'";
} else {
    $sql = "SELECT *
     FROM eventos
     WHERE idEvento NOT IN (
       SELECT DISTINCT e.idEvento
       FROM eventos e
       INNER JOIN presenca p ON e.idEvento = p.idEvento 
       WHERE p.ra = '$ra'
     )
     ";
}




$resultado = $Aluno->pdo->prepare($sql);
$resultado->execute();
$eventos = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>


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
                    <td></td>


                    <td>
                        <form action="../Controllers/controllerPresenca.php" method="POST">
                            <input type="hidden" name="idEvento" value="<?= $evento['idEvento'] ?>">
                            <input type="hidden" name="ra" value="<?= $_SESSION['ra'] ?>">

                            <button class="btn btn-danger" type="submit">Inscrever</button>
                            <input type="hidden" name="tiporeq_presenca" value="Inscrever">
                        </form>
                    </td>

                    
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>