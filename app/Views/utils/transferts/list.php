<?= $this->extend('layouts/interface'); ?>
<?= $this->section('titre'); ?>
Super Admin
<?= $this->endSection(); ?>
<?= $this->section('contenu'); ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Livraisons</h1>
</div>


<div class="card">
  <div class="card-header">
    <div class="span text-primary">Opérations (<?= sizeof($trans) ?>)</div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      
      <div class="d-flex justify-content-between mb-3">
        <h4>Récapitulatif</h4>
        <a class="btn btn-success btn-sm " href="<?= base_url(session()->root . '/gen/transfert') ?>" role="button">Rapport mensuel</a>
      </div>

      <table class="table table-bordered" id="tableau2" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Tranfert</th>
            <th>Date MVT</th>
            <th>Conteneur</th>
            <th>Type conteneur</th>
            <th>TEUS</th>
            <th>Ligne</th>
            <th>Rame</th>
            <th>Mouvement</th>
            <th>p/v</th>
            <th>Chauffeur/Prestataire</th>
            <th>Imm. Tract.</th>
            <th>Chrono</th>
            <th>EIRS</th>
            <th>Remarque</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($trans as $t) : ?>
            <tr>
              <td><?= $t['type_transfert'] ?></td>
              <td><?= $t['date_mvt'] ?></td>
              <td><?= $t['conteneur'] ?></td>
              <td><?= $t['type_conteneur'] ?></td>
              <td><?= $t['teus'] ?></td>
              <td><?= $t['ligne'] ?></td>
              <td><?= $t['rame'] ?></td>
              <td><?= $t['mouvement'] ?></td>
              <td><?= $t['p_v'] ?></td>
              <td><?= $t['chauffeur'] ?></td>
              <td><?= $t['imm_tracteur'] ?></td>
              <td><?= $t['chrono'] ?></td>
              <td><?= $t['eirs'] ?></td>
              <td><?= $t['remarque_sous_traitant'] ?></td>
              <td class="d-grid gap-2">
                <button class="btn btn-danger btn-sm delt" value="<?= $t['conteneur'] ?>" href="#" role="button">supprimer</button>
              </td>
            </tr>
          <?php endforeach; ?>

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
  $('#tableau2').DataTable({
    'pageLength': -1
  });

  $('.del').click(function(e) {
    e.preventDefault();
    let target = $(this).val()
    if (confirm('Supprimer la livraison du conteneur: ' + target)) {
      window.location = '<?= base_url(session()->root . '/livraisons/supprimer/') ?>' + target
    }
  });

  $('.delt').click(function(e) {
    e.preventDefault();
    let target = $(this).val()
    if (confirm('Supprimer le transfert du conteneur: ' + target)) {
      window.location = '<?= base_url(session()->root . '/transfert/supprimer/') ?>' + target
    }
  });
</script>
<?php if (session()->has('delete')) : ?>
  <?php if (session()->delete) : ?>
    <script>
      alert('suppression effectuée');
    </script>
  <?php else : ?>
    <script>
      alert('Erreur');
    </script>
  <?php endif ?>
<?php endif ?>

<?= $this->endSection(); ?>