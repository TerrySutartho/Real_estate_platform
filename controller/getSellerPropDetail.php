<?php 
// getSellerPropDetail.php
require_once('../entity/Properties.php');
class getSellerPropDetail{

    public function getDetail(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $prop_id = $_POST['prop_id'];
            $prop = new Properties;
            $result = $prop->getSellerPropDetail($prop_id);

            // Return the result as JSON
            header('Content-Type: application/json');

            echo json_encode(array('success' => true, 'data' => $result));
        }
    }
}

// Instantiate the class and call the search method
$getSellerPropDetail = new getSellerPropDetail();
$getSellerPropDetail->getDetail();
?>