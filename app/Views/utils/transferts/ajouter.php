<?= $this->extend('layouts/interface'); ?>
<?= $this->section('titre'); ?>
OPS TAL - Nouveau transfert
<?= $this->endSection(); ?>
<?= $this->section('contenu'); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">transfert</h1>
</div>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Nouveau transfert</h6>
    
  </div>
  <div class="card-body">
  <form action="<?=base_url(session()->root.'/transfert/ajouter')?>" class="row" method="post">
        <div class="col-md">
          <div class="mb-3">
            <label for="camion" class="form-label">Matricule du camion</label>
            <select class="form-select " name="chrono_tracteur" id="camion">
              <option selected disabled>Selectionner</option>
              <?php foreach ($tracteurs as $tracteur) : ?>
                <option value="<?= $tracteur['chrono'] ?>"><?= $tracteur['immatriculation'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="" class="form-label">Chauffeurs</label>
            <select class="form-select " name="matricule_chauffeur" id="">
              <option selected disabled>Selectionner</option>
              <?php foreach ($chauffeurs as $chauffeur) : ?>
                <option value="<?=$chauffeur['matricule']?>">Mat:  <?= $chauffeur['matricule'].' - '.$chauffeur['prenom'].' '.$chauffeur['nom'] ?></option>
              <?php endforeach ?>
            </select>
          </div>

          <div class="mb-3">
            <label for="type_operation" class="form-label">Type d'opération</label>
            <select class="form-control" id="type_operation" name="type_operation" required>
              <option value="TOM">TOM</option>
              <option value="WALL">WALL</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="numero_conteneur" class="form-label">Numéro de conteneur</label>
            <input type="text" class="form-control" id="numero_conteneur" name="numero_conteneur" required>
          </div>
        </div>
        <div class="col-md">
          <div class="mb-3">
            <label for="charge" class="form-label">Charge</label>
            <select class="form-control" id="charge" name="charge" required>
              <option value="Vide">Vide</option>
              <option value="Plein">Plein</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="type" class="form-label">Type de conteneur</label>
            <select class="form-control" id="type" name="type" required>
              <option value="20">20 pieds</option>
              <option value="40">40 pieds</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="nombre_teus" class="form-label">Nombre de TEUs</label>
            <select class="form-control" id="nombre_teus" name="nombre_teus" required>
              <option value="20 pieds">20 pieds</option>
              <option value="40 pieds">40 pieds</option>
            </select>
          </div>
          <div class="form-group">
            <label for="date">Date :</label>
            <input type="date" id="date" name="date_operation" class="form-control" required>
          </div>
        </div>
        <div class="d-flex gap-2">
          <button type="submit" class="w-100 btn btn-primary btn-lg">Ajouter</button>
          <button type="reset" class="w-100 btn btn-secondary btn-lg">Effacer</button>
        </div>
      </form>
  </div>
</div>
<?= $this->endSection(); ?>