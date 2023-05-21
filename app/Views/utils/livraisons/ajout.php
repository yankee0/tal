<?= $this->extend('layouts/interface'); ?>
<?= $this->section('titre'); ?>
OPS - Livraisons ajout
<?= $this->endSection(); ?>
<?= $this->section('contenu'); ?>
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Livraisons</h1>
</div>


<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Nouvelle livraison</h6>
  </div>
  <div class="card-body">
    <form action="<?= base_url(session()->root . '/livraisons/ajout') ?>" method="post" class="row">
      <div class="col-md">
        <div class="mb-3">
          <label for="date_depot_bl" class="form-label">Date de BL</label>
          <input type="datetime-local" class="form-control" name="date_depot_bl" id="date_depot_bl" aria-describedby="helpId" >
        </div>
        <div class="mb-3">
          <label for="date_validite" class="form-label">Date de validité</label>
          <input type="datetime-local" class="form-control" name="date_validite" id="date_validite" aria-describedby="helpId" >
        </div>
        <div class="mb-3">
          <label for="date_livraison" class="form-label">Date de livraison</label>
          <input type="datetime-local" class="form-control" name="date_livraison" id="date_livraison" aria-describedby="helpId" >
        </div>
        <div class="mb-3">
          <label for="conteneur" class="form-label">Conteneur</label>
          <input type="text" maxlength="11" minlength="11" class="form-control" name="conteneur" required id="conteneur" aria-describedby="helpId" >
        </div>
        <div class="mb-3">
          <label for="armateur" class="form-label">Armateur</label>
          <input type="text" class="form-control" name="armateur" id="armateur" aria-describedby="helpId" >
        </div>
      </div>
      <div class="col-md">
        <div class="mb-3">
          <label for="type_tc" class="form-label">Type TC</label>
          <select class="form-select" name="type_tc" id="type_tc">
            <option hidden>Sélectionnez le type</option>
            <option value="20">20'</option>
            <option value="40">40'</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="camion" class="form-label">Camion</label>
          <select class="form-select form-select-lg" name="camion" id="camion">
            <?php foreach ($trac as $t) : ?>
              <option value="<?= $t['chrono'] ?>"><?= $t['immatriculation'] . ' / ' . $t['chrono'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="chauffeur_aller" class="form-label">chauffeur aller</label>
          <select class="form-select form-select-lg" name="chauffeur_aller" id="chauffeur_aller">
            <?php foreach ($chauf as $c) : ?>
              <option value="<?= $c['matricule'] ?>"><?= $c['matricule'] . ' - ' . $c['prenom'] . ' ' . $c['nom'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="mvt_aller" class="form-label">MVT aller</label>
          <input type="text" class="form-control" name="mvt_aller" id="mvt_aller" aria-describedby="helpId" >
        </div>
        <div class="mb-3">
          <label for="adresse" class="form-label">Adresse</label>
          <input type="text" class="form-control" name="adresse" id="adresse" aria-describedby="helpId" >
        </div>

      </div>
      <div class="col-md">
        <div class="mb-3">
          <label for="zone" class="form-label">Zone</label>
          <input type="text" class="form-control" name="zone" id="zone" aria-describedby="helpId" >
        </div>
        <div class="mb-3">
          <label for="client" class="form-label">Client</label>
          <input type="text" class="form-control" name="client" id="client" aria-describedby="helpId" >
        </div>
        <p>Rajouter les information du retours?</p>
        <div class="form-check">
          <input onclick="$('.retour').fadeIn()" class="form-check-input" type="radio" name="choix" value="oui" id="oui">
          <label onclick="$('.retour').fadeIn()" class="form-check-label" for="oui">
            Oui
          </label>
        </div>
        <div class="form-check">
          <input onclick="$('.retour').fadeOut()" class="form-check-input" type="radio" name="choix" value="non" id="non" checked>
          <label onclick="$('.retour').fadeOut()" class="form-check-label" for="non">
            Non
          </label>
        </div>
        <div class="retour" style="display: none">

          <div class="mb-3">
            <label for="date_retour" class="form-label">Date de retour</label>
            <input type="datetime-local" class="form-control" name="date_retour" id="date_retour" aria-describedby="helpId" >
          </div>
          <div class="mb-3">
            <label for="chauffeur_retour" class="form-label">chauffeur retour</label>
            <select class="form-select form-select-lg" name="chauffeur_retour" id="chauffeur_retour">
              <?php foreach ($chauf as $c) : ?>
                <option value="<?= $c['matricule'] ?>"><?= $c['matricule'] . ' - ' . $c['prenom'] . ' ' . $c['nom'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="mvt_retour" class="form-label">MVT retour</label>
            <input type="text" class="form-control" name="mvt_retour" id="mvt_retour" aria-describedby="helpId" >
          </div>
        </div>

      </div>
      <div class="col-12 text-center d-grid d-md-block">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
      </div>
    </form>
  </div>
</div>
<script>
  $('#tableau').DataTable({
    'pageLength': -1
  });
</script>

<?php if (session()->has('ajout')) : ?>
  <?php if (session()->ajout) : ?>
    <script>
      alert('ajout effectué');
    </script>
  <?php else : ?>
    <script>
      alert('Erreur');
    </script>
  <?php endif ?>
<?php endif ?>

<?= $this->endSection(); ?>