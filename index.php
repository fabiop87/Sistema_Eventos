<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="" method="get">
        <label for="tipo_usuario">Tipo de Usuário:</label>
        <select name="tipo_usuario" id="tipo_usuario">
            <option value="aluno">Aluno</option default>
            <option value="coordenador">Coordenador</option>
        </select>
        <input type="submit" value="Escolher">
    </form>
    <?php
    if ($_GET['tipo_usuario'] == 'coordenador') {
        require_once('./Views/Login_Aluno.php');
    } elseif ($_GET['tipo_usuario'] == 'aluno') {
        require_once('./Views/Login_Coordenador.php');
    } else {
        die('sai daqui');
    }
    ?>


    <?php require_once('./Views/Login.php'); ?>

    <a href="register.php">Registrar usuario</a>

</body>

</html>