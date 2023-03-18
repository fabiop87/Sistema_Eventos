<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/bootstrap.min.css">
    <title>Document</title>
</head>



<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 mt-5">

                <form action="./Funcoes/controllerAluno.php" method="POST" autocomplete="off"> <!--  action  -->

                    <fieldset>
                        <legend class="text-center">Registro Aluno</legend>

                        <div class="form-group">
                            <label for="ra" class="form-label">RA:</label>
                            <input type="text" name="ra" id="ra" required class="form-control" placeholder="000000" maxlength="7">

                        </div>

                        <div class="form-group">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" name="nome" id="nome" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="senha" class="form-label">Senha:</label>
                            <input type="password" name="senha" id="senha" required class="form-control">
                        </div>


                        <div class="form-group">
                            <label for="senha">Confirmar senha:</label>
                            <input type="password" name="confirm_senha" id="confirm_senha" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="curso" class="form-label">Curso:</label>
                            <select class="form-select" name="idCurso" id="curso" required>
                                <option value="">Selecione um curso</option>
                                <option value="1">TADS</option>
                                <option value="2">Psicologia</option>
                                <option value="3">Eng. Civil</option>
                                <!-- Adicionar outras opções do banco de dados aqui -->
                            </select>
                        </div>
                        <input type="hidden" name="tipo_usuario" value="aluno">
                        <input type="hidden" name="LoginouRegister" value="Register">

                        <input type="submit" value="Registrar" class="btn btn-secondary">

                    </fieldset>
                </form>
                <a href="index.php">Voltar ao Login</a>
            </div>
        </div>
    </div>
    <!-- |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6 mt-5">

                <form action="./Funcoes/controllerAluno.php" method="POST" autocomplete="off"> <!--  action  -->

                    <fieldset>
                        <legend class="text-center">Registro Coordenador</legend>

                        <div class="form-group">
                            <label for="nome" class="form-label">Nome:</label>
                            <input type="text" name="nome" id="nome" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="senha" class="form-label">Senha:</label>
                            <input type="password" name="senha" id="senha" required class="form-control">
                        </div>


                        <div class="form-group">
                            <label for="senha">Confirmar senha:</label>
                            <input type="password" name="confirm_senha" id="confirm_senha" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="curso" class="form-label">Curso:</label>
                            <select class="form-select" name="idCurso" id="curso" required>
                                <option value="">Selecione um curso</option>
                                <option value="1">TADS</option>
                                <option value="2">Psicologia</option>
                                <option value="3">Eng. Civil</option>
                                <!-- Adicionar outras opções do banco de dados aqui -->
                            </select>
                        </div>
                        <input type="hidden" name="tipo_usuario" value="coordenador">
                        <input type="hidden" name="LoginouRegister" value="Register">

                        <input type="submit" value="Registrar" class="btn btn-primary">

                    </fieldset>
                </form>
                <a href="index.php">Voltar ao Login</a>
            </div>
        </div>
    </div>

    <script src="./assets/bootstrap.bundle.min.js"></script>
</body>

</html>