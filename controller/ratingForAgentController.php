<?php
// ratingForAgentController.php

require_once('../entity/Rating.php');

class ratingForAgentController{

    public function ratingAgent(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {//make sure request is post method
            // Retrieve the submitted username and password
            $agent_id = $_POST["agent_id"];
            $selectedRating = $_POST["selectedRating"];

            // Create an instance of the UserAccount class
            $rating = new Rating();

            // Call the authentication method of the UserAccount class
            $result = $rating->ratingForAgents($agent_id, $selectedRating);

            // Rating inserted successfully
            echo json_encode(["success" => true]);
        }
    }
}
$ratingForAgentController = new ratingForAgentController;
$ratingForAgentController->ratingAgent();
?>