<?= $this->extend('layouts/interface'); ?>
<?= $this->section('titre'); ?>
OPS - Livraisons innachevé
<?= $this->endSection(); ?>
<?= $this->section('contenu'); ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Livraisons innachevés</h1>
</div>


<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Livraisons innachevées (<span class="text-primary"><?= sizeof($liv) ?></span>)</h6>
  </div>
  <div class="card-body">
    <div class="container">
      <div class="table-responsive">
        <table class="table table-bordered" id="tableau" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Client</th>
              <th>Type</th>
              <th>Conteneur</th>
              <th>Date aller</th>
              <th>Chauffeur aller</th>
              <th>Tracteur aller</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($liv as $l) : ?>
              <tr>
                <td><?= $l['client'] ?></td>
                <td><?= $l['type_tc'] ?></td>
                <td><?= $l['conteneur'] ?></td>
                <td><?= $l['date_livraison'] ?></td>
                <td><?= $l['chauffeur_aller'] ?></td>
                <td><?= $l['camion'] ?></td>
                <td class="d-grid gap-2">
                  <button type="button" value="<?= $l['id'] ?>" class="btn exp btn-sm btn-primary" data-toggle="modal" data-target="#mod">Complèter</button>
                  <button type="button" value="<?= $l['conteneur'] ?>" class="btn btn-sm btn-danger del">supprimer</button>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
  <div class="modal fade" id="mod" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="mod" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modLabel">Complément d'informations</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formLiv" method="post" action="<?= base_url(session()->root . '/livraisons/complement') ?>">
            <div class="form-floating mb-3">
              <input type="datetime-local" class="form-control" name="date_retour" id="date_retour" placeholder="date_retour">
              <label for="date_retour">Date retour</label>
            </div>
            <div class="form-floating mb-3">
              <select name="chauffeur_retour" class="form-select" id="floatingSe" aria-label="Fle">
                <?php foreach ($chauf as $c) : ?>
                  <option value="<?= $c['matricule'] ?>"><?= $c['matricule'] . ' - ' . $c['prenom'] . ' ' . $c['nom'] ?></option>
                <?php endforeach ?>
              </select>
              <label for="floatingSe">Chauffeur</label>
            </div>
            <div class="form-floating mb-3">
              <input type="text" class="form-control" name="mvt_retour" id="mvt_retour" placeholder="mvt">
              <label for="mvt_retour">MVT retour</label>
            </div>

            <div class="d-grid">
              <button type="submit" id="expComp" name="id" value="" class="btn btn-primary">Enregistrer</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $('#tableau').DataTable({
    'pageLength': -1
  });
  $('.exp').click(function(e) {
    e.preventDefault();
    $('#expComp').val($(this).val());
  });

  $('.del').click(function (e) { 
    e.preventDefault();
    let target = $(this).val()
    if(confirm('Supprimer la livraison du conteneur: '+ target)){
      window.location = '<?=base_url(session()->root.'/livraisons/supprimer/')?>'+target
    }
  });

</script>
<?php if (session()->has('modif')) : ?>
  <?php if (session()->modif) : ?>
    <script>
      alert('modification effectuée');
    </script>
  <?php else : ?>
    <script>
      alert('Erreur');
    </script>
  <?php endif ?>
<?php endif ?>
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