<?php
// Include the Profile class
require_once('../entity/Profile.php');

// Define the createProfilePageController class
class createProfilePageController
{
    // Method to handle the create profile functionality
    public function createProfile()
    {
        // Check if the form is submitted and if the username is set
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Extract form data
            $userProfile = trim($_POST['userProfile']);
            $description = $_POST['description'];

            // Create an instance Profile class
            $profile = new Profile($userProfile, $description);

            // Encode the response as JSON and send it back
            echo $profile->createProfile();
        }
    }
}

// Instantiate the createProfilePageController class
$createProfilePageController = new createProfilePageController();

// Call the createProfile method
$createProfilePageController->createProfile();
