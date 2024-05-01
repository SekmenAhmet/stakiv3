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



<div class="container" style="margin-top: 50px;">
    <h1 class="display-4 text-primary text-center text-uppercase font-weight-bold mb-5">Notifications</h1>
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID Utilisateur</th>
                <th>Nom d'utilisateur</th>
                <th>Message</th>
                <th>ID Expéditeur</th>
                <th>Nom d'utilisateur Expéditeur</th>
                <th>Date de création</th>
            </tr>
            </thead>
            <tbody>
            <?php /** @var array $notifs */
            foreach (array_reverse($notifs) as $row): ?>
                <tr>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['receiver_username']; ?></td>
                    <td><?php echo $row['message']; ?></td>
                    <td><?php echo $row['sender_id']; ?></td>
                    <td><?php echo $row['sender_username']; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>