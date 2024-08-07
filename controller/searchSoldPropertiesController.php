<?php 
// searchSoldPropertiesController.php
require_once('../entity/Properties.php');
class searchSoldPropertiesController{

    public function searchSold(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $min =$_POST['min'];
            $max =$_POST['max'];
            
            $prop = new Properties;
            $result = $prop->searchSoldProp($min, $max);

            // Return the result as JSON
            header('Content-Type: application/json');

            if (!empty($result)) {
                echo json_encode(array('success' => true, 'data' => $result));
            } else {
                echo json_encode(array('success' => false, 'message' => "No relevant properties found."));
            }
        }   
    }
}

// Instantiate the class and call the search method
$searchSoldPropertiesController = new searchSoldPropertiesController();
$searchSoldPropertiesController->searchSold();
?>