<style>
    .table td, .table th {
        vertical-align: middle;
    }

    .card {
        border-radius: 2px;
    }

    .table-responsive {
        overflow-x: auto;
    }

    h3 span {
        font-weight: bold;
        color: #5cb85c; /* couleur verte pour le total */
    }

    .custom-shadow {
        box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2); /* Ombre plus large et plus diffuse */
    }
</style>


<div class="container my-4">
    <br>
    <br>
        <div class="card shadow-lg custom-shadow p-4">
            <h1 class="text-center">Votre Panier</h1>
            <br>
            <?php if (isset($cart) && !empty($cart)) : ?>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="table-dark">
                    <tr>
                        <th>Produit</th>
                        <th>Quantité</th>
                        <th>Prix Unitaire</th>
                        <th>Total</th>
                        <th>Supprimer</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($cart as $index => $item) : ?>
                        <tr>
                            <td><?= esc($item['name']); ?></td>
                            <td><?= esc($item['quantity']); ?></td>
                            <td><?= esc($item['price']); ?> €</td>
                            <td><?= esc($item['quantity'] * $item['price']); ?> €</td>
                            <td>
                                <form method="POST" action="/ShoppingCart/removeProduct">
                                    <input type="hidden" name="index" value="<?= $index; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="text-start mt-4">
                <h3>Total du panier :
                    <span style="text-decoration: underline;">
                        <?php
                        $total = 0;
                        foreach ($cart as $item) {
                            $total += $item['quantity'] * $item['price'];
                        }
                        echo $total . ' €';
                        ?>
                    </span>
                </h3>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <a href="/checkout" class="btn btn-success">Procéder au paiement</a>
            </div>
        </div>
    <?php else : ?>
        <div class="alert alert-info text-center" role="alert">
            Votre panier est vide.
        </div>
    <?php endif; ?>
</div>
