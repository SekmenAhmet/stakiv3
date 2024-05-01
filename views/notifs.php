<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">Staki</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/friendslist">Liste d'amis</a>
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



<h1 class="display-4 text-primary text-center text-uppercase font-weight-bold mb-5" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.2); padding: 10px 0;">Notifications :</h1>

<div class="row justify-content-center">
    <div class="col-md-6">
        <?php foreach ($_SESSION['notifAmi'] as $row): ?>
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <span class="font-weight-bold" style="font-size: 1.2rem;"><?= $row['sender_username'] ?></span>
                </div>
                <div class="card-body">
                    <p class="card-text" style="font-size: 1.1rem;"><?= $row['message'] ?></p>
                    <p class="card-text text-muted" style="font-size: 1rem;">Envoyé le : <?= $row['created_at'] ?></p>
                    <div class="d-flex justify-content-end">
                        <form action="/notifs" method="POST" class="mr-2">
                            <input type="hidden" name="notification_id" value="<?= $row['id'] ?>">
                            <button type="submit" class="btn btn-danger" name="refuser" value="refuser">Refuser</button>
                        </form>
                        <form action="/notifs" method="POST">
                            <input type="hidden" name="notification_id" value="<?= $row['id'] ?>">
                            <button type="submit" class="btn btn-success" name="accepter" value="accepter">Accepter</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <?php foreach ($_SESSION['notifsResult'] as $row): ?>
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <span class="font-weight-bold" style="font-size: 1.2rem;"><?= $row['sender_username'] ?></span>
                </div>
                <div class="card-body">
                    <p class="card-text" style="font-size: 1.1rem;"><?= $row['message'] ?></p>
                    <p class="card-text text-muted" style="font-size: 1rem;">Envoyé le : <?= $row['created_at'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
</div>
