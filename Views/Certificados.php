<?php
session_start();

if (!isset($_SESSION) && !$_SESSION['online']) {
    die('nao tem permissao pra entrar aqui');
}
var_dump($_SESSION);
require_once('../Funcoes/Presenca.php');
// require_once('../Funcoes/Aluno.php');
$Presenca = new Presenca();
// $Aluno = new Aluno();

$idAluno = $_SESSION['idAluno'] ?? '';
// WHERE idAluno = '$idAluno'"
$sql = "SELECT p.*, e.* FROM presenca p INNER JOIN eventos e ON p.idEvento = e.idEvento AND p.codigoAluno = e.codigoCoord";
$resultado = $Presenca->pdo->query($sql);
$eventos = $resultado->fetchAll(PDO::FETCH_ASSOC);



// SELECT e.*, p.*
// FROM eventos e
// INNER JOIN presenca p ON p.idEvento = e.idEvento
// WHERE p.idEvento = 1 AND p.idAluno = 2 AND p.codigoAluno = e.codigoCoord;


echo '<pre>';
print_r($eventos);

// select com join nas 2 tabelas la e fazer o negócio

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
    <h1>Certificados</h1>

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
                        <!-- <form action='../gerarCertificado.php' method='POST'>
                            <input type='hidden' name='idAluno' value='$idAluno'>
                            <input type='hidden' name='idEvento' value='$idEvento'>
                            <input type='hidden' name='nomeEvento' value='$nomeEvento'>
                            <input type='hidden' name='local' value='$local'>
                            <input type='hidden' name='horarioInicio' value='$horarioInicio'>
                            <input type='hidden' name='horarioTermino' value='$horarioTermino'>
                            <button type='submit' class='btn btn-primary'>Gerar Certificado</button>
                        </form> -->

                        <form action="../gerarCertificado.php" method="POST">
                            <input type="hidden" name="idEvento" value="<?= $evento['idEvento']; ?>">
                            <input type="hidden" name="nomeEvento" value="<?= $evento['nomeEvento']; ?>">
                            <input type="hidden" name="local" value="<?= $evento['local']; ?>">
                            <input type="hidden" name="dataEvento" value="<?= $evento['dataEvento']?>">
                            <input type="hidden" name="horarioInicio" value="<?= $evento['horarioInicio']; ?>">
                            <input type="hidden" name="horarioTermino" value="<?= $evento['horarioTermino']; ?>">
                            <input type="submit" class="btn btn-primary" value="Gerar Certificado">
                        </form>






                        <?php
                        // if ($Presenca->verificarInscricao($evento['idEvento'], $idAluno) && $Presenca->validarCertificado($evento['idEvento'], $idAluno)) {
                        // $idEvento = $evento['idEvento'];
                        // $nomeEvento = $evento['nomeEvento'];
                        // $local = $evento['local'];
                        // $dataEvento = $evento['dataEvento'];
                        // $horarioInicio = $evento['horarioInicio'];
                        // $horarioTermino = $evento['horarioTermino'];
                        // # code...
                        // //fazer que ele pode receber o certificado
                        // //botao?
                        // var_dump($nomeEvento);

                        // }
                        ?>


                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>







    <p>fazer os negocios com join e tudo mais</p>

    <script src="../assets/bootstrap.bundle.min.js"></script>
</body>

</html>