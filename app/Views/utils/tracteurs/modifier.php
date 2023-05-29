<?= $this->extend('layouts/interface') ;?>
<?= $this->section('titre') ;?>
Modification - <?= $tracteur['chrono'] ?>
<?= $this->endSection() ;?>
<?= $this->section('contenu') ;?>
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Modification <?= $tracteur['chrono'] ?></h1>
</div>
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Modifications</h6>
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
      <form autocomplete="off" action="<?=base_url(session()->root.'/modifier/tracteurs/'.$tracteur['chrono'])?>" method="post" id="formu" class="row">
        <?= csrf_field() ?>
        <div class="col-md-4">
          <div class="form-floating mb-3">
            <input value="<?= set_value('chrono',$tracteur['chrono']) ?>" type="text" class="form-control" name="chrono" id="chrono" placeholder="chrono" required>
            <label for="chrono">Chrono</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-floating mb-3">
            <input value="<?= set_value('immatriculation',$tracteur['immatriculation']) ?>" type="text" class="form-control" name="immatriculation" id="immatriculation" placeholder="immatriculation" required>
            <label for="immatriculation">Immatriculation</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-floating mb-3">
            <input value="<?= set_value('ancienne_immatriculation',$tracteur['ancienne_immatriculation']) ?>" type="text" class="form-control" name="ancienne_immatriculation" id="ancienne_immatriculation" placeholder="ancienne_immatriculation">
            <label for="ancienne_immatriculation">Ancienne Immatriculation</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-floating mb-3">
            <input value="<?= set_value('marque',$tracteur['marque']) ?>" type="text" class="form-control" name="marque" id="marque" placeholder="marque" required>
            <label for="marque">Marque</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-floating mb-3">
            <input value="<?= set_value('modele',$tracteur['modele']) ?>" type="text" class="form-control" name="modele" id="modele" placeholder="modele" required>
            <label for="modele">Modèle</label>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-floating mb-3">
            <select name="au_rebut" class="form-select" id="floatingSelect" aria-label="Floating label select example">
              <option <?= ($tracteur['au_rebut'] == 'OUI') ? 'selected' : '' ?> value="OUI">OUI</option>
              <option <?= ($tracteur['au_rebut'] == 'NON') ? 'selected' : '' ?> value="NON">NON</option>
            </select>
            <label for="floatingSelect">Au rebut?</label>
          </div>
        </div>

        <div class="col-md">
          <div class="form-floating mb-3">
            <input value="<?= set_value('remarque',$tracteur['remarque']) ?>" type="text" class="form-control" name="remarque" id="remarque" placeholder="remarque" required>
            <label for="remarque">Remarque</label>
          </div>
        </div>

      </form>
      <div class="row">
        <div class="m-auto col-md-4 d-grid">
          <button form="formu" type="submit" class="btn mb-3 py-3  btn-primary">Enregistrer les modifications</button>
        </div>

      </div>
    </div>
  </div>
</div>
<?= $this->endSection() ;?>

