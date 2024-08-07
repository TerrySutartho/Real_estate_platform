<?php 
// getSellerPropertiesC.php
require_once('../entity/Properties.php');
class getSellerPropertiesC{

    public function getProp(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $seller_id = $_POST['seller_id'];
            $prop = new Properties;
            $result = $prop->getSellerProp($seller_id);

            // Return the result as JSON
            header('Content-Type: application/json');

            echo json_encode(array('success' => true, 'data' => $result));
        }
    }
}

// Instantiate the class and call the search method
$getSellerPropertiesC = new getSellerPropertiesC();
$getSellerPropertiesC->getProp();
?>