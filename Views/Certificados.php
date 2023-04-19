<?php
session_start();

if (!isset($_SESSION) && !$_SESSION['online']) {
    die('nao tem permissao pra entrar aqui');
}

require_once('../Funcoes/Presenca.php');

$Presenca = new Presenca();


$ra = $_SESSION['ra'] ?? '';

$sql = "SELECT p.*, e.* FROM presenca p INNER JOIN eventos e ON p.idEvento = e.idEvento AND p.codigoAluno = e.codigoCoord WHERE ra = '$ra'";
$resultado = $Presenca->pdo->query($sql);
$eventos = $resultado->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/bootstrap.min.css">
</head>

<body>
    <h1 class="text-center">Certificados do Aluno</h1>

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
                        <?php
                        if ($Presenca->verificarInscricao($evento['idEvento'], $ra) && $Presenca->validarCertificado($evento['idEvento'], $ra)) {
                        ?>
                            <form action="../gerarCertificado.php" method="POST">
                                <input type="hidden" name="idEvento" value="<?= $evento['idEvento']; ?>">
                                <input type="hidden" name="nomeEvento" value="<?= $evento['nomeEvento']; ?>">
                                <input type="hidden" name="local" value="<?= $evento['local']; ?>">
                                <input type="hidden" name="dataEvento" value="<?= $evento['dataEvento'] ?>">
                                <input type="hidden" name="horarioInicio" value="<?= $evento['horarioInicio']; ?>">
                                <input type="hidden" name="horarioTermino" value="<?= $evento['horarioTermino']; ?>">
                                <input type="submit" class="btn btn-primary" value="Gerar Certificado">
                            </form>
                        <?php
                        }
                        ?>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a class="btn btn-secondary btn-sm" href="../HomeAluno.php">Voltar à pagina do aluno</a>


    <script src="../assets/bootstrap.bundle.min.js"></script>
</body>

</html>