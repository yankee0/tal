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
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-primary shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
              Nombre de chauffeurs</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">52</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-id-card fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-success shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
              Nombre de tracteurs</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">100</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-truck fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-warning shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
              Visites techniques</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">29</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-wrench fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-danger shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
              Assurrances</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">29</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-list fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
    <div class="card border-left-info shadow h-100 py-2">
      <div class="card-body">
        <div class="row no-gutters align-items-center">
          <div class="col mr-2">
            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
              C.A.T.s</div>
            <div class="h5 mb-0 font-weight-bold text-gray-800">29</div>
          </div>
          <div class="col-auto">
            <i class="fas fa-folder fa-2x text-gray-300"></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">

  <!-- Area Chart -->
  <div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Transferts et livraisons</h6>

      </div>
      <!-- Card Body -->
      <div class="card-body">
        <div class="chart-area">
          <canvas id="myAreaChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <!-- Pie Chart -->
  <div class="col-xl-4 col-lg-5">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Flux de l'entreprise</h6>

      </div>
      <!-- Card Body -->
      <div class="card-body">
        <div class="chart-pie pt-4 pb-2">
          <canvas id="myPieChart"></canvas>
        </div>
        <div class="mt-4 text-center small">
          <span class="mr-2">
            <i class="fas fa-circle text-primary"></i> Transferts
          </span>
          <span class="mr-2">
            <i class="fas fa-circle text-success"></i> Livraisons
          </span>

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
  let compte = [60,40]
</script>
<?= $this->endSection(); ?>