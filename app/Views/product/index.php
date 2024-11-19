<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.delete-product').forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent default anchor behavior
                // Confirmation before deleting
                Swal.fire({
                    position: "middle",
                    icon: "success",
                    title: "Vous avez supprimé l'utilisateur !",
                    showConfirmButton: false,
                    timer: 1500
                });
            });
        });
    });
</script>

<br>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Liste des produits</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover table-sm">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>NAME</th>
                            <th>SLUG</th>
                            <th>Quantité</th>
                            <th>Prix</th>
                            <th>Catégorie</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                            <th>VOIR</th>
                        </tr>
                        </thead>
                        <tbody style="overflow-y: scroll;">
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?= $product['id']; ?></td>
                                <td><?= $product['name']; ?></td>
                                <td><?= generateSlug($product['name']); ?></td>
                                <td><?= $product['quantity']; ?></td>
                                <td><?= $product['price']; ?></td>
                                <td><?= $product['id_category']; ?></td>
                                <td>
                                    <a class="btn btn-light" href="<?= base_url('/product/' . $product['id']); ?>">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                </td>
                                <td>
                                    <a class="btn btn-danger" href="<?= base_url('/product/delete/' . $product['id']); ?>" class="delete-product">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                                <td><a href="<?= base_url('/product/voir/' . $product['id']); ?>" class="btn btn-light" target="_blank"><i class="fa-solid fa-eye"></i></a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="/product/new" class="btn btn-primary">Créer un produit</a>
                </div>
            </div>
        </div>
    </div>
</div>
