<?php include __DIR__ . '/../header.php'; ?>

<body>
    <div class="container mt-4">
        <div class="list-container">
            <h1>Categoría</h1>
            <div class="d-grid gap-2 d-md-block mt-4 mb-4">
                <a href="<?= BASE_URL; ?>categories/create" class="btn btn-outline-success">Crear</a>
                <a href="<?= BASE_URL; ?>home" class="btn btn-outline-secondary">Cancelar</a>
            </div>

            <div class="mt-3 mb-3">
                <table id="categories" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th width="160">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $counter = 1;
                        foreach ($categories as $category): 
                        ?>
                            <tr>
                                <td><?= $counter++; ?></td>
                                <td><?= htmlspecialchars($category['name']); ?></td>
                                <td>
                                    <a href="<?= BASE_URL; ?>categories/edit?id=<?= $category['id']; ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                                    <button type="button" class="btn btn-sm btn-outline-danger" onclick="deleteCategory(<?= $category['id']; ?>)">Eliminar</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    </div>
    <?php include __DIR__ . '/../footer.php'; ?>
    <script>window.BASE_URL = "<?= BASE_URL; ?>";</script>
    <script src="<?= BASE_URL; ?>../assets/js/categories.js"></script>
</body>

</html>