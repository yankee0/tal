<?= $this->extend('layouts/interface'); ?>
<?= $this->section('titre'); ?>
Super Admin - Dossier <?= $remorque['chrono'] ?>
<?= $this->endSection(); ?>
<?= $this->section('contenu'); ?>

<h1 class="h3 mb-2 text-gray-800"><?= $remorque['chrono'] ?></h1>

<div class="row">
  <div class="col-md">

    <div class="alert alert-info" role="alert">
      <strong>Info!</strong> Le décompte jours restants est basé sur la date de votre système. Assurez-vous de l'avoir bien réglé.
    </div>

    <!-- VT -->
    <div class="card shadow mb-3">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Visite technique</h6>
        <div class="dropdown no-arrow">
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <div class="dropdown-header">Actions:</div>
            <button class="dropdown-item act" value="Visite technique">Renouveler</button>
            <button class="dropdown-item" href="#">Supprimer</button>
          </div>
        </div>
      </div>
      <div class="card-body">
        <?php

        use CodeIgniter\I18n\Time;

        if ($controle_vt) : ?>
          <?php
          $now = date('Y-m-d');
          $start = Time::parse($now);
          $end = Time::parse($controle_vt['fin']);
          $days = $start->difference($end)->getDays();
          ?>
          <div class="fs-3">Jours restants: <span class="text-<?= ($days < 20) ? 'danger' : 'success' ?>"><?= ($days <= 0) ? 'EXPIRÉ' : $days ?></span></div>
          Début: <span class="text-primary"><?= date_format(date_create($controle_vt['debut']), 'd-m-Y') ?></span> <br>
          Fin: <span class="text-primary"><?= date_format(date_create($controle_vt['fin']), 'd-m-Y') ?></span>
        <?php else : ?>
          <div class="alert alert-warning text-center" role="alert">
            <p>Aucune visite technique n'a été enregistrée pour cette remorque.</p>
            <button class="btn btn-success act" value="Visite technique" role="button">Ajouter une visite technique</button>
          </div>
        <?php endif ?>
      </div>
    </div>

    <!-- CAT -->
    <div class="card shadow mb-3">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">C.A.T.s</h6>
        <div class="dropdown no-arrow">
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <div class="dropdown-header">Actions:</div>
            <button value="C.A.T.s" class="dropdown-item act">Renouveler</button>
            <a class="dropdown-item" href="#">Supprimer</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <?php
        if ($controle_cat) : ?>
          <?php
          $now = date('Y-m-d');
          $start = Time::parse($now);
          $end = Time::parse($controle_cat['fin']);
          $days = $start->difference($end)->getDays();
          ?>
          <div class="fs-3">Jours restants: <span class="text-<?= ($days < 20) ? 'danger' : 'success' ?>"><?= ($days <= 0) ? 'EXPIRÉ' : $days ?></span></div>
          Début: <span class="text-primary"><?= date_format(date_create($controle_cat['debut']), 'd-m-Y') ?></span> <br>
          Fin: <span class="text-primary"><?= date_format(date_create($controle_cat['fin']), 'd-m-Y') ?></span>
        <?php else : ?>
          <div class="alert alert-warning text-center" role="alert">
            <p>Aucun C.A.T.s n'a été enregistré pour cette remorque.</p>
            <button class="btn btn-success act" value="C.A.T.s" role="button">Ajouter un C.A.T.s</button>
          </div>
        <?php endif ?>
      </div>
    </div>

    <div class="card shadow mb-3">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Assurance</h6>
        <div class="dropdown no-arrow">
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
            <div class="dropdown-header">Actions:</div>
            <button class="dropdown-item act" value="Assurance" href="#">Renouveler</button>
            <a class="dropdown-item" href="#">Supprimer</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <?php
        if ($controle_as) : ?>
          <?php
          $now = date('Y-m-d');
          $start = Time::parse($now);
          $end = Time::parse($controle_as['fin']);
          $days = $start->difference($end)->getDays();
          ?>
          <div class="fs-3">Jours restants: <span class="text-<?= ($days < 20) ? 'danger' : 'success' ?>"><?= ($days <= 0) ? 'EXPIRÉ' : $days ?></span></div>
          Début: <span class="text-primary"><?= date_format(date_create($controle_as['debut']), 'd-m-Y') ?></span> <br>
          Fin: <span class="text-primary"><?= date_format(date_create($controle_as['fin']), 'd-m-Y') ?></span>
        <?php else : ?>
          <div class="alert alert-warning text-center" role="alert">
            <p>Aucune Assurance n'a été enregistrée pour cette remorque.</p>
            <button class="btn btn-success act" value="Assurance" role="button">Ajouter une Assurance</button>
          </div>
        <?php endif ?>
      </div>
    </div>


  </div>
  <div class="col-md">
    <div class="card shadow mb-3">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Descriptifs</h6>
      </div>
      <div class="card-body">
        <?php if ($remorque['au_rebut'] == "NON") : ?>
          <div class="alert alert-success text-center" role="alert">
            <div class="">OPERATIONNEL</div>
          </div>
        <?php else : ?>
          <div class="alert alert-danger text-center" role="alert">
            <div class="">AU REBUT</div>
          </div>
        <?php endif ?>

        Chrono: <span class="text-primary"><?= $remorque['chrono'] ?></span> <br>
        Immatriculation: <span class="text-primary"><?= $remorque['immatriculation'] ?></span> <br>
        Ancienne immatriculation: <span class="text-primary"><?= $remorque['ancienne_immatriculation'] ?></span> <br>
        Genre: <span class="text-primary"><?= $remorque['genre'] ?></span> <br>
        <div class="d-grid gap-2">
          <button type="button" class="btn btn-danger del" value="<?= $remorque['chrono'] ?>">Supprimer</button>
        </div>
      </div>
    </div>
    <div class="card shadow mb-3">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Remarque</h6>
      </div>
      <div class="card-body">
        <?= $remorque['remarque'] ?>
      </div>
    </div>
  </div>
