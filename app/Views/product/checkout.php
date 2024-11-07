<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>
<div class="container mt-5 mb-5">
    <h3 class="mb-4">Récapitulatif de votre commande</h3>

    <!-- Affichage des produits dans le panier -->
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>Nom du produit</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach($cart['items'] as $item): ?>
            <tr>
                <td><?= $item['name']; ?></td>
                <td><?= $item['quantity']; ?></td>
                <td><?= $item['price']; ?> €</td>
                <td><?= $item['quantity'] * $item['price']; ?> €</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h4 class="text-end">Total: <?= $cart['total']; ?> €</h4>

    <!-- Formulaire de checkout -->
    <form action="<?= base_url('/checkout/processOrder'); ?>" method="POST">
        <!-- Adresse de facturation -->
        <h5 class="mt-4">Adresse de facturation</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="billing_first_name" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="billing_first_name" name="billing_first_name" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="billing_last_name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="billing_last_name" name="billing_last_name" required>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="billing_address" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="billing_address" name="billing_address" required>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="billing_city" class="form-label">Ville</label>
                    <input type="text" class="form-control" id="billing_city" name="billing_city" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="billing_postal_code" class="form-label">Code postal</label>
                    <input type="text" class="form-control" id="billing_postal_code" name="billing_postal_code" required>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="billing_country" class="form-label">Pays</label>
            <select class="form-select" id="billing_country" name="billing_country" required>
                <option value="France">France</option>
                <option value="Belgique">Belgique</option>
                <option value="Suisse">Suisse</option>
                <!-- Ajoutez d'autres pays si nécessaire -->
            </select>
        </div>

        <br>
        <!-- Case pour copier l'adresse de facturation vers l'adresse de livraison -->
        <div class="form-check mb-3">
            <input class="form-check-input" type="checkbox" id="same_as_billing" name="same_as_billing">
            <label class="form-check-label" for="same_as_billing">
                <strong>Utiliser la même adresse pour la livraison ?</strong>
            </label>
        </div>


        <br>
        <!-- Adresse de livraison -->
        <h5 class="mt-4">Adresse de livraison</h5>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="shipping_first_name" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="shipping_first_name" name="shipping_first_name" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="shipping_last_name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="shipping_last_name" name="shipping_last_name" required>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="shipping_address" class="form-label">Adresse</label>
            <input type="text" class="form-control" id="shipping_address" name="shipping_address" required>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="shipping_city" class="form-label">Ville</label>
                    <input type="text" class="form-control" id="shipping_city" name="shipping_city" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="shipping_postal_code" class="form-label">Code postal</label>
                    <input type="text" class="form-control" id="shipping_postal_code" name="shipping_postal_code" required>
                </div>
            </div>
        </div>
        <div class="mb-3">
            <label for="shipping_country" class="form-label">Pays</label>
            <select class="form-select" id="shipping_country" name="shipping_country" required>
                <option value="France">France</option>
                <option value="Belgique">Belgique</option>
                <option value="Suisse">Suisse</option>
                <!-- Ajoutez d'autres pays si nécessaire -->
            </select>
        </div>

        <br>
        <!-- Informations de paiement -->
        <h5 class="mt-4">Informations de paiement</h5>
        <div class="mb-3">
            <label for="payment_method" class="form-label">Méthode de paiement</label>
            <select class="form-select" id="payment_method" name="payment_method" required>
                <option value="" disabled selected>Choisir une méthode de paiement</option>
                <option value="credit_card">Carte de crédit</option>
                <option value="paypal">PayPal</option>
                <!-- Ajoutez d'autres méthodes de paiement si nécessaire -->
            </select>
        </div>
        <div class="mb-3" id="credit_card_info" style="display:none;">
            <label for="credit_card_number" class="form-label">Nom et Prénom du titulaire de la carte</label>
            <input type="text" class="form-control" id="credit_card_number" name="credit_card_number" placeholder="Nom / Prénom">
            <label for="credit_card_number" class="form-label">Numéro de carte</label>
            <input type="number" class="form-control" id="credit_card_number" name="credit_card_number" placeholder="xxxx-xxxx-xxxx-xxxx">
            <label for="credit_card_number" class="form-label">Expire le</label>
            <input type="number" class="form-control" id="credit_card_number" name="credit_card_number" placeholder="xx/xx">
            <label for="credit_card_number" class="form-label">Code secret</label>
            <input type="number" class="form-control" id="credit_card_number" name="credit_card_number" placeholder="xxx">
        </div>
        <div class="mb-3" id="paypal_info" style="display:none;">
            <label for="paypal_email" class="form-label">Email PayPal</label>
            <input type="email" class="form-control" id="paypal_email" name="paypal_email" placeholder="exemple@paypal.com">
        </div>

        <br>
        <!-- Soumettre la commande -->
        <button type="submit" class="btn btn-success btn-lg mt-4">Confirmer la commande</button>
    </form>
</div>

<script>
    // Fonction pour gérer l'auto-remplissage des champs de livraison
    document.getElementById('same_as_billing').addEventListener('change', function() {
        var isChecked = this.checked;
        if (isChecked) {
            document.getElementById('shipping_first_name').value = document.getElementById('billing_first_name').value;
            document.getElementById('shipping_last_name').value = document.getElementById('billing_last_name').value;
            document.getElementById('shipping_address').value = document.getElementById('billing_address').value;
            document.getElementById('shipping_city').value = document.getElementById('billing_city').value;
            document.getElementById('shipping_postal_code').value = document.getElementById('billing_postal_code').value;
            document.getElementById('shipping_country').value = document.getElementById('billing_country').value;
        } else {
            document.getElementById('shipping_first_name').value = '';
            document.getElementById('shipping_last_name').value = '';
            document.getElementById('shipping_address').value = '';
            document.getElementById('shipping_city').value = '';
            document.getElementById('shipping_postal_code').value = '';
            document.getElementById('shipping_country').value = 'France'; // Par défaut
        }
    });

    // Afficher les champs de paiement en fonction de la méthode choisie
    document.getElementById('payment_method').addEventListener('change', function() {
        var method = this.value;
        if (method === 'credit_card') {
            document.getElementById('credit_card_info').style.display = 'block';
            document.getElementById('paypal_info').style.display = 'none';
        } else if (method === 'paypal') {
            document.getElementById('credit_card_info').style.display = 'none';
            document.getElementById('paypal_info').style.display = 'block';
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
