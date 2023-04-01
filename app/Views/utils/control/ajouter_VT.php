<?= $this->extend('layouts/interface'); ?>
<?= $this->section('titre'); ?>
Super Admin - Tracteurs - <?= $chrono ?>
<?= $this->endSection(); ?>
<?= $this->section('contenu'); ?>

<h1 class="h3 mb-2 text-gray-800"><?= $chrono ?></h1>
<div class="row">
<div class="col-md-6">

  <div class=" card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Visite technique</h6>
    </div>
    <form class="card-body row" action="<?=base_url(session()->root.'/ajouter_VT')?>">
      <div class="col-md form-floating mb-3">
        <input
          type="date"
          class="form-control" name="debut" id="debut" placeholder="debut">
        <label for="debut">Début</label>
      </div>
      <div class="col-md form-floating mb-3">
        <input
          type="date"
          class="form-control" name="fin" id="fin" placeholder="fin">
        <label for="fin">Début</label>
      </div>
      <div class="col-md d-flex align-items-center">
        <button type="submit" name="chrono_tracteur" value="<?=$chrono?>" class="btn btn-primary w-100">Enregistrer</button>
      </div>
    </form>
  </div>
</div>
</div>




<?= $this->endSection(); ?>