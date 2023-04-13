<?php

require_once('./libs/conexao.php');

$conn = new conexao();

$sql = "SELECT idCurso, nomeCurso FROM cursos";
$stmt = $conn->pdo->query($sql);
$cursos = $stmt->fetchAll();

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/app.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 mt-5">

                <form action="./Controllers/controllerCoordenador.php" method="POST" autocomplete="off"> <!--  action  -->

                    <fieldset>
                        <legend class="text-center">Registro Coordenador</legend>

                        <small id="texto"></small>
                        <div class="form-group">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" name="nome" id="nome" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="senha" class="form-label">Senha:</label>
                            <input type="password" name="senha" id="senha" required class="form-control" placeholder="******">
                        </div>


                        <div class="form-group">
                            <label for="confirm_senha">Confirmar senha:</label>
                            <input type="password" name="confirm_senha" id="confirm_senha" required class="form-control" placeholder="******">
                        </div>

                        <div class="form-group">
                            <label for="curso" class="form-label">Curso:</label>
                            <select class="form-select" name="idCurso" id="curso" required>
                                <option disabled value="">Selecione seu curso</option>
                                <?php foreach ($cursos as $curso) { ?>
                                    <option value="<?= $curso['idCurso'] ?>"><?= $curso['nomeCurso'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <input type="hidden" name="LoginouRegister" value="Register">


                        <div class="form-group">
                            <label for="nome" class="form-label">Código Coordenador:</label>
                            <input type="text" name="cdcod" id="cdcod" required class="form-control" placeholder="Código para criar uma conta de coordenador">
                        </div>

                        <input type="submit" value="Registrar" class="btn btn-outline-warning">


                    </fieldset>
                </form>
                <a class="btn btn-secondary btn-sm" href="index.php">Voltar ao Login</a>
            </div>
        </div>
    </div>
    <script src="./assets/validacoescoord.js"></script>
    <script src="./assets/bootstrap.bundle.min.js"></script>
</body>

</html>