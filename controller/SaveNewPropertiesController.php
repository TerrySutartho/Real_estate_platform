<?php 
// SaveNewPropertiesController.php
require_once('../entity/SavedProperty.php');
class SaveNewPropertiesController{

    public function saveProperty(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $prop_id = $_POST['property_id'];

            $prop = new SavedProperty;
            $prop->addSaveNewProp($prop_id);

            // Return the result as JSON
            header('Content-Type: application/json');

            echo json_encode(["success" => true]);
        }
    }
}

// Instantiate the class and call the search method
$SaveNewPropertiesController = new SaveNewPropertiesController();
$SaveNewPropertiesController->saveProperty();
?>