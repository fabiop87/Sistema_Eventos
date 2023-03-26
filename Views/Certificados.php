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

$idAluno = $_SESSION['idAluno'];
// WHERE idAluno = '$idAluno'"
$sql = "SELECT * FROM presenca";
$resultado = $Presenca->pdo->query($sql);
$eventos = $resultado->fetchAll(PDO::FETCH_ASSOC);

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

    <table>
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
                        <button class="btn btn-secondary">Gerar certificado</button>
                    <td>
                        <form action="../Controllers/controllerPresenca.php" method="POST">
                            <input type="hidden" name="idEvento" value="<?= $evento['idEvento'] ?>">
                            <input type="hidden" name="idEvento" value="<?= $Aluno['idAluno'] ?>">
                            <input type="text" name="codigoAluno" id="codigoAluno" maxlength="8">
                            <button class="btn btn-danger" type="submit">Enviar Código</button>
                            <input type="hidden" name="tiporeq_presenca" value="Confirmar">
                        </form>
                    </td>
                    <td>
                        <?php
                        if ($Presenca->verificarInscricao($evento['idEvento'], $idAluno) && $Presenca->validarCertificado($evento['idEvento'], $idAluno)) {
                            # code...
                            //fazer que ele pode receber o certificado
                            //botao?
                            return '<button class="btn btn-secondary">Gerar certificado</button>';
                        }
                        ?>
                    </td>



                    <!-- acho que aqui fazer um jhonson pra se inscrever -->
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>







    <p>fazer os negocios com join e tudo mais</p>

    <script src="../assets/bootstrap.bundle.min.js"></script>
</body>

</html>