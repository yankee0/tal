<?= $this->extend('layouts/interface'); ?>
<?= $this->section('titre'); ?>
Super Admin - Tracteurs - <?= $chrono ?>
<?= $this->endSection(); ?>
<?= $this->section('contenu'); ?>

<h1 class="h3 mb-2 text-gray-800"><?= $chrono ?></h1>
<div class="row">
  <div class="col-md-6">

    <div class="card border-left-success shadow py-2 mb-3">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Visites techniques</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              Début: <br>
              Fin:
            </div>
            <div class="d-flex gap-2">
              <a name="" id="" class="btn btn-success" href="<?=base_url(session()->root.'/tracteurs/VT/'.$chrono)?>" role="button">Ajouter/Renouveler</a>
              <button type="button" class="btn btn-danger">Supprimer</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card border-left-success shadow py-2 mb-3">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Assurrance</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              Début: <br>
              Fin:
            </div>
            <div class="row gap-3">
              <button type="button" class="col-md btn btn-success">Ajouter/Renouveler</button>
              <!-- <div class="mx-2"></div> -->
              <button type="button" class="col-md btn btn-danger">Supprimer</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card border-left-success shadow py-2 mb-3">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              C.A.T.</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">
              Début: <br>
              Fin:
            </div>
            <div class="row gap-3">
              <button type="button" class="col-md btn btn-success">Ajouter/Renouveler</button>
              <!-- <div class="mx-2"></div> -->
              <button type="button" class="col-md btn btn-danger">Supprimer</button>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <div class="col-md-6">
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Descriptifs</h6>
      </div>
      <div class="card-body">
        <p>
          Chrono: <span class="text-primary"><?= $chrono ?></span> <br>
          Immatriculation: <span class="text-primary"><?= $immatriculation ?></span> <br>
          Ancienne Immatriculation: <span class="text-primary"><?= $ancienne_immatriculation ?></span> <br>
          Marque: <span class="text-primary"><?= $marque ?></span> <br>
          Modèle: <span class="text-primary"><?= $modele ?></span> <br>
          Au rebut: <span class="text-primary"><?= $au_rebut ?></span> <br>
          Remaque: <span class="text-primary"><?= $remarque ?></span> <br>
        </p>
        <div class="d-flex gap-2">
          <button type="button" class="btn btn-warning">Modifier les informations</button>
          <button type="button" class="btn btn-danger">Supprimer</button>
        </div>
      </div>
    </div>
  </div>
</div>




<?= $this->endSection(); ?>