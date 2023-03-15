<?php
//completar aqui (no exemplo que peguei era a )
    if(!isset($_SESSION[''])){
        header('Location: index.php');
    }

    session_start();
    session_unset();
    session_destroy();
    header('Location: ../index.php');