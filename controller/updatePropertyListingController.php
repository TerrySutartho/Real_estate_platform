<?php

require_once '../entity/Properties.php';

class UpdatePropertyListingController {
    private $Properties;

    public function __construct() {
        $this->Properties = new Properties();
    }

    public function updateListing() {
        // Retrieve data from POST request
        $property_id = $_POST['property_id'] ?? ''; // Use null coalescing operator to handle cases where it might not be set
        $address = $_POST['address'] ?? '';
        $price = $_POST['price'] ?? '';

        // Convert price to float to ensure correct data type
        $price = floatval($price);

        // Call the updateListing method from the Properties class
        $result = $this->Properties->updateListing($property_id, $address, $price);
        echo $result;  // Assuming that updateListing returns JSON formatted string
    }
}

// Instantiate the controller and call the update method
$UpdatePropertyListingController = new UpdatePropertyListingController();
$UpdatePropertyListingController->updateListing();

?>
