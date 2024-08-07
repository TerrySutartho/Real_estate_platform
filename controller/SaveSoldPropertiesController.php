<?php 
// SaveSoldPropertiesController.php
require_once('../entity/SavedProperty.php');
class SaveSoldPropertiesController{

    public function saveProperty(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $prop_id = $_POST['property_id'];

            $prop = new SavedProperty;
            $prop->addSaveSoldProp($prop_id);

            // Return the result as JSON
            header('Content-Type: application/json');   

            echo json_encode(["success" => true]);
        }
    }
}

// Instantiate the class and call the search method
$SaveSoldPropertiesController = new SaveSoldPropertiesController();
$SaveSoldPropertiesController->saveProperty();
?>