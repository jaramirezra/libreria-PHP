<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Andres\LibreriaPhp\Controllers\HomeController;
use Andres\LibreriaPhp\Controllers\CategoryController;

class Router
{
    private $basePath = '/git/libreria-PHP/public';
    private $request;
    private $method;
    private $queryParams;

    public function __construct()
    {
        $this->queryParams = $_GET;
        $this->request = $this->parseRequest();
        $this->method = $_SERVER['REQUEST_METHOD'];
    }

    private function parseRequest(): string
    {
        $request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $request = rtrim($request, '/');

        // Remover .php si existe
        $request = preg_replace('/\.php$/', '', $request);

        $request = str_replace($this->basePath, '', $request);
        return $request === '' ? '/' : $request;
    }

    public function route(): void
    {
        // Rutas de categorías
        if ($this->matchRoute('/categories')) {
            $this->handleCategories();
            return;
        }

        // Rutas de sitios
        if ($this->matchRoute('/sites')) {
            $this->handleSites();
            return;
        }

        // Rutas principales
        $this->handleHome();
    }

    private function matchRoute(string $pattern): bool
    {
        return strpos($this->request, $pattern) === 0;
    }

    private function handleCategories(): void
    {
        $categoryController = new CategoryController();
        $parts = $this->getRouteParts('/categories');

        // GET /categories
        if ($this->method === 'GET' && empty($parts)) {
            $categoryController->index();
            exit;
        }

        // GET /categories/create
        if ($this->method === 'GET' && count($parts) === 1 && $parts[0] === 'create') {
            $categoryController->create();
            exit;
        }

        // GET /categories/{id}/edit
        if ($this->method === 'GET' && count($parts) === 2 && is_numeric($parts[0]) && $parts[1] === 'edit') {
            $categoryController->edit((int)$parts[0]);
            exit;
        }

        // POST /categories
        if ($this->method === 'POST' && empty($parts)) {
            $categoryController->store();
            exit;
        }

        // POST /categories/{id}
        if ($this->method === 'POST' && count($parts) === 1 && is_numeric($parts[0])) {
            $categoryController->update((int)$parts[0]);
            exit;
        }

        // POST /categories/{id}/delete
        if ($this->method === 'POST' && count($parts) === 2 && is_numeric($parts[0]) && $parts[1] === 'delete') {
            $categoryController->delete((int)$parts[0]);
            exit;
        }

        // Si no coincide ninguna ruta, mostrar 404
        $this->notFound();
    }

    private function handleSites(): void
    {
        $siteController = new HomeController();
        $parts = $this->getRouteParts('/sites');

        // POST /sites
        if ($this->method === 'POST' && empty($parts)) {
            $siteController->store($_POST);
            exit;
        }

        $this->notFound();
    }

    private function handleHome(): void
    {
        $controller = new HomeController();

        // Manejar DELETE (usando POST con campo _method)
        if ($this->method === 'POST') {
            if (strpos($this->request, '/delete') === 0) {
                // Obtener ID de query parameter o de la ruta
                $id = null;

                // Intentar obtener de query parameter primero
                if (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $id = (int)$_GET['id'];
                }
                // Si no, intentar de la ruta /delete/{id}
                else {
                    $parts = explode('/', trim($this->request, '/'));
                    if (count($parts) === 2 && $parts[0] === 'delete' && is_numeric($parts[1])) {
                        $id = (int)$parts[1];
                    }
                }

                if ($id !== null) {
                    $controller->delete($id);
                    exit;
                }
            }
            
            // Para store desde /create
            if ($this->request === '/create') {
                $controller->store($_POST);
                exit;
            }
        }

        // Manejar GET
        switch ($this->request) {
            case '/':
            case '/home':
            case '/index':
                $controller->index();
                break;
            case '/create':
                $controller->create();
                break;
            case '/edit':
                if (isset($this->queryParams['id']) && is_numeric($this->queryParams['id'])) {
                    $controller->edit($this->queryParams['id']);
                } else {
                    $this->notFound();
                }
                break;
            default:
                $this->notFound();
                break;
        }
    }

    private function getRouteParts(string $prefix): array
    {
        $pathWithoutPrefix = str_replace($prefix, '', $this->request);
        $pathWithoutPrefix = trim($pathWithoutPrefix, '/');

        if (empty($pathWithoutPrefix)) {
            return [];
        }

        return explode('/', $pathWithoutPrefix);
    }

    private function notFound(): void
    {
        http_response_code(404);
        require __DIR__ . '/../Views/404.php';
        exit;
    }
}

// Inicializar y ejecutar el router
$router = new Router();
$router->route();
