<!DOCTYPE html>
<html>

<head>
  <title>Formulaire de remplissage de carburant</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <style type="text/css">
    .error {
      color: red;
      font-size: 0.8rem;
      margin-top: 0.2rem;
    }

    body {
      background-color: #e5f2f7;
      color: #222;
    }

    label {
      font-weight: bold;
    }

    .form-control {
      background-color: #a5c9e1;
      color: #222;
    }
  </style>
</head>

<body>
  <div class="container">
    <div class="d-flex justify-content-end py-3">
      <a name="" id="" class="btn btn-danger" href="<?= base_url('ye/deconnexion') ?>" role="button">Se déconnecter</a>
    </div>
    <h1 class="mt-3 mb-4">Formulaire de remplissage de carburant</h1>
    <?php if (session()->has('ops')) : ?>
      <?php if (session()->ops) : ?>
        <div class="alert alert-success" role="alert">
          <strong>Enregistré</strong>
        </div>
      <?php else : ?>
        <div class="alert alert-danger" role="alert">
          <strong>Echec</strong>
        </div>
      <?php endif ?>
    <?php endif ?>
    <form id="carburant-form" method="POST" action="<?= base_url('/g_carburant') ?>">
      <div class="form-group">
        <label for="date">Date:</label>
        <input type="date" class="form-control" id="date" name="date">
        <small class="form-text text-muted">Veuillez saisir la date de remplissage.</small>
      </div>
      <div class="form-group">
        <label for="litres">Nombre de litres:</label>
        <input type="number" class="form-control" id="litres" name="litres" step="0.01">
        <small class="form-text text-muted">Veuillez saisir le nombre de litres.</small>
      </div>
      <div class="form-group">
        <div class="form-group">
          <label for="chrono">Chrono</label>
          <select class="form-control" name="chrono" id="chrono">
            <option hidden value="">Selectionnez</option>
            <?php foreach ($trs as $tr) : ?>
              <option value="<?= $tr['chrono'] ?>"><?= $tr['chrono'] ?></option>
            <?php endforeach ?>
            <?php foreach ($hms as $hm) : ?>
              <option value="<?= $hm['chrono'] ?>"><?= $hm['chrono'] ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <small class="form-text text-muted">Veuillez choisir le chrono du camion ou hammar.</small>
      </div>
      <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
  </div>
</body>

</html>