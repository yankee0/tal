<?= $this->extend('layouts/interface'); ?>
<?= $this->section('titre'); ?>
OPS - Dashboard
<?= $this->endSection(); ?>
<?= $this->section('contenu'); ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
  <button type="button" class="btn btn-sm btn-success">Télécharger un rapport</button>
</div>


<div class="card">
  <div class="card-header">
    <div class="span text-primary">Mes opérations ()</div>
  </div>
  <div class="card-body">
    <h4>Récap de la semaine</h4>
    <div class="table-responsive">
      <table class="table table-bordered" id="tableau" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>code </th>
            <th>Immatriculatio</th>
            <th>Ancienne immatriculation</th>
            <th>Marque</th>
            <th>CAT</th>
            <th>Au rebut</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>Chrono</th>
            <th>Immatriculation</th>
            <th>Ancienne immatriculation</th>
            <th>Marque</th>
            <th>CAT</th>
            <th>Au rebut</th>
            <th>Action</th>
          </tr>
        </tbody>
      </table>
    </div>
  </div>


</div>
<div class="row">



</div>
<script>
  $('#tableau').DataTable({
    'pageLength': -1
  });
</script>

<?= $this->endSection(); ?>