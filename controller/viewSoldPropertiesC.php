<?php 
// viewSoldPropertiesC.php
require_once('../entity/Properties.php');
class viewSoldPropertiesC{

    public function viewSold(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $prop = new Properties;
            $result = $prop->getSoldProp();

            // Return the result as JSON
            header('Content-Type: application/json');

            echo json_encode(array('success' => true, 'data' => $result));
        }
    }
}

// Instantiate the class and call the search method
$viewSoldPropertiesC = new viewSoldPropertiesC();
$viewSoldPropertiesC->viewSold();
?>