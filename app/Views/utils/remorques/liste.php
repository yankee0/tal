<?= $this->extend('layouts/interface'); ?>
<?= $this->section('titre'); ?>
Super Admin - Remorques - Liste
<?= $this->endSection(); ?>
<?= $this->section('contenu'); ?>

<h1 class="h3 mb-2 text-gray-800">remorques</h1>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Nouvelle remorque</h6>
  </div>
  <div class="card-body">
    <div class="container">

      <div class="row">
        <?php if (session()->has('success')) : ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            Ajout réussi!
          </div>
        <?php endif; ?>
        <?php if (session()->has('error')) : ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            Echec de l'ajout '! Vérifiez si les identifiants ne sont pas en doublon.
          </div>
        <?php endif; ?>
      </div>
      <form autocomplete="off" action="<?= base_url(session()->root . '/remorques/nouveau') ?>" method="post" id="formu" class="row">
        <?= csrf_field() ?>
        <div class="col-md-4">
          <div class="form-floating mb-3">
            <input value="<?= set_value('chrono') ?>" type="text" class="form-control" name="chrono" id="chrono" placeholder="chrono" required>
            <label for="chrono">Chrono</label>
          </div>
        </div>
        
        <div class="m-auto col-md-4 d-grid">
          <button form="formu" type="submit" class="btn mb-3 py-3  btn-primary">Ajouter</button>
        </div>
        <div class="m-auto col-md-4 d-grid">
          <button form="formu" type="reset" class="btn  mb-3 py-3 btn-secondary">Effacer</button>
        </div>

      </form>

    </div>
  </div>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Liste des remorques (Total: <?= count($remorques) ?>)</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="tableau" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Chrono</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($remorques as $r) : ?>
            <tr>
              <td><?= $r['chrono'] ?></td>
              <td class="d-flex">
                <button type="button" value="<?= $r['chrono'] ?>" class="del w-100 mx-1 btn btn-danger btn-sm" title="Supprimer"><i class="fa fa-trash" aria-hidden="true"></i></button>
              </td>
            </tr>

          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
  let table = new DataTable('#tableau');
  let r = null;
  $('.del').click(function(e) {
    e.preventDefault();
    let target = $(this).val()
    if (confirm('Supprimer le remorque chrono: ' + target)) {
      window.location = '<?= base_url(session()->root . '/remorques/supprimer/') ?>' + target
    }
  });
</script>
<?php if (session()->has('deleted')) : ?>
  <?php if (session()->deleted) : ?>
    <script>
      alert('Suppression réussie')
    </script>
  <?php else : ?>
    <script>
      alert('Echec de la supression')
    </script>
  <?php endif ?>
<?php endif ?>

<?= $this->endSection(); ?>