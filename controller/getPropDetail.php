<?php 
// getPropDetail.php
require_once('../entity/Properties.php');
class getPropDetail{

    public function getDetail(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $prop_id = $_POST['prop_id'];
            $prop = new Properties;
            $result = $prop->getPropDetail($prop_id);

            // Return the result as JSON
            header('Content-Type: application/json');

            echo json_encode(array('success' => true, 'data' => $result));
        }
    }
}

// Instantiate the class and call the search method
$getPropDetail = new getPropDetail();
$getPropDetail->getDetail();
?>