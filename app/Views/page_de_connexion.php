<?= $this->extend('layouts/html'); ?>
<?= $this->section('titre'); ?>
Connexion
<?= $this->endSection(); ?>
<?= $this->section('contenu'); ?>
<div class="container">

  <!-- Outer Row -->
  <div class="row justify-content-center">

    <div class="col-xl-10 col-lg-12 col-md-9">

      <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
          <div class="row">
            <div class="col-lg-6 d-none d-lg-block bg-login-image" style="background-image: url(<?=base_url('img/container.jpg')?>);"></div>
            <div class="col-lg-6">
              <div class="p-5">
                <div class="text-center">
                  <img src="<?=base_url('img/tal.png')?>" alt="">
                </div>
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">CONNEXION</h1>
                </div>
                <?php if (session()->has('erreur')) : ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    Identifiants de connexion incorrects
                  </div>
                <?php endif ?>
                <?php if (session()->has('session')) : ?>
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    Vous devez vous reconnecter.
                  </div>
                <?php endif ?>
                <form class="user" method="post" action="<?=base_url('/connexion')?>">
                  <div class="form-group">
                    <input name="login" type="text" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="Identifiant" placeholder="Votre identifiant">
                  </div>
                  <div class="form-group">
                    <input name="mdp" type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Votre mot de passe">
                  </div>

                  <button type="submit" class="btn btn-primary btn-user btn-block">Se connecter</button>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>

</div>
<?= $this->endSection(); ?>