<?php
if(isset($_POST['tiporeq_evt'])){
    header('Location:/?erro=url');
    return false;
  }

  require('../Funcoes/Evento.php');

  
  $nomeEvento = $_POST['nomeEvento'];
  $local = $_POST['local'];
  $dataEvento = $_POST['dataEvento'];
  $horarioInicio = $_POST['horarioInicio'];
  $horarioTermino = $_POST['horarioTermino'];
  $codigoCoord = $_POST['codigoCoord'];
  
  

