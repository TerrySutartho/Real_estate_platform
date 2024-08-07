<?php
// Include the Profile class
require_once('../entity/Profile.php');

// Define the searchProfilePageController class
class searchProfilePageController
{
    // Method to handle the search profile functionality
    public function searchProfile()
    {
        // Retrieve the submitted user profiles
        $userProfile = $_POST['userProfile'];

        // Create an instance of the Profile class
        $profile = new Profile();

        // Call the search profile method of the Profile class
        $search = $profile->searchProfile($userProfile);

            // Check the search result
        if (is_array($search) && !empty($search)) {
            $response = array(
                "success" => true,
                "data" => $search
            );
        } else {
            $response = array(
                "success" => false,
                "data" => "Not Found"
            );
        }

        // Encode the response as JSON and send it back
        echo json_encode($response);
        
    }
}

// Instantiate the searchProfileController class
$searchProfilePageController = new searchProfilePageController();

// Call the searchProfile method
$searchProfilePageController->searchProfile();
