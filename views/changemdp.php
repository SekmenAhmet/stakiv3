<div class="container" style="margin-top: 100px;">
    <h1 class="display-4 text-primary text-center text-uppercase font-weight-bold mb-5">Changez votre mot de passe :</h1>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="box border p-4">
                <form class="form-group" action="/changemdp" method="POST">
                    <?php if(!empty($_SESSION['fakepasswd'])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['fakepasswd']; ?>
                        </div>
                        <?php unset($_SESSION['fakepasswd']); ?>
                    <?php endif; ?>
                    <div class="form-group">
                        <label for="oldpasswd">Ancien mot de passe :</label>
                        <input class="form-control" type="password" name="oldpasswd" required>
                    </div>
                    <div class="form-group">
                        <label for="newpasswd">Nouveau mot de passe :</label>
                        <input class="form-control" type="password" name="newpasswd" required>
                    </div>
                    <button class="btn btn-primary btn-block" type="submit">Valider le changement</button>
                </form>
            </div>
        </div>
    </div>
</div>
