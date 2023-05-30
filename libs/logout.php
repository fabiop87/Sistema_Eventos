<?php

    if(!isset($_SESSION['online'])){
        header('Location: ../index.php');
    }

    session_start();
    session_unset();
    session_destroy();
    header('Location: ../index.php');
    exit;