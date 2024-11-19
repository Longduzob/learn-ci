<form method="POST" action="/user/<?= isset($user['id']) ? 'update':'create'; ?>">
    <div class="container">
        <?php if (isset($errors)) { ?>
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <?php foreach($errors as $error) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $error ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <br>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><?= isset($user['id']) ? 'Modifier' : 'Créer' ?> l'utilisateur </h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="username" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="username" name="username" value="<?= isset($user) ? $user['username'] : ''; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" value="<?= isset($user) ? $user['email'] : ''; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" id="password" name="password" value="">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?php if(isset($user['id'])){ ?>
                            <input type="hidden" name="id" value="<?= $user['id']; ?>">
                        <?php } ?>
                        <button class="btn btn-primary" type="submit"><?= isset($user['id']) ? "Modifier" : "Créer"; ?></button></div>
                </div>
            </div>
        </div>
    </div>
</form>