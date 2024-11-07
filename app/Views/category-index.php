<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Liste des Catégories</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card h-100">
                                <div class="card-header">Créer une catégorie</div>
                                <form method="POST" action="/category/create">
                                    <div class="card-body">
                                        <?php if (isset($errors)) { ?>
                                            <?php foreach($errors as $error) { ?>
                                                <div class="alert alert-danger" role="alert">
                                                    <?= $error ?>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                            <label for="categoryname" class="form-label">Nom</label>
                                            <input type="text" class="form-control" id="name" name="name" value="<?= isset($category) ? $category['name'] : ''; ?>">
                                        <div class="d-grid mt-4">
                                            <button class="btn btn-primary" type="submit">Créer</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="card h-100">
                                <div class="card-header">Liste des catégories</div>
                                <div class="card-body">
                                    <table class="table table-hover table-sm">
                                        <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NAME</th>
                                            <th>SLUG</th>
                                            <th>EDIT</th>
                                            <th>DELETE</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($categories as $categ): ?>
                                            <tr>
                                                <td><?= $categ['id']; ?></td>
                                                <td><?= $categ['name']; ?></td>
                                                <td><?= $categ['slug']; ?></td>
                                                <td>
                                                    <a href="<?= base_url('/category/' . $categ['id']); ?>" >
                                                        <i class="fa-solid fa-pen"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <?php if ($categ['id'] != 1) { ?>
                                                        <a href="<?= base_url('/category/delete/' . $categ['id']); ?>" class="delete">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.delete').on('click', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            Swal.fire({
                title: "Êtes-vous sûr ?",
                text: "Vous ne pourrez pas revenir en arrière!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Oui, supprimez le!"
            }).then((result) => {
                if (result.isConfirmed) {
                   location.replace(url);
                }
            });
        })
    });
</script>