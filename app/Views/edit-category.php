<form method="POST" action="/category/<?= isset($category['id']) ? 'update':'create'; ?>">
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
                        <h4 class="card-title"><?= isset($category['id']) ? 'Modifier' : 'Créer' ?> la catégorie</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3 row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="name" name="name" value="<?= isset($category) ? $category['name'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <?php if(isset($category['id'])){ ?>
                            <input type="hidden" name="id" value="<?= $category['id']; ?>">
                        <?php } ?>
                        <button class="btn btn-primary" type="submit"><?= isset($category['id']) ? "Modifier" : "Créer"; ?></button></div>
                </div>
            </div>
        </div>
    </div>
</form>