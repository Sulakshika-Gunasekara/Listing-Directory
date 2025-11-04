<?php
// backend/app/Http/Controllers/ListingController.php

require_once __DIR__ . '/../../Models/Listing.php';

class ListingController {
    private $listing;

    public function __construct() {
        $this->listing = new Listing();
    }

    public function getAll() {
        $listings = $this->listing->getAll();
        echo json_encode($listings);
    }

    public function getByCategory($categoryId) {
        $listings = $this->listing->getByCategory($categoryId);
        echo json_encode($listings);
    }
}
?>