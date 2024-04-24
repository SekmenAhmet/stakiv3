<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="/">Staki</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/admin">Panel</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<h1 class="display-4 text-primary text-center text-uppercase font-weight-bold mb-5">Utilisateurs</h1>

<div class="row justify-content-center">
    <div class="col-md-6">
        <form action="/adminUsers" method="POST" class="mb-5">

<!--            --><?php //if(!empty($_SESSION['inexistantUser'])):?>
<!--                <div class="alert alert-danger" role="alert">-->
<!--                    --><?php //echo $_SESSION['inexistantUser']; ?>
<!--                </div>-->
<!--                --><?php //unset($_SESSION['inexistantUser']);?>
<!--            --><?php //endif; ?>

            <div class="form-group">
                <label for="search">Rechercher des utilisateurs</label>
                <input type="search" class="form-control" id="search" name="search">
            </div>
            <button type="submit" class="btn btn-primary" id="btn"">Ajouter
        </form>
    </div>
</div>

<div class="container" style="margin-top: 50px;">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Nom d'utilisateur</th>
                <th>Email</th>
                <th>Date de naissance</th>
            </tr>
            </thead>
            <tbody>
            <?php /** @var array $users */
            foreach ($users as $row): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['lastname']; ?></td>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['ddn']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>