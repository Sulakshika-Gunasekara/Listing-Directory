<?php

// Backend/App/Controllers/ReviewController.php

require_once __DIR__ . '/../Models/Review.php';

class ReviewController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        header('Content-Type: application/json');
        try {
            $reviews = Review::all();
            echo json_encode($reviews);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Error retrieving reviews: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        header('Content-Type: application/json');
        try {
            $review = Review::find($id);
            if ($review) {
                echo json_encode($review);
            } else {
                http_response_code(404);
                echo json_encode(['message' => 'Review not found.']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Error retrieving review: ' . $e->getMessage()]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        try {
            if (Review::create($data)) {
                http_response_code(201);
                echo json_encode(['message' => 'Review created successfully.']);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Failed to create review.']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Error creating review: ' . $e->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id)
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        try {
            if (Review::update($id, $data)) {
                echo json_encode(['message' => 'Review updated successfully.']);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Failed to update review.']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Error updating review: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        header('Content-Type: application/json');
        try {
            if (Review::delete($id)) {
                echo json_encode(['message' => 'Review deleted successfully.']);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Failed to delete review.']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Error deleting review: ' . $e->getMessage()]);
        }
    }
}
