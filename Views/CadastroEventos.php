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
            <textarea name="descricao" id="descricao" cols="50" rows="10"></textarea>
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
            <input type="text" name="codigoCoord" id="codigoCoord" class="form-control">
            <button type="button" class="btn btn-secondary" onclick="stringAleatoria()">Gerar Código</button>
          </div>

          <input type="hidden" name="tiporeq_evt" value="Register">

          <input type="submit" value="Enviar" class="btn btn-primary">



        </fieldset>


      </form>


    </div>
  </div>
</div>