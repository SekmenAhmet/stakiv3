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

<div class="container col-md-6" style="margin-top: 20px;">
    <?php if(!empty($_SESSION['stakError'])): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $_SESSION['stakError']; ?>
        </div>
        <?php unset($_SESSION['stakError']); ?>
    <?php endif; ?>
    <?php if(isset($_SESSION['email'])) :?>
        <form action="/" method="POST" class="mb-3">
            <div class="input-group">
                <input type="text" name="stak" class="form-control" placeholder="Quelque chose à dire ?" autocomplete="off">
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Poster</button>
                </div>
            </div>
        </form>
    <?php endif; ?>

    <div class="table-responsive">
        <?php /** @var array $staks */
        $staks = array_reverse($staks);
        foreach ($staks as $row): ?>
            <div class="card mb-3 ">
                <div class="card-header bg-primary text-white">
                    <span class="font-weight-bold" style="font-size: 1.2rem;"><?= $row['username'] ?></span>
                </div>
                <div class="card-body">
                    <p class="card-text" style="font-size: 1.1rem;"><?= $row['text'] ?></p>
                    <p class="card-text text-muted" style="font-size: 1rem;">Envoyé le : <?= $row['time'] ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>

    document.addEventListener("DOMContentLoaded", e => {
            let preventMultipleSubmits = e => {
            let form = e.currentTarget
            if (form.alreadySubmitted) {
                return e.preventDefault()
            }
            form.alreadySubmitted = true
        }
        document.querySelectorAll("form").forEach(form => {
            form.addEventListener("submit", preventMultipleSubmits)
        })
    })

</script>