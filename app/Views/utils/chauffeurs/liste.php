<?= $this->extend('layouts/interface'); ?>
<?= $this->section('titre'); ?>
Super Admin - Chauffeurs - Liste
<?= $this->endSection(); ?>
<?= $this->section('contenu'); ?>

<h1 class="h3 mb-2 text-gray-800">Chauffeurs</h1>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Nouveau chauffeur</h6>
  </div>
  <div class="card-body">
    <div class="container">

      <div class="row">
        <?php if (session()->has('success')) : ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            Ajout réussi!
          </div>
        <?php endif ;?>
        <?php if (session()->has('error')) : ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            Echec de l'ajout '! Vérifiez si le matricule n'est pas en doublon.
          </div>
        <?php endif ;?>
      </div>
      <form autocomplete="off" action="<?= base_url(session()->root . '/chauffeurs/nouveau') ?>" method="post" id="formu" class="row">
        <?=csrf_field()?>
        <div class="col-md">
          <div class="form-floating mb-3">
            <input value="<?= set_value('matricule') ?>" type="text" class="form-control" name="matricule" id="matricule" placeholder="Matricule" required>
            <label for="matricule">Matricule</label>
          </div>
        </div>
        <div class="col-md">
          <div class="form-floating mb-3">
            <input value="<?= set_value('prenom') ?>" type="text" class="form-control" name="prenom" id="prenom" placeholder="prenom" required>
            <label for="prenom">Prénom</label>
          </div>
        </div>
        <div class="col-md">
          <div  class="form-floating mb-3">
            <input value="<?= set_value('nom') ?>" type="text" class="form-control" name="nom" id="nom" placeholder="nom" required>
            <label for="nom">Nom</label>
          </div>
        </div>
      </form>
      <div class="row">
        <div class="m-auto col-md-4 d-grid">
          <button form="formu" type="submit" class="btn mb-3 py-3  btn-primary">Ajouter</button>
        </div>
        <div class="m-auto col-md-4 d-grid">
          <button form="formu" type="reset" class="btn  mb-3 py-3 btn-secondary">Effacer</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Liste des chauffeurs (Total: <?= count($chauffeurs) ?>)</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="tableau" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Matricule</th>
            <th>Prenom</th>
            <th>Nom</th>
            <th>Actions</th>

          </tr>
        </thead>
        <tbody>
          <?php foreach ($chauffeurs as $c) : ?>
              <tr>
                <td><?= $c['matricule'] ?></td>
                <td><?= $c['prenom'] ?></td>
                <td><?= $c['nom'] ?></td>
                <td class="d-flex">
                  <button type="button" value="<?=$c['matricule']?>" class="del w-100 mx-1 btn btn-danger btn-sm" title="Supprimer"><i class="fa fa-trash" aria-hidden="true"></i></button>
                  <button type="button" value="<?=$c['matricule']?>" class="btn w-100 mx-1 btn-primary btn-sm" title="Réinitialiser le mot de passe"><i class="fa fa-lock" aria-hidden="true"></i></button>
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
  $('.del').click(function (e) { 
    e.preventDefault();
    let target = $(this).val()
    if(confirm('Supprimer le chauffeur matricule: '+ target)){
      window.location = '<?=base_url(session()->root.'/chauffeurs/supprimer/')?>'+target
    }
  });

</script>
<?php if (session()->has('deleted')) : ?>
  <?php if (session()->deleted) : ?>
    <script>alert('Suppression réussie')</script>
  <?php else : ?>
    <script>alert('Echec de la supression')</script>
  <?php endif ?>
<?php endif ?>

<?= $this->endSection(); ?>