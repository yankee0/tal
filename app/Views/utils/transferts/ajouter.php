<?= $this->extend('layouts/interface'); ?>
<?= $this->section('titre'); ?>
Super Admin
<?= $this->endSection(); ?>
<?= $this->section('contenu'); ?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Transfert</h1>
</div>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Nouveau transfert</h6>

  </div>
  <div class="card-body">
    <form action="<?= base_url(session()->root . '/transfert/ajouter') ?>" class="row" method="post">
      <div class="col-md">
        <div class="mb-3">
          <label for="type_transfert" class="form-label">Type de transfert</label>
          <select class="form-select " name="type_transfert" id="type_transfert">
            <option selected>Selectionner</option>
            <option value="FULL IMPORT">FULL IMPORT</option>
            <option value="FULL EXPORT">FULL EXPORT</option>
            <option value="VIDE">VIDE</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="date_mvt" class="form-label">Date MVT</label>
          <input type="date" class="form-control" name="date_mvt" id="date_mvt" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="conteneur" class="form-label">Conteneur</label>
          <input type="text" class="form-control" name="conteneur" required id="conteneur" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="type_conteneur" class="form-label">Type conteneur</label>
          <select class="form-select " name="type_conteneur" id="type_conteneur">
            <option value="20 DV">20 DV</option>
            <option value="40 DV">40 DV</option>
            <option value="40 HC">40 HC</option>
            <option value="40 RF">40 RF</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="teus" class="form-label">TEUS</label>
          <input type="text" class="form-control" name="teus" id="teus" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="ligne" class="form-label">Ligne</label>
          <input type="text" class="form-control" name="ligne" id="ligne" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="rame" class="form-label">Rame</label>
          <input type="text" class="form-control" name="rame" id="rame" aria-describedby="helpId" placeholder="">
        </div>
      </div>
      <div class="col-md">
        <div class="mb-3">
          <label for="mouvement" class="form-label">Mouvement</label>
          <input type="text" class="form-control" name="mouvement" id="mouvement" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="p_v" class="form-label">P/V</label>
          <input type="text" class="form-control" name="p_v" id="p_v" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="chauffeur" class="form-label">Chauffeur</label>
          <div class="form-check">
            <input onclick="$('.tal').fadeIn();$('.tra').fadeOut()" class="form-check-input" type="radio" value="tal" name="choixch" id="tal">
            <label onclick="$('.tal').fadeIn();$('.tra').fadeOut()" class="form-check-label" for="tal">
              Chauffeur TAL
            </label>
          </div>
          <div class="form-check">
            <input onclick="$('.tra').fadeIn();$('.tal').fadeOut()" class="form-check-input" type="radio" value="tra" name="choixch" id="st" checked >
            <label onclick="$('.tra').fadeIn();$('.tal').fadeOut()" class="form-check-label" for="st">
              Sous traitant
            </label>
          </div>
          <select style="display: none;" class="form-select form-select-lg tal" name="cht" id="chauffeur_aller">
            <?php foreach ($chauf as $c) : ?>
              <option value="<?= $c['matricule'] ?>"><?= $c['matricule'] . ' - ' . $c['prenom'] . ' ' . $c['nom'] ?></option>
            <?php endforeach ?>
          </select>
          <input type="text" class="form-control tra" name="chs" id="chauffeur" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="imm_tracteur" class="form-label">Immatriculation tracteur</label>
          <input type="text" class="form-control" name="imm_tracteur" id="imm_tracteur" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="chrono" class="form-label">Chrono</label>
          <input type="text" class="form-control" name="chrono" id="chrono" aria-describedby="helpId" placeholder="">
        </div>
        <div class="mb-3">
          <label for="eirs" class="form-label">EIRS</label>
          <select class="form-select " name="eirs" id="eirs">
            <option value="NON OK">NON OK</option>
            <option value="OK">OK</option>
          </select>
        </div>

        <div class="mb-3">
          <label for="remarque_sous_traitant" class="form-label">Remarque sous traitant</label>
          <input type="text"
            class="form-control" name="remarque_sous_traitant" id="remarque_sous_traitant" aria-describedby="helpId" placeholder="">
        </div>

      </div>
      <div class="col-12 d-grid d-md-block text-center">
        <button type="submit" class="btn btn-primary btn-lg">Ajouter</button>
      </div>
    </form>
  </div>
</div>

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