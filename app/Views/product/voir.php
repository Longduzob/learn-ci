<?php
if (isset($product) && !empty($product)) { ?>
    <br>
    <div class="d-flex justify-content-center align-items-center" style="height: 60vh;">
        <div class="card" style="width: 18rem;">
            <div class="card-header">
                <h6>Détail du produit</h6>
            </div>
            <div class="card-body">
                <h2 class="card-title"><?= $product['name']; ?></h2>
                <p class="card-text"></p>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Prix : <?= $product['price']; ?> €</li>
                <li class="list-group-item">Quantité disponible : <?= $product['quantity']; ?></li>
            </ul>
            <div class="card-body">
                <!-- Formulaire pour ajouter au panier -->
                <form action="/product/addtocart" method="post">
                    <!-- Id du produit à envoyer dans la requête POST -->
                    <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                    <!-- Sélecteur de quantité (quantité par défaut à 1) -->
                    <label for="quantity">Quantité :</label>
                    <input type="number" name="quantity" value="1" min="1" max="<?= $product['quantity']; ?>" class="form-control mb-3">
                    <!-- Bouton pour ajouter au panier -->
                    <button type="submit" class="btn btn-success">Ajouter au panier</button>
                </form>
                <!-- Bouton retour -->
                <br>
                <button class="btn btn-danger" onclick="closeWindow()">Retour</button>
                <script>
                    function closeWindow() {
                        window.close();
                    }
                </script>
            </div>
        </div>
    </div>

<?php } else { ?>
    <div class="alert alert-info" role="alert">
        Ce produit n'existe pas !
    </div>
<?php } ?>
