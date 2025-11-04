<?php

// Backend/App/Models/Feedback.php

require_once __DIR__ . '/../Database.php';

class Feedback
{
    /**
     * Get all feedbacks from the database.
     *
     * @return array
     */
    public static function all()
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->query('SELECT * FROM feedbacks');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Find a feedback by its ID.
     *
     * @param int $id
     * @return mixed
     */
    public static function find($id)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare('SELECT * FROM feedbacks WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Create a new feedback.
     *
     * @param array $data
     * @return bool
     */
    public static function create($data)
    {
        $pdo = Database::getInstance()->getConnection();
        $sql = "INSERT INTO feedbacks (user_name, email, subject, message, created_at) VALUES (:user_name, :email, :subject, :message, NOW())";
        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'subject' => $data['subject'],
            'message' => $data['message']
        ]);
    }

    /**
     * Update a feedback.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public static function update($id, $data)
    {
        $pdo = Database::getInstance()->getConnection();
        $sql = "UPDATE feedbacks SET user_name = :user_name, email = :email, subject = :subject, message = :message WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            'id' => $id,
            'user_name' => $data['user_name'],
            'email' => $data['email'],
            'subject' => $data['subject'],
            'message' => $data['message']
        ]);
    }

    /**
     * Delete a feedback.
     *
     * @param int $id
     * @return bool
     */
    public static function delete($id)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare('DELETE FROM feedbacks WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
