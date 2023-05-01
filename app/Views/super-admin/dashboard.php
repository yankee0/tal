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
  <div class="col-xl-3 col-md-6 mb-4">
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

  <!--Card Example -->
  <div class="col-xl-3 col-md-6 mb-4">
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
  <div class="col-xl-3 col-md-6 mb-4">
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
<div class="row">
  <!-- Pie Chart -->
  <div class="col-xl-6 col-lg-6">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Flux des opérations</h6>
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

  <!-- Area Chart -->
  <div class="col-xl-6 col-lg-6">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Alertes expiration (VT ASS CATS)</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body rap">

        <p class=" text-primary">Liste: </p>
        <ol>
          <?php foreach ($vt as $v) : ?>
            <?php
            $data = ($v['chrono_tracteur'] != null) ? $v['chrono_tracteur'] : $v['chrono_remorque'];
            ?>
            <li><a href="<?= base_url(session()->root) . '/tracteurs/' . $data ?>"><?= $v['type'] . ' - ' . $data ?></a> </li>
          <?php endforeach ?>
        </ol>
      </div>
    </div>
  </div>


  <!-- Area Chart -->
  <div class="col-xl-6 col-lg-6">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Classement mensuels chauffeurs</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body rap">

        <p class=" text-primary">Classement chauffeur: </p>
        <ol>
          <?php for ($i = 0; $i < sizeof($top4c); $i++) : ?>
            <li><?= $top4c[$i]['prenom'] . ' ' . $top4c[$i]['nom'] . ' - ' . $top4c[$i][0] . ' opération(s)' ?></li>
            <?php if ($i > 4) {
              $i = sizeof($top4c);
            } ?>
          <?php endfor; ?>
        </ol>
      </div>
    </div>
  </div>

  <div class="col-xl-6 col-lg-6">
    <div class="card shadow mb-4">
      <!-- Card Header - Dropdown -->
      <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <h6 class="m-0 font-weight-bold text-primary">Classement mensuels tracteurs</h6>
      </div>
      <!-- Card Body -->
      <div class="card-body rap">
        <p class=" text-primary">Classement tracteurs: </p>
        <ol>
          <?php for ($i = 0; $i < sizeof($top4t); $i++) : ?>
            <li><?= $top4t[$i]['chrono'] . ' - ' . $top4c[$i][0] . ' opération(s)' ?></li>
          <?php endfor; ?>
        </ol>
      </div>
    </div>
  </div>


</div>

<script>
  // données courbe 





  // données disque
  let compte = [<?= $count['liv'] ?>, <?= $count['trans'] ?>]
</script>
<?= $this->endSection(); ?>