<form method="POST" action="/product/<?= isset($product['id']) ? 'update':'create'; ?>">
    <div class="container">
        <?php if (isset($errors)) { ?>
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <?php foreach($errors as $error) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $error ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        <?php } ?>
        <br>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"><?= isset($product['id']) ? 'Modifier' : 'Créer' ?> le produit</h4>
                    </div>
                    <div class="card-body">

                        <div class="mb-3 row">
                            <label for="name" class="col-sm-2 col-form-label">Nom</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" value="<?= isset($product) ? $product['name'] : ''; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="price" class="col-sm-2 col-form-label">Prix</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="price" name="price" value="<?= isset($product) ? $product['price'] : ''; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="quantity" class="col-sm-2 col-form-label">Quantité</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="quantity" name="quantity"
                                       value="<?= isset($product) ? $product['quantity'] : ''; ?>">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="category" class="col-sm-2 col-form-label">Catégorie</label>
                            <div class="col-sm-10">
                                <select id="category" name="id_category" class="form-control">
                                    <?php if (!empty($categorys)): ?>
                                        <?php foreach ($categorys as $category): ?>
                                            <option value="<?= ($category['id']); ?>"><?= ($category['name']); ?></option>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <option disabled>Aucune catégorie disponible</option>
                                    <?php endif; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?php if(isset($product['id'])){ ?>
                            <input type="hidden" name="id" value="<?= $product['id']; ?>">
                        <?php } ?>
                        <button class="btn btn-primary" type="submit"><?= isset($product['id']) ? "Modifier" : "Créer"; ?></button></div>
                </div>
            </div>
        </div>
    </div>
</form>