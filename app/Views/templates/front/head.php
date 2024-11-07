<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <title><?= $title ?></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js" integrity="sha512-GWzVrcGlo0TxTRvz9ttioyYJ+Wwk9Ck0G81D+eO63BaqHaJ3YZX9wuqjwgfcV/MrB2PhaVX9DkYVhbFpStnqpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

<header>
    <nav class="navbar navbar-expand-lg bg-dark border-bottom border-body" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?= base_url('/'); ?>">Accueil</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/user'); ?>">Utilisateurs</a>
                    </li>
                    <!-- Onglet Produits -->
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/product'); ?>">Produits</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/product/client'); ?>">Produits-Clients</a>
                    </li>
                </ul>

                <!-- Bouton de déconnexion avec logo -->
                <ul class="navbar-nav ms-auto">

                    <!-- Onglet Panier (déplacé à droite) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="<?= base_url('/cart'); ?>" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Panier <span class="badge rounded-pill text-bg-light"><?= isset($cart) ? $cart['count'] : '0'; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-2 text-end">
                            <table class="table table-sm table-bordered text-center">
                                <thead>
                                <tr>
                                    <th>Nom produit</th>
                                    <th>Quantité</th>
                                    <th>Prix</th>
                                    <th>Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach($cart['items'] as $product): ?>
                                    <tr>
                                        <td class="text-truncate"><?= $product['name']; ?></td>
                                        <td><?= $product['quantity']; ?></td>
                                        <td><?= $product['price']; ?></td>
                                        <td><?= $product['quantity'] * $product['price']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                            <div class="text-end mt-2">
                                <h3>Total : <?= $cart['total']; ?> €</h3>
                            </div>
                            <a href="<?= base_url('/cart'); ?>" class="btn btn-secondary mt-2">Voir le panier</a>
                        </ul>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/login'); ?>">
                            <i class="fas fa-sign-in-alt"></i> Se déconnecter
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

</body>
</html>
