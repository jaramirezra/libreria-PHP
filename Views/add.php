<?php 
include 'header.php'; 
$editing = isset($site) ? true : false;
?>
<body>
    <div class="container mt-4">
        <div class="list-container">
            <h1><?= $editing ? 'Editar Registro' : 'Crear Registro'; ?></h1>
            <form method="POST" action="sites">
                <div class="row mt-4 mb-4">
                    <div class="col-sm-6">
                        <label for="name" class="form-label">Nombre:</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= $editing ? htmlspecialchars($site['name']) : ''; ?>" required>
                    </div>
                    <div class="col-sm-6">
                        <label for="url" class="form-label">Enlace:</label>
                        <input type="text" class="form-control" id="url" name="url" required value="<?= $editing ? htmlspecialchars($site['url']) : ''; ?>" required>
                    </div>
                    <div class="col-sm-6 mt-3">
                        <label for="category_id" class="form-label">Categoria:</label>
                        <select class="form-select" name="category_id" id="category_id">
                            <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id']; ?>" <?= ($editing && $category['id'] == $site['category_id']) ? 'selected' : ''; ?>><?= htmlspecialchars($category['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                        <?php if ($editing): ?>
                            <input type="hidden" name="id" value="<?= $site['id']; ?>">
                        <?php endif; ?>
                    </div>
                </div>

                <div class="col-3 mx-auto">
                    <button class="btn btn-outline-success" type="submit">Guardar</button>
                    <a href="home" class="btn btn-outline-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>

    </div>
    <?php include 'footer.php'; ?>
</body>
</html>