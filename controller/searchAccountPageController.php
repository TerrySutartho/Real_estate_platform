<?php
// Include the UserAccount class
require_once('../entity/Account.php');

// Define the searchAccountPageController class
class searchAccountPageController
{
    // Method to handle the search account functionality
    public function searchAccount()
    {
        // Check if the form is submitted and if the username is set
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username'])) {
            // Retrieve the submitted username
            $username = $_POST['username'];

            // Create an instance of the Account class
            $userAccount = new Account();

            // Call the search account method of the Account class
            $search = $userAccount->searchAccount($username);

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
}

// Instantiate the searchAccountController class
$searchAccountPageController = new searchAccountPageController();

// Call the searchAccount method
$searchAccountPageController->searchAccount();
