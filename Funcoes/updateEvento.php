<?php
/*

seguir esse exemplo de testes


$aluno = $bd->select("SELECT * FROM alunos WHERE idAluno = :idAluno", $params)[0];


<form action="update_submit.php" method="post" autocomplete="off">
        <input type="hidden" name="idAluno" value="<?= aes_encrypt($aluno['idAluno']) ?>">
        <div>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" maxlength="60" placeholder="digite seu nome" value="<?= $aluno['nome'] ?>">
        </div>
        <div>
            <label for="ra">RA:</label>
            <input type="text" name="RA" id="RA" maxlength="7" placeholder="0000000" value="<?= $aluno['RA'] ?>">
        </div>
        <div>
            <input type="submit" value="Enviar">
        </div>
        <div>
            <a href="veralunos.php">Cancelar</a>
        </div>


    </form>
*/