<?php include 'header.php'; ?>

<body>
    <div class="container mt-4">
        <div class="list-container">
            <h1>Mis sitios favoritos</h1>
            <div class="d-grid gap-2 d-md-block mt-4 mb-4">
                <a href="<?php echo BASE_URL; ?>create" class="btn btn-outline-success">Crear</a>
                <a href="<?php echo BASE_URL; ?>categories" class="btn btn-outline-success">Categorías</a>
            </div>

            <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Enlace</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sites as $site): ?>
                        <tr>
                            <td><?= htmlspecialchars($site['name']); ?></td>
                            <td><a href="<?= htmlspecialchars($site['url']); ?>" target="_blank"><?= htmlspecialchars($site['url']); ?></a></td>
                            <td><?= htmlspecialchars($site['category_name']); ?></td>
                            <td>
                                <a href="<?php echo BASE_URL; ?>edit?id=<?= $site['id']; ?>" class="btn btn-sm btn-outline-primary">Editar</a>
                                <form method="POST" action="<?php echo BASE_URL; ?>delete?id=<?= $site['id']; ?>" style="display:inline;">
                                    <button type="submit" class="btn btn btn-sm btn-outline-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este sitio?');">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
    <?php include 'footer.php'; ?>
    <script>window.BASE_URL = "<?php echo BASE_URL; ?>";</script>
    <script src="../assets/js/landing.js"></script>

</body>

</html>