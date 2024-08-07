<?php 
// NumberOfFavouritedC.php
require_once('../entity/SavedProperty.php');
class NumberOfFavouritedC{

    public function getFav(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $prop_id = $_POST['prop_id'];
            $prop = new SavedProperty;
            $result = $prop->retrieveFav($prop_id);

            // Return the result as JSON
            header('Content-Type: application/json');

            echo json_encode(array('success' => true, 'data' => $result));
        }
    }
}

// Instantiate the class and call the search method
$NumberOfFavouritedC = new NumberOfFavouritedC();
$NumberOfFavouritedC->getFav();
?>