<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <!-- Lien Staki pour retourner à l'accueil -->
        <a class="navbar-brand" href="/">Staki</a>
        <!-- Bouton pour basculer la navigation sur mobile -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
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

<div class="container" style="margin-top: 50px;">
    <h1 class="display-4 text-primary text-center text-uppercase font-weight-bold mb-5">Contactez l'assistance</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="box border p-4">
                <form class="form-group" action="/contact" method="POST">
                    <form class="form-group" action="/login" method="POST">
                        <?php if(!empty($_SESSION['mailError'])): ?>
                            <div class="alert alert-danger" role="alert">
                                <?php echo $_SESSION['mailError']; ?>
                            </div>
                            <?php unset($_SESSION['mailError']); ?>
                        <?php endif; ?>

                        <?php if(!empty($_SESSION['mailSuccess'])): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $_SESSION['mailSuccess']; ?>
                            </div>
                            <?php unset($_SESSION['mailSuccess']); ?>
                        <?php endif; ?>
                    <div class="form-group">
                        <label for="objet">Objet :</label>
                        <input class="form-control" type="text" name="objet" required>
                    </div>
                    <div class="form-group">
                        <label for="texte">Message :</label>
                        <!-- Utilisation de resize: none pour désactiver le redimensionnement -->
                        <textarea class="form-control" name="message" rows="5" style="resize: none;" required></textarea>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Envoyer</button>
                </form>
            </div>
        </div>
    </div>
</div>
