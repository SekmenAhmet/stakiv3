<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">Staki</a>
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


<div class="container">
    <h1 class="display-4 text-primary text-center text-uppercase font-weight-bold mb-5" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.2);">Ajoutez des amis :</h1>


    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="/friends" method="POST" class="mb-5">

                <?php if(!empty($_SESSION['inexistantUser'])):?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_SESSION['inexistantUser']; ?>
                </div>
                    <?php unset($_SESSION['inexistantUser']);?>
                <?php endif; ?>

                <div class="form-group">
                    <label for="search">Rechercher des amis</label>
                    <input type="search" class="form-control" id="search" name="search">
                </div>
                <button type="submit" class="btn btn-primary" id="btn"">Ajouter
            </form>
        </div>
    </div>

    <div class="container">
        <h1 class="display-4 text-primary text-center text-uppercase font-weight-bold mb-5" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.2);">Liste des utilisateurs  :</h1>

        <div class="row">
        <?php foreach ($_SESSION['usersToAdd'] as $user): ?>
            <div class="col-md-3 mb-3">
                <div class="box border p-3 text-center">
                    <p class="message font-weight-bold"><?php echo $user['username']; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>