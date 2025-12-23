<?php

namespace Andres\LibreriaPhp\Controllers;

use Andres\LibreriaPhp\Models\Category;
use Exception;

class CategoryController
{
    private $categoryModel;

    // Constructor
    public function __construct()
    {
        $this->categoryModel = new Category();
    }

    // Listar todas las categorías
    public function index()
    {
        $categories = $this->categoryModel->all();
        require_once __DIR__ . '/../../Views/categories/index.php';
    }

    // Mostrar formulario para crear nueva categoría
    public function create()
    {
        require_once __DIR__ . '/../../Views/categories/add.php';
    }

    // Mostrar formulario para editar categoría existente
    public function edit($id)
    {
        $category = $this->categoryModel->find($id);

        if (!$category) {
            // Manejar error si no existe
            die("Categoría no encontrada");
        }

        require_once __DIR__ . '/../../Views/categories/add.php';
    }

    // Guardar nueva categoría o actualizar existente
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $status = $_POST['status'] ?? 1;
            $id = $_POST['id'] ?? null;

            // Validación
            if (empty($name)) {
                $_SESSION['error'] = 'El nombre de la categoría es requerido';
                $redirect = $id ? 'categories/' . $id . '/edit' : 'categories/create';
                header('Location: ' . BASE_URL . $redirect);
                exit;
            }

            try {
                if ($id) {
                    $this->categoryModel->update($id, ['name' => $name, 'status' => $status]);
                    $_SESSION['success'] = 'Categoría actualizada correctamente';
                } else {
                    $this->categoryModel->create(['name' => $name, 'status' => $status]);
                    $_SESSION['success'] = 'Categoría creada correctamente';
                }

                header('Location: ' . BASE_URL . 'categories');
                exit;
            } catch (Exception $e) {
                $_SESSION['error'] = 'Error al guardar la categoría: ' . $e->getMessage();
                $redirect = $id ? 'categories/' . $id . '/edit' : 'categories/create';
                header('Location: ' . BASE_URL . $redirect);
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
        header('Location: /git/libreria-PHP/public/categories');
        exit;
    }
}
