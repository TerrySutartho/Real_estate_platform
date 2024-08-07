<?php

require_once '../entity/Properties.php';

class deletePropertyListingController {
    private $Properties;

    public function __construct() {
        $this->Properties = new Properties();
    }

    public function deletePropertyListing() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['property_id'])) {
            $propertyId = intval($_POST['property_id']);

            // Attempt to delete the listing and respond
            if ($this->Properties->deletePropertyListing($propertyId)) {
                echo json_encode(['success' => true, 'message' => 'Property deleted successfully.']);
            }
        }
    }
}

// Instantiate the controller class
$deletePropertyListingController = new DeletePropertyListingController();

// Call the method to handle property listing deletion
$deletePropertyListingController->deletePropertyListing();

?>
