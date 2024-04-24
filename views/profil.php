<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <!-- Lien Staki pour retourner à l'accueil -->
        <a class="navbar-brand" href="/">Staki</a>
        <!-- Bouton pour basculer la navigation sur mobile -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

<div class="container mt-5 position-relative">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1 class="display-4 text-primary font-weight-bold mb-3">Profil de <span class="text"><?php echo $_SESSION['username']?></span></h1>
            <p class="lead font-weight-normal text-muted">Consultez vos informations personnelles ci-dessous.</p>
        </div>
    </div>
    <?php if(!empty($_SESSION['infoError'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['infoError']; ?>
        </div>
        <?php unset($_SESSION['infoError']); ?>
    <?php endif; ?>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Informations personnelles
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item mb-3">
                            <div class="row">
                                <div class="col-sm-6"><strong>Prénom:</strong></div>
                                <div class="col-sm-6"><strong><?php echo $_SESSION['name']?></strong></div>
                            </div>
                        </li>
                        <li class="list-group-item mb-3">
                            <div class="row">
                                <div class="col-sm-6"><strong>Nom:</strong></div>
                                <div class="col-sm-6"><strong><?php echo $_SESSION['lastname']?></strong></div>
                            </div>
                        </li>
                        <li class="list-group-item mb-3">
                            <div class="row">
                                <div class="col-sm-6"><strong>Email:</strong></div>
                                <div class="col-sm-6"><strong><?php echo $_SESSION['email']?></strong></div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-sm-6"><strong>Date de naissance:</strong></div>
                                <div class="col-sm-6"><strong><?php echo $_SESSION['ddn']?></strong></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-3 offset-md-9 position-absolute top-0 end-0">
            <div class="card">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><a href="/notifs">Notifications</a></li>
                        <li class="list-group-item"><a href="/friendslist">Liste d'amis</a></li>
                        <li class="list-group-item"><a href="/friends">Ajouter des amis</a></li>
                        <?php if($_SESSION['email'] == 'a@gmail.com'){ ?>
                            <li class="list-group-item"><a href="/admin">Panel administrateur</a></li>
                        <?php }    ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    Biographie
                </div>
                <div class="card-body">
                    <p><?php echo empty($_SESSION['biographie']) ? '' : $_SESSION['biographie']  ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <a href="/profilmodif" class="btn btn-primary btn-block">Modifier les informations</a>
        </div>
    </div>
</div>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="/logout" method="POST">
                        <button class="btn btn-danger btn-block mb-1">Déconnexion</button>
                    </form>
                    <form action="/deleteAccount" method="POST">
                        <button class="btn btn-danger btn-block mb-1">Supprimer le compte</button>
                    </form>
                    <a href="/contact" class="btn btn-danger btn-block">Nous contacter</a>
                </div>
            </div>
        </div>
    </div>
</div>
