<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">Staki</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
        </div>
    </div>
</nav>


<div class="container" style="margin-top: 100px;"> <!-- Added inline CSS for margin-top -->
    <h1 class="display-4 text-primary text-center text-uppercase font-weight-bold mb-5">Connexion</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="box border p-4">
                <form class="form-group" action="/login" method="POST">
                    <?php if(!empty($_SESSION['error'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['error']; ?>
                        </div>
                            <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="email">Email :</label>
                        <input class="form-control" type="text" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="passwd">Mot de passe :</label>
                        <input class="form-control" type="password" name="passwd" required>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Valider</button>
                </form>
                <small class="text-center d-block">Vous n'avez pas encore de compte ? <a class="link-underline-primary" href="/register">S'inscrire</a></small>
            </div>
        </div>
    </div>
</div>