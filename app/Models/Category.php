<?php

namespace Andres\LibreriaPhp\Models;

require_once __DIR__ . '/../../config/database.php';

class Category
{
    // Obtener todas las categorías
    public static function all()
    {
        $pdo = \Database::getInstance();
        $sql = "SELECT * FROM categories";
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Encontrar una categoría por ID
    public static function find($id)
    {
        $pdo = \Database::getInstance();
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Crear una nueva categoría
    public static function create($data)
    {
        $pdo = \Database::getInstance();
        $sql = "INSERT INTO categories (name, status, created_at) VALUES (:name, :status, :created_at)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $data['name'],
            ':status' => $data['status'] ?? 1,
            ':created_at' => date('Y-m-d H:i:s')
        ]);
    }

    // Actualizar una categoría existente
    public static function update($id, $data)
    {
        $pdo = \Database::getInstance();
        $sql = "UPDATE categories SET name = :name, status = :status WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name' => $data['name'],
            ':status' => $data['status'] ?? 1,
            ':id' => $id
        ]);
    }

    // Eliminar una categoría
    public static function delete($id)
    {
        $pdo = \Database::getInstance();
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $id]);
    }
}
