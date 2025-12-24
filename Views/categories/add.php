<?php
include __DIR__ . '/../header.php';
$editing = isset($category) ? true : false;
?>

<body>
    <div class="container mt-4">
        <div class="list-container">
            <h1><?= $editing ? 'Editar Categoría' : 'Crear Categoría'; ?></h1>
            <form method="POST" action="<?= BASE_URL; ?><?= $editing ? 'categories/' . $category['id'] : 'categories'; ?>" id="categoryForm">
                <div class="row mt-3 mb-3">
                    <div class="col-sm-12">
                        <label for="name" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $editing ? $category['name'] : ''; ?>">
                    </div>
                    <?php if ($editing): ?>
                        <input type="hidden" name="id" value="<?= $category['id']; ?>">
                    <?php endif; ?>
                </div>

                <div class="col-3 mx-auto">
                    <button class="btn btn-outline-success" type="submit">Guardar</button>
                    <a href="<?= BASE_URL; ?>categories" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    </div>
    <?php include __DIR__ . '/../footer.php'; ?>
    <script>window.BASE_URL = "<?= BASE_URL; ?>";</script>
    <script src="<?= BASE_URL; ?>../assets/js/categories.js"></script>
</body>

</html>