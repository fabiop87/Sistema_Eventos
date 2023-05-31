<?php


// retorna os eventos que já aconteceram a até um mês atrás


  $sql = "SELECT * FROM eventos WHERE dataEvento BETWEEN DATE_SUB(NOW(), INTERVAL 30 DAY) AND NOW() ORDER BY dataEvento DESC LIMIT 10";
  $stmt = $Coordenador->getPDO()->prepare($sql);
  $stmt->execute();


$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);





?>

<h1>Eventos Passados</h1>
<div class="container-fluid">

  <div class="row d-flex flex-wrap">
    <?php foreach ($eventos as $evento) : ?>
      <div class="col-12 col-md-3 col-lg-4 col-xl-2 mb-4">
        <div class="card corzinha-evento-passado">
          <p><?= $evento['idEvento'] ?></p>
          <h5> <?= $evento['nomeEvento'] ?> </h5>
          <p> Data: <?= date('d/m/Y', strtotime($evento['dataEvento'])) ?> </p>
          <p>Local: <?= $evento['local'] ?> </p>
          
          <div class="d-flex m-2">
            <form action="./Views/Coordenadores/InfoEventoCoord.php?id=<?= $evento['idEvento'] ?>" method="POST">
              <input type="hidden" name="idEvento" value="<?= $evento['idEvento'] ?>">
              <button class="btn btn-info" type="submit">Ver</button>
              <input type="hidden" name="tiporeq_evt" value="Update">
            </form>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

</div>


</div>