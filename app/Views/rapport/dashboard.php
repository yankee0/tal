<?= $this->extend('layouts/interface'); ?>
<?= $this->section('titre'); ?>
Rapports
<?= $this->endSection(); ?>
<?= $this->section('contenu'); ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Rapports</h1>
</div>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Rapports</h6>
  </div>
  <div class="card-body">
    <form action="<?=base_url('AllahIsOne/rapports')?>" method="post">
      <div class="mb-3">
        <label for="report-type" class="form-label">Type de rapport :</label>
        <select id="report-type" name="type" class="form-select" required>
          <option value="" selected disabled hidden>Choisir un type de rapport...</option>
          <option value="livraison">Livraison</option>
          <option value="transfert">Transfert</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="month"  class="form-label">Mois :</label>
        <select id="month" name="m" class="form-select" required>
          <option value="" selected disabled hidden>Choisir un mois...</option>
          <option value="01">Janvier</option>
          <option value="02">Février</option>
          <option value="03">Mars</option>
          <option value="04">Avril</option>
          <option value="05">Mai</option>
          <option value="06">Juin</option>
          <option value="07">Juillet</option>
          <option value="08">Août</option>
          <option value="09">Septembre</option>
          <option value="10">Octobre</option>
          <option value="11">Novembre</option>
          <option value="12">Décembre</option>
        </select>
      </div>
      <div class="mb-3">
        <label for="year" class="form-label">Année :</label>
        <input type="number" name="y" id="year" class="form-control" min="2000" max="2100" required>
      </div>
      <button type="submit" class="btn btn-primary">Générer le rapport</button>
    </form>

  </div>


  <?= $this->endSection(); ?>