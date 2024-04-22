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
                    <a class="nav-link" href="/friends">Amis</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/profil">Profil</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h1 class="display-4 text-primary text-center text-uppercase font-weight-bold mb-5" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.2);">Liste d'amis :</h1>

    <div class="row">
        <?php /** @var array $amis */
        foreach ($amis as $row): ?>
            <div class="col-md-3 mb-10">
                <div class="card border shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title font-weight-bold"><?php echo $row['username']; ?></h5>
                        <form action="/friendslist" method="POST">
                            <input type="hidden" name="friend_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-danger" name="supprimer" value="supprimer">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
