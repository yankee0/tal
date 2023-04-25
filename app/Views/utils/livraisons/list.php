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
    <div class="span text-primary">opérations (<?= sizeof($liv)?>)</div>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <div class="d-flex justify-content-between mb-3">
        <h4>Récapitulatif</h4>
        <a class="btn btn-success btn-sm " href="<?=base_url(session()->root.'/gen/livraison')?>" role="button"> Rapport mensuel</a>
      </div>
      <table class="table table-bordered" id="tableau" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Date dépot BL</th>
            <th>Date livraison</th>
            <th>Conteneur</th>
            <th>Armateur</th>
            <th>type TC</th>
            <th>Camion</th>
            <th>Chauffeur aller</th>
            <th>MVT aller</th>
            <th>Adresse</th>
            <th>Zone</th>
            <th>Client</th>
            <th>Date retour</th>
            <th>Chaffeur retour</th>
            <th>MVT retour</th>
            <th>Date validité</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($liv as $l) : ?>
            <tr>
              <td><?= $l['date_depot_bl'] ?></td>
              <td><?= $l['date_livraison'] ?></td>
              <td><?= $l['conteneur'] ?></td>
              <td><?= $l['armateur'] ?></td>
              <td><?= $l['type_tc'] ?></td>
              <td><?= $l['camion'] ?></td>
              <td><?= $l['chauffeur_aller'] ?></td>
              <td><?= $l['mvt_aller'] ?></td>
              <td><?= $l['adresse'] ?></td>
              <td><?= $l['zone'] ?></td>
              <td><?= $l['client'] ?></td>
              <td><?= $l['date_retour'] ?></td>
              <td><?= $l['chauffeur_retour'] ?></td>
              <td><?= $l['mvt_retour'] ?></td>
              <td><?= $l['date_validite'] ?></td>
              <td class="d-grid gap-2">
                <button class="btn btn-danger btn-sm del" value="<?= $l['conteneur'] ?>" href="#" role="button">supprimer</button>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
      <div class="my-3"></div>
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