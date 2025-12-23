<?php

namespace Andres\LibreriaPhp\Controllers;

use Andres\LibreriaPhp\Models\Category;
use Andres\LibreriaPhp\Models\Site;

class HomeController
{
    private $categoryModel;
    private $siteModel;

    // Constructor para inicializar los modelos
    public function __construct()
    {
        $this->categoryModel = new Category();
        $this->siteModel = new Site();
    }
    
    // Mostrar la página de inicio con la lista de sitios
    public function index()
    {
        $sites = $this->siteModel->all();
        include __DIR__ . '/../../Views/home.php';
    }

    // Mostrar formulario para crear un registro
    public function create()
    {
        $categories = $this->categoryModel->all();
        include __DIR__ . '/../../Views/add.php';
    }

    // Mostrar formulario para editar un registro
    public function edit($id)
    {
        $site = $this->siteModel->find($id);
        if (!$site) {
            // Manejar error si no existe
            die("Sitio no encontrado");
        }
        $categories = $this->categoryModel->all();
        include __DIR__ . '/../../Views/add.php';
    }

    // Guardar o actualizar un registro
    public function store($data)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $data['id'] ?? null;
            if ($id) {
                $this->siteModel->update($id, $data);
            } else {
                $this->siteModel->create($data);
            }
            header('Location: home');
        }
    }

    public function delete($id)
    {
        $this->siteModel->delete($id);
        header('Location: home');
    }
}

?>