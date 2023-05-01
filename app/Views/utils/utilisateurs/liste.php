<?= $this->extend('layouts/interface'); ?>
<?= $this->section('titre'); ?>
Super Admin - Utilisateurs - Liste
<?= $this->endSection(); ?>
<?= $this->section('contenu'); ?>

<h1 class="h3 mb-2 text-gray-800">Utilisateurs</h1>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Nouvel utilisateur</h6>
  </div>
  <div class="card-body">
    <div class="container">
      <div class="row">
        <div class="alert alert-info" role="alert">
          Tout compte nouvellement créé ou réinitialisé aura pour mot de passe par défaut "TALSA1234". L'utilisateur pourra le modifier après sa première connexion.
        </div>
      </div>
      <div class="row">
        <?php if (session()->has('success')) : ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            Création du compte réussie!
          </div>
        <?php endif ;?>
        <?php if (session()->has('error')) : ?>
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            Echec de la création du compte! Vérifiez si le matricule n'est pas en doublon.
          </div>
        <?php endif ;?>
      </div>
      <form autocomplete="off" action="<?= base_url(session()->root . '/utilisateurs/nouveau') ?>" method="post" id="formu" class="row">
        <div class="col-md">
          <?=csrf_field()?>
          <div class="form-floating">
            <select class="form-select mb-3" id="profil" name="profil" aria-label="Profil">
              <?php if (session()->root == '/super-admin') : ?>
                <option <?= set_select('profil') ?> value="SUPER ADMIN">SUPER ADMIN</option>
                <option <?= set_select('profil') ?> value="ADMIN">ADMIN</option>
              <?php endif; ?>
              <option <?= set_select('profil') ?> value="OPS">OPS</option>
              <option <?= set_select('profil') ?> value="FACTURATION">FACTURATION</option>
            </select>
            <label for="profil">Sélectionner un profil</label>
          </div>
        </div>
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
          <button form="formu" type="submit" class="btn mb-3 py-3  btn-primary">Créer le compte</button>
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
    <h6 class="m-0 font-weight-bold text-primary">Liste des utilisateurs (Total: <?= count($utilisateurs) ?>)</h6>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="tableau" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Matricule</th>
            <th>profil</th>
            <th>Prenom</th>
            <th>Nom</th>
            <th>Actions</th>

          </tr>
        </thead>
        <tbody>
          <?php foreach ($utilisateurs as $u) : ?>
            <?php if (session()->root == '/super-admin') : ?>
              <tr>
                <td><?= $u['matricule'] ?></td>
                <td><?= $u['profil'] ?></td>
                <td><?= $u['prenom'] ?></td>
                <td><?= $u['nom'] ?></td>
                <td class="d-flex">
                  <button type="button" value="<?=$u['matricule']?>" class="del w-100 mx-1 btn btn-danger btn-sm" title="Supprimer"><i class="fa fa-trash" aria-hidden="true"></i></button>
                  <button type="button" value="<?=$u['matricule']?>" class="res btn w-100 mx-1 btn-primary btn-sm" title="Réinitialiser le mot de passe"><i class="fa fa-lock" aria-hidden="true"></i></button>
                </td>
              </tr>
            <?php else : ?>
              <?php if ($u['profil'] != 'ADMIN' and $u['profil'] != 'SUPER ADMIN') : ?>
                <tr>
                  <td><?= $u['matricule'] ?></td>
                  <td><?= $u['profil'] ?></td>
                  <td><?= $u['prenom'] ?></td>
                  <td><?= $u['nom'] ?></td>
                  <td class="d-flex align-items-center justify-content-around">
                    <button type="button" class="btn px-1 btn-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
                    <button type="button" class="btn px-1 btn-warning btn-sm"><i class="fa fa-edit" aria-hidden="true"></i></button>
                    <button type="button" class="btn px-1 btn-primary btn-sm"><i class="fa fa-lock" aria-hidden="true"></i></button>
                  </td>
                </tr>
              <?php endif ?>
            <?php endif ?>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<script>
  // let table = new DataTable('#tableau');
  $('#tableau').DataTable(
    {
      'pageLength' : -1
    }
  );

  $('.del').click(function (e) { 
    e.preventDefault();
    let target = $(this).val()
    if(confirm('Supprimer l\'utilisateur matricule: '+ target)){
      window.location = '<?=base_url(session()->root.'/utilisateurs/supprimer/')?>'+target
    }
  });

  $('.res').click(function (e) { 
    e.preventDefault();
    let target = $(this).val()
    if(confirm('Confirmer la réinitialisation du mot de passe du compte matricule: '+ target)){
      window.location = '<?=base_url(session()->root.'/utilisateurs/reset/')?>'+target
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

<?php if (session()->has('updated')) : ?>
  <?php if (session()->updated) : ?>
    <script>alert('Réinitialisation réussie')</script>
  <?php else : ?>
    <script>alert('Echec de la réinitialisation')</script>
  <?php endif ?>
<?php endif ?>

<?= $this->endSection(); ?>