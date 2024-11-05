<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Toastr CSS for Notifications -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">

    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- SweetAlert2 for Alerts -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand" href="http://localhost:8081" target="_blank">PHP</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- USER Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        USER
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="http://localhost:8080/user">Voir les Users</a></li>
                        <li><a class="dropdown-item" href="http://localhost:8080/user/new">Créer un User</a></li>
                    </ul>
                </li>

                <!-- PRODUCT Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="productDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        PRODUCT
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="productDropdown">
                        <li><a class="dropdown-item" href="http://localhost:8080/product">Voir les Products</a></li>
                        <li><a class="dropdown-item" href="http://localhost:8080/product/new">Créer un Product</a></li>
                    </ul>
                </li>

                <!-- CATEGORY -->
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost:8080/category" style="text-decoration: none">
                        CATEGORY
                        </a>
                    </li>
            </ul>



            <!-- Right-side buttons -->
            <div class="d-flex align-items-center">
                <!-- Bouton du panier avec dropdown -->
                <div class="dropdown">
                    <button class="btn btn-outline-success me-3 dropdown-toggle" type="button" id="cartDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </button>

                    <!-- Contenu du dropdown -->
                    <ul class="dropdown-menu dropdown-menu-end p-3" aria-labelledby="cartDropdown" style="min-width: 300px;">
                        <?php if (isset($cart) && !empty($cart)) : ?>
                            <?php foreach ($cart as $index => $item) : ?>
                                <tr>
                                    <td><?= esc($item['name']); ?></td>
                                    <td><?= esc($item['quantity']); ?></td>
                                    <td><?= esc($item['price']); ?> €</td>
                                    <td><?= esc($item['quantity'] * $item['price']); ?> €</td>
                                </tr>
                                <td><strong>Total : <?= esc($total); ?> €</strong></td>
                            <?php endforeach; ?>
                            <li class="mt-2">
                                <a href="/product/cart" class="btn btn-success w-100">Accéder au Panier</a>
                            </li>
                        <?php else : ?>
                            <p class="text-center">Votre panier est vide.</p>
                            <li class="mt-2">
                                <a href="/product/cart" class="btn btn-success w-100">Accéder au Panier</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!-- Logout Button -->
                <form method="POST" action="/login" style="display: inline;">
                    <button type="submit" class="btn btn-danger me-2">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </button>
                </form>
            </div>


        </div>
    </div>
</nav>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.1/dist/sweetalert2.all.min.js"></script>

<!-- Custom JS (Optional) -->
<script>
of SweetAlert2 Popup
    function showLogoutConfirmation() {
        Swal.fire({
            title: 'Êtes-vous sûr?',
            text: "Vous allez vous déconnecter.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Oui, déconnectez-moi!',
            cancelButtonText: 'Annuler'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/logout';
            }
        });
    }
</script>

</body>

</html>
