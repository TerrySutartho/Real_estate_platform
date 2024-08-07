<?php 
// viewNewPropertiesC.php
require_once('../entity/Properties.php');
class viewNewPropertiesC{

    public function viewNew(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $prop = new Properties;
            $result = $prop->getNewProp();

            // Return the result as JSON
            header('Content-Type: application/json');

            echo json_encode(array('success' => true, 'data' => $result));
        }
    }
}

// Instantiate the class and call the search method
$viewNewPropertiesC = new viewNewPropertiesC();
$viewNewPropertiesC->viewNew();
?>