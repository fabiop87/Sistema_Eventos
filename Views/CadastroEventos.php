<!-- <form action="cadastro.php" method="POST">
  <label for="nomeEvento">Nome do evento:</label>
  <input type="text" name="nomeEvento" required>

  <label for="descricao">Descrição do evento:</label>
  <input type="text" name="descricao">

  <label for="local">Local:</label>
  <input type="text" name="local">

  <label for="dataEvento">Data do evento:</label>
  <input type="date" name="dataEvento" required>

  <label for="horarioInicio">Horário de início:</label>
  <input type="time" name="horarioInicio" required>

  <label for="horarioTermino">Horário de término:</label>
  <input type="time" name="horarioTermino" required>

  <button type="submit">Cadastrar</button> -->
</form>

<div class="container">
  <div class="row justify-content-center">
    <div class="col-6 mt-5">

      <form action="../Funcoes/controllerEvento.php" method="POST" autocomplete="off">

        <fieldset>
          <legend class="text-center">Cadastrar Novo Evento</legend>

          <div class="form-group">
            <label for="nomeEvento" class="form-label">Nome do evento:</label>
            <input type="text" name="nomeEvento" id="nomeEvento" required class="form-control">
          </div>

          <div class="form-group">
            <label for="descricao" class="form-label">Descrição:</label>
            <textarea name="descricao" id="descricao" cols="30" rows="5"></textarea>
          </div>

          <div class="form-group">
            <label for="local" class="form-label">Local:</label>
            <input type="text" name="local" id="local" required class="form-control">
          </div>

          <div class="form-group">
            <label for="nomeEvento" class="form-label">Data do evento:</label>
            <input type="date" name="nomeEvento" id="nomeEvento" required class="form-control">
          </div>

          <div class="form-group">
            <label for="horarioInicio" class="form-label">Horário de início:</label>
            <input type="time" name="horarioInicio" id="horarioInicio" required class="form-control">
          </div>

          <div class="form-group">
            <label for="horarioTermino" class="form-label">Horário de término:</label>
            <input type="time" name="horarioTermino" id="horarioTermino" required class="form-control">
          </div>







        </fieldset>


      </form>


    </div>
  </div>
</div>