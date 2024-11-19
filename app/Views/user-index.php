<br>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header"><h4>Liste des Utilisateurs</h4></div>
                <div class="card-body">
                    <table class="table table-hover table-sm">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>USERNAME</th>
                            <th>EMAIL</th>
                            <th>Modifier</th>
                            <th>Supprimer</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $user['id']; ?></td>
                                <td><?= $user['username']; ?></td>
                                <td><?= $user['email']; ?></td>
                                <td><a href="<?= base_url('/user/' . $user['id']); ?>" class="btn btn-dark"><i class="fa-solid fa-user-pen"></i></a></td>
                                <td><a href="<?= base_url('/user/delete/' . $user['id']); ?>" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer"><a href="/user/new" class="btn btn-primary">Créer un Utilisateurs</a></div>
            </div>
        </div>
    </div>
</div>