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
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        header('Content-Type: application/json');

        $name   = trim($_POST['name'] ?? '');
        $status = $_POST['status'] ?? 1;
        $id     = $_POST['id'] ?? null;

        if ($name === '') {
            echo json_encode(['success' => false,'message' => 'El nombre de la categoría es requerido.']);
            exit;
        }

        if ($id) {
            $this->categoryModel->update($id, compact('name', 'status'));
            $message = 'Categoría actualizada correctamente.';
        } else {
            $this->categoryModel->create(compact('name', 'status'));
            $message = 'Categoría creada correctamente.';
        }

        echo json_encode(['success' => true,'message' => $message]);
        exit;
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
        // Verificar si la categoría está siendo usada por sitios activos
        $pdo = \Database::getInstance();
        $sql = "SELECT COUNT(*) FROM sites WHERE category_id = :id AND status = 1";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        $count = $stmt->fetchColumn();

        header('Content-Type: application/json');
        if ($count > 0) {
            echo json_encode(['error' => true, 'message' => 'No se puede eliminar la categoría porque está siendo utilizada por uno o más sitios activos.']);
        } else {
            $this->categoryModel->delete($id);
            echo json_encode(['success' => true, 'message' => 'Categoría eliminada correctamente.']);
        }
        exit;
    }
}
