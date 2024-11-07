<div class="container">
    <div class="row">
        <div class="col-12">
            <h3 class="mb-4 mt-4 text-center">Liste des Produits</h3>
        </div>

        <?php foreach ($products as $product): ?>
            <div class="col-md-3 mb-4">
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
                        <a href="<?= base_url('/product/voir/' . $product['id']); ?>" class="btn btn-outline-primary btn-sm" title="Voir">
                            <i class="fa-solid fa-eye"></i> Voir
                        </a>

                        <!-- Formulaire d'ajout au panier avec quantité 1 -->
                        <form action="/cart/addtocart" method="post" style="display:inline-block;">
                            <input type="hidden" name="id" value="<?= $product['id']; ?>">
                            <input type="hidden" name="name" value="<?= $product['name']; ?>">
                            <input type="hidden" name="price" value="<?= $product['price']; ?>">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn btn-outline-success btn-sm" title="Ajouter au panier">
                                <i class="fa-solid fa-cart-plus"></i> Ajouter
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
