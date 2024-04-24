<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="#">Staki</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/notifs">Notifications</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/friendslist">Liste d'amis</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Profile Information -->
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1 class="display-4 text-primary font-weight-bold mb-3">Profil de <span class="text"><?php echo $_SESSION['username']?></span></h1>
            <p class="lead font-weight-normal text-muted">Modifiez vos informations personnelles ci-dessous.</p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form id="profileForm" action="/profilmodif" method="post">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Informations personnelles
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item mb-3">
                                <div class="row">
                                    <div class="col-sm-6"><strong>Pseudo:</strong></div>
                                    <div class="col-sm-6"><input type="text" name="username" class="form-control border-0 border-bottom" value="<?php echo $_SESSION['username']?>"></div>
                                </div>
                            </li>
                            <li class="list-group-item mb-3">
                                <div class="row">
                                    <div class="col-sm-6"><strong>Email:</strong></div>
                                    <div class="col-sm-6"><input type="text" name="email" class="form-control border-0 border-bottom" value="<?php echo $_SESSION['email']?>"></div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-12 mb-2"><strong>Biographie:</strong></div>
                                    <div class="col-sm-12"><textarea name="biographie" class="form-control border-0 border-bottom" style="resize: none; height: 150px; overflow: hidden;"><?php echo  empty($_SESSION['biographie']) ? '' : $_SESSION['biographie']?></textarea></div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <!-- Bouton "Enregistrer les modifications" à l'intérieur du formulaire -->
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </div>
            </form>
        </div>
    </div>
</div>
