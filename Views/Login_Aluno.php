<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login de Aluno</title>
</head>
<body>
    <h1>Login de Aluno</h1>
    <form action="../Funcoes/Aluno.php" method="POST">
        <label for="ra">RA:</label>
        <input type="text" name="ra" id="ra" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required>
        <br>
        <label for="curso">Curso:</label>
        <select name="curso" id="curso" required>
            <option value="">Selecione um curso</option>
            <option value="1">Curso 1</option>
            <option value="2">Curso 2</option>
            <option value="3">Curso 3</option>
            <!-- Adicionar outras opções do banco de dados aqui -->
        </select>
        <br>
        <input type="submit" value="Entrar">
    </form>
</body>
</html>
