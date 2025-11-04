<?php

// Backend/App/Models/Review.php

require_once __DIR__ . '/../Database.php';

class Review
{
    /**
     * Get all reviews from the database.
     *
     * @return array
     */
    public static function all()
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->query('SELECT * FROM reviews');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Find a review by its ID.
     *
     * @param int $id
     * @return mixed
     */
    public static function find($id)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare('SELECT * FROM reviews WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Create a new review.
     *
     * @param array $data
     * @return bool
     */
    public static function create($data)
    {
        $pdo = Database::getInstance()->getConnection();
        $sql = "INSERT INTO reviews (listing_id, user_name, rating, comment, created_at) VALUES (:listing_id, :user_name, :rating, :comment, NOW())";
        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            'listing_id' => $data['listing_id'],
            'user_name' => $data['user_name'],
            'rating' => $data['rating'],
            'comment' => $data['comment']
        ]);
    }

    /**
     * Update a review.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public static function update($id, $data)
    {
        $pdo = Database::getInstance()->getConnection();
        $sql = "UPDATE reviews SET listing_id = :listing_id, user_name = :user_name, rating = :rating, comment = :comment WHERE id = :id";
        $stmt = $pdo->prepare($sql);

        return $stmt->execute([
            'id' => $id,
            'listing_id' => $data['listing_id'],
            'user_name' => $data['user_name'],
            'rating' => $data['rating'],
            'comment' => $data['comment']
        ]);
    }

    /**
     * Delete a review.
     *
     * @param int $id
     * @return bool
     */
    public static function delete($id)
    {
        $pdo = Database::getInstance()->getConnection();
        $stmt = $pdo->prepare('DELETE FROM reviews WHERE id = :id');
        return $stmt->execute(['id' => $id]);
    }
}
