<?= $this->extend('layouts/interface'); ?>
<?= $this->section('titre'); ?>
Super Admin - Dossier <?= $tracteur['chrono'] ?>
<?= $this->endSection(); ?>
<?= $this->section('contenu'); ?>

<h1 class="h3 mb-2 text-gray-800"><?= $tracteur['chrono'] ?></h1>

<div class="row">
  <div class="col-md">
    <!-- VT -->
    <div class="card shadow mb-3">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Visite technique</h6>
        <div class="dropdown no-arrow">
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
            <div class="dropdown-header">Actions:</div>
            <a class="dropdown-item" href="#">Renouveler</a>
            <a class="dropdown-item" href="#">Supprimer</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <?php
        use CodeIgniter\I18n\Time;
        if ($controle_vt) : ?>
          <?php
          $start = Time::parse($controle_vt['debut']);
          $end = Time::parse($controle_vt['fin']);
          $days = $start->difference($end)->getDays();
          ?>
          <div class="fs-3">Jours restants: <span class="text-<?= ($days < 20) ? 'danger' : 'success' ?>"><?= ($days <= 0) ? 'EXPIRÉ' : $days ?></span></div>
          Début: <span class="text-primary"><?= date_format(date_create($controle_vt['debut']), 'd-m-Y') ?></span> <br>
          Fin: <span class="text-primary"><?= date_format(date_create($controle_vt['fin']), 'd-m-Y') ?></span>
        <?php else : ?>
          <div class="alert alert-warning text-center" role="alert">
            <p>Aucune visite technique n'a été enregistrée pour ce tracteur.</p>
            <a class="btn btn-success" href="#" role="button">Ajouter une visite technique</a>
          </div>
        <?php endif ?>
      </div>
    </div>

    <!-- CAT -->
    <div class="card shadow mb-3">
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">C.A.T.</h6>
        <div class="dropdown no-arrow">
          <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
            <div class="dropdown-header">Actions:</div>
            <a class="dropdown-item" href="#">Renouveler</a>
            <a class="dropdown-item" href="#">Supprimer</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <?php
        if ($controle_cat) : ?>
          <?php
          $start = Time::parse($controle_cat['debut']);
          $end = Time::parse($controle_cat['fin']);
          $days = $start->difference($end)->getDays();
          ?>
          <div class="fs-3">Jours restants: <span class="text-<?= ($days < 20) ? 'danger' : 'success' ?>"><?= ($days <= 0) ? 'EXPIRÉ' : $days ?></span></div>
          Début: <span class="text-primary"><?= date_format(date_create($controle_cat['debut']), 'd-m-Y') ?></span> <br>
          Fin: <span class="text-primary"><?= date_format(date_create($controle_cat['fin']), 'd-m-Y') ?></span>
        <?php else : ?>
          <div class="alert alert-warning text-center" role="alert">
            <p>Aucun C.A.T. n'a été enregistrée pour ce tracteur.</p>
            <a class="btn btn-success" href="#" role="button">Ajouter un C.A.T.</a>
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
          <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink" style="">
            <div class="dropdown-header">Actions:</div>
            <a class="dropdown-item" href="#">Renouveler</a>
            <a class="dropdown-item" href="#">Supprimer</a>
          </div>
        </div>
      </div>
      <div class="card-body">
        <?php
        if ($controle_as) : ?>
          <?php
          $start = Time::parse($controle_as['debut']);
          $end = Time::parse($controle_as['fin']);
          $days = $start->difference($end)->getDays();
          ?>
          <div class="fs-3">Jours restants: <span class="text-<?= ($days < 20) ? 'danger' : 'success' ?>"><?= ($days <= 0) ? 'EXPIRÉ' : $days ?></span></div>
          Début: <span class="text-primary"><?= date_format(date_create($controle_as['debut']), 'd-m-Y') ?></span> <br>
          Fin: <span class="text-primary"><?= date_format(date_create($controle_as['fin']), 'd-m-Y') ?></span>
        <?php else : ?>
          <div class="alert alert-warning text-center" role="alert">
            <p>Aucune Assurance n'a été enregistrée pour ce tracteur.</p>
            <a class="btn btn-success" href="#" role="button">Ajouter une Assurance</a>
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
        <?php if ($tracteur['au_rebut'] == "NON") : ?>
          <div class="alert alert-success text-center" role="alert">
            <div class="">OPERATIONNEL</div>
          </div>
        <?php else : ?>
          <div class="alert alert-danger text-center" role="alert">
            <div class="">AU REBUT</div>
          </div>
        <?php endif ?>

        Chrono: <span class="text-primary"><?= $tracteur['chrono'] ?></span> <br>
        Immatriculation: <span class="text-primary"><?= $tracteur['immatriculation'] ?></span> <br>
        Ancienne immatriculation: <span class="text-primary"><?= $tracteur['ancienne_immatriculation'] ?></span> <br>
        Marque: <span class="text-primary"><?= $tracteur['marque'] ?></span> <br>
        Modèle: <span class="text-primary"><?= $tracteur['modele'] ?></span> <br>
        <div class="d-grid gap-2">
          <button type="button" class="btn btn-warning">Modifier les imformations</button>
          <button type="button" class="btn btn-danger">Supprimer</button>
        </div>
      </div>
    </div>
    <div class="card shadow mb-3">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Remarque</h6>
      </div>
      <div class="card-body">
        <?= $tracteur['remarque'] ?>
      </div>
    </div>
  </div>
</div>


<?= $this->endSection(); ?>