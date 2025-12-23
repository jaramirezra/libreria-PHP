<?php

namespace Andres\LibreriaPhp\Models;

require_once __DIR__ . '/../../config/database.php';

class Site
{
    // Obtener todos los sitios
    public static function all()
    {
        $pdo = \Database::getInstance();
        $sql = "SELECT s.*, c.name as category_name FROM sites s LEFT JOIN categories c ON s.category_id = c.id WHERE s.status = 1";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Encontrar un sitio por ID
    public static function find($id)
    {
        $pdo = \Database::getInstance();
        $sql = "SELECT * FROM sites WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    
    // Crear un nuevo sitio
    public static function create($data)
    {
        $pdo = \Database::getInstance();
        $sql = "INSERT INTO sites (name, url, category_id, status, created_at) VALUES (:name, :url, :category_id, :status, :created_at)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $data['name'],
            ':url' => $data['url'],
            ':category_id' => $data['category_id'],
            ':status' => $data['status'] ?? 1,
            ':created_at' => date('Y-m-d H:i:s')
        ]);
    }

    // Actualizar un sitio existente
    public static function update($id, $data)
    {
        $pdo = \Database::getInstance();
        $sql = "UPDATE sites SET name = :name, url = :url, category_id = :category_id WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $data['name'],
            ':url' => $data['url'],
            ':category_id' => $data['category_id'],
            ':id' => $id
        ]);
    }

    // Eliminar un sitio
    public static function delete($id)
    {
        $pdo = \Database::getInstance();
        $sql = "UPDATE sites SET status = 0 WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}