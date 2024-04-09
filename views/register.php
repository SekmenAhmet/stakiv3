<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <span class="navbar-brand">Staki</span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Accueil</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container" style="margin-top: 50px;"> <!-- Added inline CSS for margin-top -->
    <h1 class="display-4 text-primary text-center text-uppercase font-weight-bold mb-5">Inscription</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="box border p-4">
                <form method="POST">
                    <div class="form-group">
                        <?php if(!empty($_SESSION['email-error'])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION['email-error']; ?>
                            </div>
                            <?php unset($_SESSION['email-error']); ?>
                        <?php endif; ?>
                        <input class="form-control" type="text" name="lastname" placeholder="Nom" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="name" placeholder="Prénom" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="username" placeholder="Nom d'utilisateur" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="passwd" placeholder="Mot de passe" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="date" name="ddn" placeholder="Date de naissance" required>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Valider</button>
                </form>
                <small class="text-center d-block mt-3">Déjà inscrit ? <a class="link-underline-primary" href="/login">Se connecter</a></small>
            </div>
        </div>
    </div>
</div>