</div>

<div id="add_control" class="card shadow-lg">
  <div class="card-header">
    <div class="d-flex align-items-center justify-content-between">
      <span id="action"></span>
      <button onclick="$('#add_control').fadeOut()" type="button" class="btn btn-secondary btn-sm">x</button>
    </div>
  </div>
  <form id="actForm" method="post" class="card-body">
    <div class="form-floating mb-3">
      <input type="date" class="form-control" name="debut" id="debut" required placeholder="date">
      <label for="debut">Début</label>
    </div>
    <div class="form-floating mb-3">
      <input type="date" class="form-control" name="fin" id="fin" required placeholder="date">
      <label for="fin">Fin</label>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
  </form>
</div>

<script>
  $(document).ready(function() {
    $('.act').click(function(e) {
      e.preventDefault();
      $('#add_control').fadeIn();
      $('#action').html($(this).val());
      let item = $(this).val()
      let attr = null
      switch (item) {
        case 'Visite technique':
          attr = './VT/<?= $remorque['chrono'] ?>'
          break;
        case 'Assurance':
          attr = './AS/<?= $remorque['chrono'] ?>'
          break;
        case 'C.A.T.s':
          attr = './CATS/<?= $remorque['chrono'] ?>'
          break;
        default:

          break;
      }
      $('#actForm').attr('action', attr);
    });
  });

  $('.del').click(function(e) {
    e.preventDefault();
    let target = $(this).val()
    if (confirm('Supprimer le remorque chrono: ' + target)) {
      window.location = '<?= base_url(session()->root . '/remorques/supprimer/') ?>' + target
    }
  });
</script>

<?php if (session()->has('deleted')) : ?>
  <?php if (session()->deleted) : ?>
    <script>
      alert('Suppression réussie')
    </script>
  <?php else : ?>
    <script>
      alert('Echec de la supression')
    </script>
  <?php endif ?>
<?php endif ?>

<?= $this->endSection(); ?>