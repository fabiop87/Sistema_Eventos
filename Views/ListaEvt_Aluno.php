<?php

if (isset($_GET['search']) && $_GET['search'] != '') {
    $pesquisa = ($_GET['search']);
    $sql = "SELECT * FROM eventos WHERE nomeEvento LIKE '$pesquisa'";
} else {
    $sql = "SELECT * FROM eventos ORDER BY created_at DESC LIMIT 10";
}


$resultado = $Aluno->pdo->prepare($sql);
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

                    <td>
                        <form action="../Controllers/controllerPresenca.php" method="POST">
                            <input type="hidden" name="idEvento" value="<?= $evento['idEvento'] ?>">
                            <input type="hidden" name="idAluno" value="<?= $_SESSION['idAluno'] ?>">

                            <button class="btn btn-danger" type="submit">Inscrever</button>
                            <input type="hidden" name="tiporeq_presenca" value="Inscrever">
                        </form>
                    </td>
                    <td>
                        <form action="../Controllers/controllerPresenca.php" method="POST">
                            <input type="hidden" name="idEvento" value="<?= $evento['idEvento'] ?>">
                            <input type="hidden" name="idAluno" value="<?= $_SESSION['idAluno'] ?>">

                            <label for="codigoAluno">Código para registrar presença:</label>

                            <!-- <input type="text" name="codigoAluno" class="codigoAluno"> -->
                            <input type="text" name="codigoAluno" class="codigoAluno" maxlength="8" id="codigoAluno-<?= $evento['idEvento'] ?>">

                            <input type="submit" class="codigo_submit btn btn-secondary" value="Enviar">
                            <input type="hidden" name="tiporeq_presenca" value="Confirmar">
                        </form>
                    </td>
                    <td>
                        <form action="../Controllers/controllerPresenca.php" method="POST">
                            <input type="hidden" name="idEvento" value="<?= $evento['idEvento'] ?>">
                            <input type="hidden" name="idAluno" value="<?= $_SESSION['idAluno'] ?>">

                            <input type="submit" class="codigo_submit btn btn-dark" value="Desinscrever">

                            <input type="hidden" name="tiporeq_presenca" value="Desinscrever">

                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>