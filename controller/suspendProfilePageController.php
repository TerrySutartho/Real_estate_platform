<?php
// Include the Profile class
require_once('../entity/Profile.php');

// Define the suspendProfilePageController class
class suspendProfilePageController
{
    // Method to handle the suspend profile functionality
    public function suspendProfile()
    {
        // Extract userProfile from URL parameters
        $userProfile = $_GET['userProfile'];

        // Create an instance of the Profile class
        $profile = new Profile();

        // Encode the response as JSON and send it back
        echo $profile->suspendprofile($userProfile);
    }
}

// Instantiate the suspendProfilePageController class
$suspendProfilePageController = new suspendProfilePageController();

// Call the suspendProfile method
$suspendProfilePageController->suspendProfile();
?>
