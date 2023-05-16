<?php

// require_once('../Funcoes/Coordenador.php');

// $Coordenador = new Coordenador();

$Lista = $Coordenador->listarCoordenadores();

?>
<div class="container">
    <h2>Coordenadores Cadastrados</h2>
    <div class="row">
        <div class="col-6">

            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Curso</th>
                        <td>Criado em</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($Lista as $item) : ?>
                        <tr>

                            <td><?= $item['nome'] ?></td>

                            <td><?= $item['nomeCurso'] ?></td>

                            <td><?= date('d/m/Y H:i', strtotime($item['created_at'])) ?></td>


                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>