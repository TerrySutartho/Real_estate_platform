<?php 
// NumberOfViewsC.php
require_once('../entity/Properties.php');
class NumberOfViewsC{

    public function getViews(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $prop_id = $_POST['prop_id'];
            $prop = new Properties;
            $result = $prop->retrieveViews($prop_id);

            // Return the result as JSON
            header('Content-Type: application/json');

            echo json_encode(array('success' => true, 'data' => $result));
        }
    }
}

// Instantiate the class and call the search method
$NumberOfViewsC = new NumberOfViewsC();
$NumberOfViewsC->getViews();
?>