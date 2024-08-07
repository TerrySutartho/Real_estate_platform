<?php

require_once '../entity/Properties.php';

class viewPropertyListingController {
    private $Properties;

    public function __construct() {
        $this->Properties = new Properties();
    }

    public function getListingById() {
        header('Content-Type: application/json');
        $property_id = $_GET['property_id'] ?? '';

        $property = $this->Properties->getListingById($property_id);

        echo json_encode(['success' => true, 'data' => $property]);
        
    }
}

$controller = new viewPropertyListingController();
$controller->getListingById();
?>
