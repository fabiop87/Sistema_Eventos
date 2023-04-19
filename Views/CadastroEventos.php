<?php
session_start();

if (!isset($_SESSION) && !$_SESSION['idCoordenador']) {
  die('nao tem permissao pra entrar aqui');
}

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

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-6 mt-5">

        <form action="../Controllers/controllerEvento.php" method="POST" autocomplete="off">

          <fieldset>
            <legend class="text-center">Cadastrar Novo Evento</legend>

            <div class="form-group">
              <label for="nomeEvento" class="form-label">Nome do evento:</label>
              <input type="text" name="nomeEvento" id="nomeEvento" class="form-control">
            </div>

            <div class="form-group">
              <label for="descricao" class="form-label">Descrição:</label>
              <textarea name="descricao" id="descricao" cols="40" rows="8"></textarea>
            </div>

            <div class="form-group">
              <label for="local" class="form-label">Local:</label>
              <input type="text" name="local" id="local" class="form-control">
            </div>

            <div class="form-group">
              <label for="dataEvento" class="form-label">Data do evento:</label>
              <input type="date" name="dataEvento" id="dataEvento" class="form-control">
            </div>

            <div class="form-group">
              <label for="horarioInicio" class="form-label">Horário de início:</label>
              <input type="time" name="horarioInicio" id="horarioInicio" class="form-control">
            </div>

            <div class="form-group">
              <label for="horarioTermino" class="form-label">Horário de término:</label>
              <input type="time" name="horarioTermino" id="horarioTermino" class="form-control">
            </div>

            <div class="form-group">
              <label for="codigoCoord" class="form-label">Código para a presença dos alunos:</label>
              <input type="text" name="codigoCoord" id="codigoCoord" class="form-control" maxlength="8">
              <button type="button" class="btn btn-secondary" onclick="stringAleatoria()">Gerar Código</button>
            </div>

            <input type="hidden" name="tiporeq_evt" value="Register">

            <input type="submit" value="Enviar" class="btn btn-primary">

          </fieldset>

        </form>

      </div>
    </div>
  </div>
  <a class="btn btn-secondary btn-sm" href="../HomeCoordenador.php">Voltar</a>

  <script src="../assets/funcoes.js"></script>
</body>

</html>