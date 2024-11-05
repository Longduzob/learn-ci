<br>
<h1 class="text-center">Votre Panier</h1>
<br>

<div class="container">
<?php if (isset($cart) && !empty($cart)) : ?>
    <table class="table">
        <thead>
        <tr>
            <th>Produit</th>
            <th>Quantité</th>
            <th>Prix Unitaire</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($cart as $item) : ?>
            <tr>
                <td><?= esc($item['name']); ?></td>
                <td><?= esc($item['quantity']); ?></td>
                <td><?= esc($item['price']); ?> €</td>
                <td><?= esc($item['quantity'] * $item['price']); ?> €</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div>
        <br>
        <h3>Total du panier : <span  style="text-decoration: underline">
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
</div>
<?php else : ?>
    <p class="text-center">Votre panier est vide.</p>
<?php endif; ?>
