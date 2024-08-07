<?php 
// viewMyProp.php
require_once('../entity/Properties.php');
class viewMyProp{

    public function viewProp(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $agent_id = $_POST['agent_id'];
            
            $prop = new Properties;
            $result = $prop->getMyProp($agent_id);

            // Return the result as JSON
            header('Content-Type: application/json');

            echo json_encode(array('success' => true, 'data' => $result));
        }
    }
}

// Instantiate the class and call the search method
$viewMyProp = new viewMyProp();
$viewMyProp->viewProp();
?>