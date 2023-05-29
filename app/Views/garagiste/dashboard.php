<!DOCTYPE html>
<html>

<head>
  <title>Formulaire de garage</title>
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
      background-color: #e1f3f8;
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
    <h1 class="mt-3 mb-4">Formulaire de garage</h1>
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
    <form id="garage-form" method="post" action="<?= base_url('garagiste') ?>">
      <div class="form-group">
        <div class="form-group">
          <div class="form-group">
            <div class="form-group">
              <div class="container">
                <div class="form-group">
                  <label for="date">Date:</label>
                  <input type="date" class="form-control" id="date" name="date">
                  <small class="form-text text-muted">Veuillez saisir la date.</small>
                </div>
                <div class="form-group">
                  <label>Choisir le type de véhicule :</label>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" value="r" name="type" required id="rad1">
                    <label class="form-check-label" for="rad1">
                      Remorque
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" value="h" name="type" required id="rad2">
                    <label class="form-check-label" for="rad2">
                      Hammar
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" value="t" name="type" required id="rad3">
                    <label class="form-check-label" for="rad3">
                      Tracteur
                    </label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-group">
                    <label for="chrono"></label>
                    <select class="form-control" name="chrono" id="chrono">
                      <option hidden>Selectionner le chrono</option>
                      <?php foreach ($trs as $tr) : ?>
                        <option value="<?= $tr['chrono'] ?>"><?= $tr['chrono'] ?></option>
                      <?php endforeach ?>
                      <?php foreach ($rms as $rm) : ?>
                        <option value="<?= $rm['chrono'] ?>"><?= $rm['chrono'] ?></option>
                      <?php endforeach ?>

                    </select>
                  </div>
                  <small class="form-text text-muted">Veuillez saisir le chrono du véhicule.</small>

                  <div class="form-group">
                    <label for="commentaire">Commentaire pour la ou les pièces changées:</label>
                    <textarea class="form-control" id="commentaire" name="commentaire"></textarea>
                    <small class="form-text text-muted">Veuillez saisir le commentaire pour la ou les pièces changées.</small>
                  </div class="form-group">
                  <label for="total">Montant total:</label>
                  <input type="number" step="0.01" class="form-control" id="total" name="total">
                  <small class="form-text text-muted">Veuillez saisir le montant total.</small>
                  <button type="submit" class="btn btn-primary mt-3">Envoyer</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </form>
  </div>
</body>

</html>