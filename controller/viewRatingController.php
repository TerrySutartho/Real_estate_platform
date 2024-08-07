<?php
require_once('../entity/Rating.php');

header('Content-Type: application/json'); // Ensure the output is treated as JSON.

class viewRatingController {
    public function viewRatings($agent_id) {
        $rating = new Rating();
        $result = $rating->viewRatings($agent_id);
        if(!empty($result)){
            echo json_encode(array('success' => true, 'data' => $result));
        }
        else{
            echo json_encode(array('success' => false, 'data' => 'No Ratings Found'));
        }
    }
}

$agent_id = $_GET['agent_id'];
$viewRatingController = new viewRatingController();
$viewRatingController->viewRatings($agent_id);
?>
