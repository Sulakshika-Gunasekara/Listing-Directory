<?php

// Backend/App/Controllers/VendorController.php

require_once __DIR__ . '/../Models/Vendor.php';

class VendorController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        header('Content-Type: application/json');
        try {
            $vendors = Vendor::all();
            echo json_encode($vendors);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Error retrieving vendors: ' . $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        header('Content-Type: application/json');
        try {
            $vendor = Vendor::find($id);
            if ($vendor) {
                echo json_encode($vendor);
            } else {
                http_response_code(404);
                echo json_encode(['message' => 'Vendor not found.']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Error retrieving vendor: ' . $e->getMessage()]);
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
            if (Vendor::create($data)) {
                http_response_code(201);
                echo json_encode(['message' => 'Vendor created successfully.']);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Failed to create vendor.']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Error creating vendor: ' . $e->getMessage()]);
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
            if (Vendor::update($id, $data)) {
                echo json_encode(['message' => 'Vendor updated successfully.']);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Failed to update vendor.']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Error updating vendor: ' . $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        header('Content-Type: application/json');
        try {
            if (Vendor::delete($id)) {
                echo json_encode(['message' => 'Vendor deleted successfully.']);
            } else {
                http_response_code(400);
                echo json_encode(['message' => 'Failed to delete vendor.']);
            }
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['message' => 'Error deleting vendor: ' . $e->getMessage()]);
        }
    }
}
