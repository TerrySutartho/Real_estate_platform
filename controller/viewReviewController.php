<?php
require_once('../entity/Review.php');

class viewReviewController{
    public function viewReviews($agent_id) {
        $review = new Review();
        $result = $review->viewReviews($agent_id);
        if(!empty($result)){
            echo json_encode(array('success' => true, 'data' => $result));
        }
        else{
            echo json_encode(array('success' => false, 'data' => 'No Reviews Found'));
        }
    }
}

$agent_id = $_GET['agent_id'] ?? 1;  // Default to agent_id 1 if not specified
$viewReviewController = new viewReviewController();
$viewReviewController ->viewReviews($agent_id);
?>
