<?php

namespace Andres\LibreriaPhp\Controllers;

use Andres\LibreriaPhp\Models\Category;

class CategoryController
{
    private $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    public function index()
    {
        $categories = $this->categoryModel->all();
        require_once __DIR__ . '/../../Views/categories/index.php';
    }

    public function create()
    {
        require_once __DIR__ . '/../../Views/categories/add.php';
    }

    public function edit($id)
    {
        $category = $this->categoryModel->find($id);

        if (!$category) {
            // Manejar error si no existe
            die("Categoría no encontrada");
        }

        require_once __DIR__ . '/../../Views/categories/add.php';
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $status = $_POST['status'] ?? 1;
            $id = $_POST['id'] ?? null;

            if ($id) {
                // Actualizar categoría existente
                $this->categoryModel->update($id, ['name' => $name]);

                header('Location: /');
                exit;
            }

            if (!empty($name)) {
                $this->categoryModel->create(['name' => $name, 'status' => $status]);

                // Redireccionar o mostrar mensaje de éxito
                header('Location: categories');
                exit;
            }
        }
    }

    // Actualizar categoría existente
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $status = $_POST['status'] ?? 1;

            if (!empty($name)) {
                $this->categoryModel->update($id, ['name' => $name, 'status' => $status]);

                header('Location: /git/libreria-PHP/public/');
                exit;
            }
        }
    }

    // Eliminar categoría
    public function delete($id)
    {
        $this->categoryModel->delete($id);
        header('Location: /git/libreria-PHP/public/');
        exit;
    }

    // Mostrar una sola categoría
    public function show($id)
    {
        $category = $this->categoryModel->find($id);

        if (!$category) {
            die("Categoría no encontrada");
        }

        require_once __DIR__ . '/../../Views/categories/show.php';
    }
}
