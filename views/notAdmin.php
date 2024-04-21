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
                <li class="nav-item">
                    <a class="nav-link" href="/profil">Profil</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container text-center mt-5">
    <h1 class="display-4 text-danger">Tu n'est pas administrateur !</h1>
    <p class="lead">Oops ! Il semble que tu aies atterri sur une page à laquelle tu n'as pas accès !</p>
    <p class="lead">Mais ne t'inquiète pas, tu es toujours un super utilisateur !</p>
    <a href="/" class="btn btn-primary">Retour à la page d'accueil</a>
</div>