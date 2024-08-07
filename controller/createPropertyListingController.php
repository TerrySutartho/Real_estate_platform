<?php

require_once '../entity/Properties.php';

class CreatePropertyListingController {
    private $Properties;

    public function __construct() {
        $this->Properties = new Properties();
    }


    public function createPropertyListing() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $address = $_POST['address'];
            $price = $_POST['price'];
            $agent_id = $_POST['agent_id'];
            $seller_id = $_POST['seller_id'];
    
            $price = floatval($price);
            $seller_id = intval($seller_id);
    
            $result = $this->Properties->createPropertyListing($address, $price, $agent_id, $seller_id);
    
            // Decode the result to check the success status
            $result_array = json_decode($result, true);
            if ($result_array['success']) {
                // If the listing was successfully created, redirect to viewPropertyListing with agent_id
                echo json_encode(['success' => true, 'message' => 'Property Created.']);
            } else {
                echo $result; // In case of an error, print the message
            }
        } else {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Invalid request method. Please use POST.']);
        }
    }
} 

$createPropertyListingController = new CreatePropertyListingController();
$createPropertyListingController->createPropertyListing();


?>
