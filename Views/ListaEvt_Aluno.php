<?php
// require_once('./libs/conexao.php');
// require('./Funcoes/Aluno.php');
// $Aluno = new Aluno();
// require_once('./libs/DadosAlunoouCoord.php');

$sql = "SELECT * FROM eventos";

$resultado = $Aluno->pdo->prepare($sql);
$resultado->execute();
$eventos = $resultado->fetchAll(PDO::FETCH_ASSOC);
// echo '======================';
// var_dump($dadosAluno);
// echo '======================';

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






                <!-- acho que aqui fazer um jhonson pra se inscrever -->
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>



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