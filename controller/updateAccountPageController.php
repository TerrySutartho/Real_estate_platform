<?php
// Include the UserAccount class
require_once('../entity/Account.php');

// Define the updateAccountPageController class
class updateAccountPageController
{
    // Method to handle the update account functionality
    public function updateAccount()
    {
        // Check if the form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Extract form data
            $user_id = $_POST["user_id"];
            $username = $_POST['username'];
            $password = $_POST['password'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $dateofBirth = $_POST['dateofBirth'];
            $address = $_POST['address'];
            $userProfile = trim($_POST['userProfile']);

            // Create an instance of the Account class
            $userAccount = new Account(0, $username, $firstName, $lastName, $userProfile, $dateofBirth, $address, $password);

            // Encode the response as JSON and send it back
            echo $userAccount->updateAccount($user_id);
        }
    }
}

// Instantiate the updateAccountPageController class
$updateAccountPageController = new updateAccountPageController();

// Call the updateAccount method
$updateAccountPageController->updateAccount();
?>
