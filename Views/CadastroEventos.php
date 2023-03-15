<form action="cadastro.php" method="POST">
  <label for="nomeEvento">Nome do evento:</label>
  <input type="text" name="nomeEvento" required>

  <label for="local">Local:</label>
  <input type="text" name="local">

  <label for="dataEvento">Data do evento:</label>
  <input type="date" name="dataEvento" required>

  <label for="horarioInicio">Horário de início:</label>
  <input type="time" name="horarioInicio" required>

  <label for="horarioTermino">Horário de término:</label>
  <input type="time" name="horarioTermino" required>

  <button type="submit">Cadastrar</button>
</form>
