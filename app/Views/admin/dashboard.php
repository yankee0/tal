<?= $this->extend('layouts/interface'); ?>
<?= $this->section('titre'); ?>
Super Admin - Dashboard
<?= $this->endSection(); ?>
<?= $this->section('contenu'); ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>
<div class="row">
  <!--Card Example -->
  <div class=" col-md mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
              Nombre d'utilisateurs</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $utilisateurs ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--Card Example -->
  <div class=" col-md mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
              Nombre de chauffeurs</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $chauffeurs ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<div class="row">
  <!--Card Example -->
  <div class=" col-md mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Nombre de tracteurs</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $tracteurs ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-truck fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--Card Example -->
  <div class=" col-md mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
              Nombre de remorques</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $remorques ?></div>
          </div>
          <div class="col-auto">
            <i class="fas fa-truck fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>


<script>
  // données courbe 
  let transferts = [12, 12, 93, 46, 17, 102, 8, 98, 67, 97, 68];
  let livraisons = [2, 6, 100, 24, 12, 119, 58, 18, 77, 17, 38];

  // données disque
  let compte = [60, 40]
</script>
<?= $this->endSection(); ?>