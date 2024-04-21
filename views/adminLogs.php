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

<h1 class="display-4 text-primary text-center text-uppercase font-weight-bold mb-5">Logs</h1>

<?php
require_once '../src/controllers/AdminController.php';
$admin = new \App\controllers\AdminController();
$logs = $admin->showTable('logs');
?>

<div class="container" style="margin-top: 50px;">
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>ID Utilisateur</th>
                <th>Action</th>
                <th>Timestamp</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($logs as $row): ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['action']; ?></td>
                    <td><?php echo $row['time']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>