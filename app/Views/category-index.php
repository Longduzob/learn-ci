<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-category').forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent default anchor behavior
                // Confirmation before deleting
                Swal.fire({
                    position: "middle",
                    icon: "success",
                    title: "Vous avez supprimé la catégorie !",
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });
    });
</script>



<br>
<div class="container">
<div class="card">
    <div class="card-header">
        <h5>Gestion des Catégories</h5>
    </div>
    <br>
    <div class="row">
        <div class="col-md-5">
            <form method="POST" action="/category/<?= isset($category['id']) ? 'update' : 'create'; ?>">
                <div class="container">
                    <?php if (isset($errors)) { ?>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <?php foreach ($errors as $error) { ?>
                                    <div class="alert alert-danger" role="alert">
                                        <?= $error ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"><?= isset($category['id']) ? 'Modifier' : 'Créer' ?> une catégorie</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3 row">
                                        <label for="name" class="col-sm-2 col-form-label">Nom :</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="name" name="name"
                                                   value="<?= isset($category) ? $category['name'] : ''; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <?php if (isset($category['id'])) { ?>
                                        <input type="hidden" name="id" value="<?= $category['id']; ?>">
                                    <?php } ?>
                                    <button class="btn btn-primary" type="submit">
                                        <?= isset($category['id']) ? "Modifier" : "Créer"; ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h4>Liste des Catégories</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-sm">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOM</th>
                            <th>SLUG</th>
                            <th>ÉDITER</th>
                            <th>SUPPRIMER</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($categorys as $category): ?>
                            <tr>
                                <td><?= $category['id']; ?></td>
                                <td><?= $category['name']; ?></td>
                                <td><?= generateSlug($category['slug']); ?></td>
                                <td><a href="<?= base_url('/category/' . $category['id']); ?>" class="btn btn-light text-center"><i class="fa-solid fa-pen"></i></a></td>
                                <td>
                                    <?php if ($category['id'] != 1) { ?>
                                    <a href="<?= base_url('/category/delete/' . $category['id']); ?>" class="btn btn-danger delete"><i class="fa-solid fa-trash"></i></a></td>
                                    <?php } ?>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>
</div>
</div>

<script>
    $(document).ready(function(){
        $('.delete').on('click', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    location.replace(url);
                    }
            });
        })
    })

</script>




