<?php

// Backend/App/Models/Vendor.php

require_once __DIR__ . '/../Database.php';

class Vendor
{
    /**
     * Get all vendors from the database.
     *
     * @return array
     */
    public static function all()
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->query('SELECT * FROM vendors');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Find a vendor by its ID.
     *
     * @param int $id
     * @return mixed
     */
    public static function find($id)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare('SELECT * FROM vendors WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Create a new vendor.
     *
     * @param array $data
     * @return bool
     */
    public static function create($data)
    {
        $pdo = Database::getInstance()->getConnection();
        $sql = "INSERT INTO vendors (name, contact_person, email, phone, description, created_at) VALUES (:name, :contact_person, :email, :phone, :description, NOW())";
        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            'name' => $data['name'],
            'contact_person' => $data['contact_person'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'description' => $data['description']
        ]);
    }

    /**
     * Update a vendor.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public static function update($id, $data)
    {
        $pdo = Database::getInstance()->getConnection();
        $sql = "UPDATE vendors SET name = :name, contact_person = :contact_person, email = :email, phone = :phone, description = :description WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            'id' => $id,
            'name' => $data['name'],
            'contact_person' => $data['contact_person'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'description' => $data['description']
        ]);
    }

    /**
     * Delete a vendor.
     *
     * @param int $id
     * @return bool
     */
    public static function delete($id)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare('DELETE FROM vendors WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
