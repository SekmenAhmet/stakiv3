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
                <li class="nav-item">
                    <a class="nav-link" href="/profil">Profil</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container">
    <h1 class="display-4 text-primary text-center text-uppercase font-weight-bold mb-5" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.2);">Résultat de votre recherche :</h1>

<div class="row justify-content-center">
    <div class="col-md-3">
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <span class="font-weight-bold" style="font-size: 1.2rem;"><?= $_SESSION['searchedUser']['username'] ?></span>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-end">
                        <form action="/searchResult" method="POST">
                            <button type="submit" class="btn btn-success" name="ajouter" value="ajouter">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>