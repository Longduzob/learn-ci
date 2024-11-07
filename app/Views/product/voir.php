<?php if (isset($product) && !empty($product)) : ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h4 class="card-title"><?= $product['name']; ?></h4>
                    </div>
                    <div class="card-body">
                        <p><strong>Prix :</strong> <?= $product['price']; ?> €</p>
                        <p><strong>Quantité disponible :</strong> <?= $product['quantity']; ?></p>
                        <form action="/cart/addtocart" method="post" class="mt-3">
                            <input type="hidden" name="id" value="<?= $product['id']; ?>">
                            <input type="hidden" name="name" value="<?= $product['name']; ?>">
                            <input type="hidden" name="price" value="<?= $product['price']; ?>">
                            <div class="form-group mb-3">
                                <label for="quantity">Quantité à ajouter :</label>
                                <input type="number" id="quantity" name="quantity" class="form-control form-control-sm w-50" min="1" max="<?= $product['quantity']; ?>" value="1" required>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-success">Ajouter au panier</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="container">
        <div class="alert alert-info text-center" role="alert">
            Ce produit n'existe pas !
        </div>
    </div>
<?php endif; ?>
