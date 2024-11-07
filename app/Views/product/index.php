<div class="container">
    <div class="row">
        <div class="col-12">
            <h3 class="mb-4 mt-4 text-center">Liste des Produits</h3>
        </div>

        <?php foreach($products as $product): ?>
            <div class="col-md-3 mb-4"> <!-- Modifié de col-md-4 à col-md-3 -->
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?= $product['name']; ?></h5>
                        <p class="card-text">
                            <strong>Prix:</strong> <?= $product['price']; ?> €<br>
                            <strong>Quantité restante:</strong> <?= $product['quantity']; ?><br>
                            <strong>Catégorie:</strong> <?= $product['category_name']; ?>
                        </p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="<?= base_url('/product/voir/' . $product['id']); ?>" class="btn btn-primary btn-sm me-2" title="Voir" target="_blank">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                        <a href="<?= base_url('/product/' . $product['id']); ?>" class="btn btn-warning btn-sm me-2" title="Éditer">
                            <i class="fa-solid fa-pen"></i>
                        </a>
                        <a href="<?= base_url('/product/delete/' . $product['id']); ?>" class="btn btn-danger btn-sm" title="Supprimer">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
