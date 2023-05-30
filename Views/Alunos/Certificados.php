<?php

session_start();

if (!isset($_SESSION) && !$_SESSION['online']) {
    die('Apenas alunos podem acessar essa página');
}

if (!isset($_SESSION['ra'])) {
    die('Apenas alunos podem acessar essa página');
}

require_once('../../Funcoes/Presenca.php');

$Presenca = new Presenca();


$ra = $_SESSION['ra'] ?? '';

// Retorna os eventos em que o aluno tem o certificado liberado

$eventos = $Presenca->EventosComCertificadoLiberado($ra);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../assets/bootstrap.min.css">
    <title>Certificados</title>
</head>

<body>
    <h1 class="text-center">Certificados do Aluno</h1>


    <table class="table">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nome</th>
                <!-- <th>Descricao</th> -->
                <th>Local</th>
                <th>Data</th>
                <th>Início</th>
                <th>Término</th>
            </tr>
        </thead>
        <tbody class="table-light">
            <?php
            $indice = 1;
            foreach ($eventos as $evento) : ?>
                <tr>
                     <td><?= $indice++ ?></td>
                    <td><?= $evento['nomeEvento'] ?></td>
                    
                    <td><?= $evento['local'] ?></td>
                    <td><?= date('d/m/Y', strtotime($evento['dataEvento'])) ?></td>
                    <td><?= date('H:i', strtotime($evento['horarioInicio'])) ?></td>
                    <td><?= date('H:i', strtotime($evento['horarioTermino'])) ?></td>
                    <td></td>
                    <td>
                        <?php
                        if ($Presenca->verificarInscricao($evento['idEvento'], $ra) && $Presenca->validarCertificado($evento['idEvento'], $ra)) :
                        ?>
                            <form action="/gerarCertificado.php" method="POST">
                                <input type="hidden" name="idEvento" value="<?= $evento['idEvento']; ?>">
                                <input type="hidden" name="nomeEvento" value="<?= $evento['nomeEvento']; ?>">
                                <input type="hidden" name="local" value="<?= $evento['local']; ?>">
                                <input type="hidden" name="dataEvento" value="<?= $evento['dataEvento'] ?>">
                                <input type="hidden" name="horarioInicio" value="<?= $evento['horarioInicio']; ?>">
                                <input type="hidden" name="horarioTermino" value="<?= $evento['horarioTermino']; ?>">
                                <input type="submit" class="btn btn-primary" value="Gerar Certificado">
                            </form>
                        <?php
                        endif
                        ?>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="mt-4 mb-4 fixed-bottom">
        <a class="btn btn-secondary btn-sm" href="../../HomeAluno.php">Voltar à pagina do aluno</a>
    </div>

    
    <script src="../assets/bootstrap.bundle.min.js"></script>
</body>

</html>