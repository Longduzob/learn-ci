<div class="container">
    <div class="row">
        <div class="col">
            <div class="card mt-5">
                <div class="card-header">
                    <h5 class="card-title">Votre panier</h5>
                </div>
                <div class="card-body mt-3">
                    <table class="table table-sm table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nom du produit</th>
                                <th>Quantité</th>
                                <th>Prix unitaire</th>
                                <th>Prix total</th>
                                <th class="text-center">Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($products as $index => $product): ?>
                                <tr>
                                    <td><?= $product['name']; ?></td>
                                    <td><?= $product['quantity']; ?></td>
                                    <td><?= $product['price']; ?></td>
                                    <td><?= $product['price'] * $product['quantity']; ?></td>
                                    <td class="text-center">
                                        <!-- Formulaire de suppression du produit -->
                                        <form method="POST" action="<?= base_url('/cart/removeProduct'); ?>">
                                            <input type="hidden" name="index" value="<?= $index; ?>">
                                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php  endforeach; ?>
                        </tbody>
                    </table>
                    <div class="text-start mt-4">
                        <h2>Total : <?= $total; ?> €</h2>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <a href="/checkout" class="btn btn-lg btn-success">Procéder au paiement</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
