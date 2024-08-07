<?php
// SellerReviewC.php

require_once('../entity/Review.php');

class SellerReviewC{

    public function reviewAgent(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {//make sure request is post method
            // Retrieve the submitted username and password
            $agent_id = $_POST["agent_id"];
            $reviewMessage = $_POST["reviewMessage"];

            // Create an instance of the UserAccount class
            $review = new Review();

            // Call the authentication method of the UserAccount class
            $review->reviewForAgents($agent_id, $reviewMessage);

            echo json_encode(["success" => true]);
        }
    }
}
$SellerReviewC = new SellerReviewC;
$SellerReviewC->reviewAgent();
?>