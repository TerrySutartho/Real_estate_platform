
<?php 
// CalculateMortgageController.php
require_once('../entity/Properties.php');
class CalculateMortgageController{

    public function calcMortgage(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $price = $_POST['price'];
            $prop = new Properties;
            $result = $prop->calcMortgage($price);

            // Return the result as JSON
            header('Content-Type: application/json');

            echo json_encode(array('success' => true, 'data' => $result));
        }
    }
}

// Instantiate the class and call the search method
$CalculateMortgageController = new CalculateMortgageController();
$CalculateMortgageController->calcMortgage();
?>