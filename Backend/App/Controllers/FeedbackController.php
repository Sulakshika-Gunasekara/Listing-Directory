<?php

// Backend/App/Controllers/FeedbackController.php

require_once __DIR__ . '/../Models/Feedback.php';

class FeedbackController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        header('Content-Type: application/json');
        try {
            $feedbacks = Feedback::all();
            echo json_encode($feedbacks);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Error retrieving feedbacks: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        header('Content-Type: application/json');
        try {
            $feedback = Feedback::find($id);
            if ($feedback) {
                echo json_encode($feedback);
            } else {
                http_response_code(404);
                echo json_encode(['message' => 'Feedback not found.']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Error retrieving feedback: ' . $e->getMessage()]);
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
            if (Feedback::create($data)) {
                http_response_code(201);
                echo json_encode(['message' => 'Feedback created successfully.']);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Failed to create feedback.']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Error creating feedback: ' . $e->getMessage()]);
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
            if (Feedback::update($id, $data)) {
                echo json_encode(['message' => 'Feedback updated successfully.']);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Failed to update feedback.']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Error updating feedback: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        header('Content-Type: application/json');
        try {
            if (Feedback::delete($id)) {
                echo json_encode(['message' => 'Feedback deleted successfully.']);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Failed to delete feedback.']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Error deleting feedback: ' . $e->getMessage()]);
        }
    }
}
