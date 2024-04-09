<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <span class="navbar-brand">Staki</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <?php if(isset($_SESSION['email'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/friendslist">Liste d'ami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/notifs">Notifications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/profil">Profil</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/login">Connexion</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h1 class="display-4 text-primary text-center text-uppercase font-weight-bold mb-5" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.2);">Home</h1>
    <div class="row justify-content-start">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <a href="/friends" class="btn btn-primary btn-block">Ajouter des amis</a>
                </div>
            </div>
        </div>
    </div>
</div>
