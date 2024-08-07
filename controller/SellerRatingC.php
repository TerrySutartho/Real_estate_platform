<?php
// SellerRatingC.php

require_once('../entity/Rating.php');

class SellerRatingC{

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
$SellerRatingC = new SellerRatingC;
$SellerRatingC->ratingAgent();
?>