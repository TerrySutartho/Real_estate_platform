<?php

require_once '../entity/Properties.php';

class getPropertyListingController {
    private $Properties;

    public function __construct() {
        $this->Properties = new Properties();
    }

    public function getListing() {
        $address = $_POST['address'] ?? '';
        $agent_id = $_POST['agent_id'] ?? '';  // Capture agent_id from the POST request

        $properties = $this->Properties->getListing($address,$agent_id);
        if ($properties !== null) {
            echo json_encode(array('success' => true, 'data' => $properties));
        } else {
            echo json_encode(array('success' => false, 'data' => "No relevant properties found."));
        }
    }
}

$controller = new getPropertyListingController();
$controller->getListing();

?>
