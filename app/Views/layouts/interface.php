<?php
switch (session()->donnees_utilisateur['profil']) {

  case 'SUPER ADMIN':
    $root  = '/super-admin';
    break;

  case 'ADMIN':
    $root  = '/admin';
    break;

  case 'OPS':
    $root  = '/ops';
    break;


  default:
    $root = null;
    break;
}
session()->root = $root;

?>
<!DOCTYPE html>
<html lang="fr">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>TAL SA - <?= $this->renderSection('titre'); ?></title>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <link rel="shortcut icon" href="<?= base_url('img/tal.png') ?>" type="image/x-icon">
  <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="<?= base_url('vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="<?= base_url('css/sb-admin-2.min.css') ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('css/css.css') ?>">
  <!-- <link rel="stylesheet" href="<?= base_url('css/table.css') ?>"> -->


</head>

<body id="page-top" class="sidebar-toggled">

  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url($root) ?>">
        <img src="<?= base_url('img/tal.png') ?>" alt="" height="54px">
      </a>


      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?= (session()->has('position') and session()->position == 'dashboard') ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url($root) ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider" />
      <?php if ($root == '/super-admin' or $root == '/admin') : ?>
        <!-- Heading -->
        <div class="sidebar-heading">Ressources</div>

        <!-- Nav Items - utilisateurs -->
        <li class="nav-item <?= (session()->has('position') and session()->position == 'utilisateurs') ? 'active' : '' ?>">
          <a class="nav-link" href="<?= base_url($root . '/utilisateurs') ?>">
            <i class="fas fa-fw fa-user"></i>
            <span>Utilisateurs</span></a>
        </li>

        <!-- Nav Items - chauffeurs -->
        <li class="nav-item <?= (session()->has('position') and session()->position == 'chauffeurs') ? 'active' : '' ?>">
          <a class="nav-link" href="<?= base_url($root . '/chauffeurs') ?>">
            <i class="fas fa-fw fa-user-tie"></i>
            <span>Chauffeurs</span></a>
        </li>

        <!-- Nav Items - tracteurs -->
        <li class="nav-item <?= (session()->has('position') and session()->position == 'tracteurs') ? 'active' : '' ?>">
          <a class="nav-link" href="<?= base_url($root . '/tracteurs') ?>">
            <i class="fas fa-fw fa-truck"></i>
            <span>Tracteurs</span></a>
        </li>

        <!-- Nav Items - remorques -->
        <li class="nav-item <?= (session()->has('position') and session()->position == 'remorques') ? 'active' : '' ?>">
          <a class="nav-link" href="<?= base_url($root . '/remorques') ?>">
            <i class="fas fa-fw fa-trailer"></i>
            <span>Remorques</span></a>
        </li>

      <?php endif ?>


      <?php if ($root != '/admin') : ?>
        <!-- Heading -->
        <div class="sidebar-heading">Opérations</div>

        <!-- Nav Item - Livraisons -->
        <li class="nav-item <?= (session()->has('position') and session()->position == 'livraisons') ? 'active' : '' ?>">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-truck-loading"></i>
            <span>Livraisons</span>
          </a>
          <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <?php if ($root == '/super-admin' or $root == '/admin') : ?>
                <a class="collapse-item" href="<?= base_url($root . '/livraisons') ?>">Lister</a>
              <?php else : ?>
                <a class="collapse-item" href="<?=base_url($root.'/livraisons/innacheves')?>">Livraisons innachevées</a>
                <a class="collapse-item" href="<?= base_url($root . '/livraisons') ?>">Nouvelle livraison</a>
              <?php endif; ?>
            </div>
          </div>
        </li>

        <!-- Nav Item - Transferts -->
        <li class="nav-item <?= (session()->has('position') and session()->position == 'transferts') ? 'active' : '' ?>">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="true" aria-controls="collapsePages2">
            <i class="fas fa-fw fa-truck-moving"></i>
            <span>Transferts</span>
          </a>
          <div id="collapsePages2" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
              <?php if ($root == '/super-admin' or $root == '/admin') : ?>

                <a class="collapse-item" href="<?=base_url($root.'/transferts')?>">Lister</a>

              <?php else : ?>
                <a class="collapse-item" href="<?= base_url($root . '/transfert') ?>">Nouveau transfert</a>
              <?php endif; ?>

            </div>
          </div>
        </li>
      <?php endif ?>
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block" />

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>


          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <?php if ($root == '/super-admin' or $root == '/admin') : ?>
              <!-- Nav Item - Alerts -->
              <li class="nav-item dropdown no-arrow mx-1">
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                  <h6 class="dropdown-header">Centre d'alerts</h6>
                  <a class="dropdown-item d-flex align-items-center" href="#">
                    <div class="mr-3">
                      <div class="icon-circle bg-primary">
                        <i class="fas fa-file-alt text-white"></i>
                      </div>
                    </div>
                    <div>
                      <div class="small text-gray-500">Titre de l'alerte</div>
                      <span class="font-weight-bold">Une description mini de l'alert</span>
                    </div>
                  </a>

                  <a class="dropdown-item text-center small text-gray-500" href="#">Afficher toutes les alertes</a>
                </div>
              </li>
              <div class="topbar-divider d-none d-sm-block"></div>
            <?php endif; ?>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= session()->donnees_utilisateur['prenom'] . ' ' . session()->donnees_utilisateur['nom'] ?></span>
                <img class="img-profile rounded-circle" src="<?= base_url('img/profil.png') ?>" />
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <div class="dropdown-item">
                  Profil: <span class="text-primary"><?= session()->donnees_utilisateur['profil'] ?></span>
                </div>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                  Modifier le mot de passe
                </a>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Se déconnecter
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">




          <?= $this->renderSection('contenu'); ?>



        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>©2023 TAL SA </span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->





  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Déconnexion</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Appuyez sur "Se déconnecter" pour fermer la session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Retour</button>
          <a class="btn btn-primary" href="<?= base_url($root . '/deconnexion') ?>">Se déconnecter</a>
        </div>
      </div>
    </div>
  </div>
  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  <!-- Bootstrap core JavaScript-->
  <script src="<?= base_url('vendor/jquery/jquery.min.js') ?>"></script>
  <script src="<?= base_url('vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?= base_url('vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?= base_url('js/sb-admin-2.min.js') ?>"></script>




  <!-- Page level plugins -->
  <script src="<?= base_url('vendor/chart.js/Chart.min.js') ?>"></script>
  <!-- Page level custom scripts -->
  <script src="<?= base_url('js/demo/chart-area-demo.js') ?>"></script>
  <script src="<?= base_url('js/demo/chart-pie-demo.js') ?>"></script>

</body>

</html>