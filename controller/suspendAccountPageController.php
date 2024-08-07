<?php
// Include the UserAccount class
require_once('../entity/Account.php');

// Define the suspendAccountPageController class
class suspendAccountPageController
{
    // Method to handle the suspend account functionality
    public function suspendAccount()
    {
        // Check if the user_id parameter is set in the URL
        // Extract user_id from URL parameters
        $user_id = $_GET['user_id'];
        // Create an instance of the Account class
        $userAccount = new Account();

        // Encode the response as JSON and send it back
        echo $userAccount->suspendAccount($user_id);    
    }
}

// Instantiate the suspendAccountPageController class
$suspendAccountPageController = new suspendAccountPageController();

// Call the suspendAccount method
$suspendAccountPageController->suspendAccount();
?>
