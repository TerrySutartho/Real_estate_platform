<?php
// Include the UserAccount class
require_once('../entity/Account.php');

// Define the createAccountPageController class
class createAccountPageController
{
    // Method to handle the create account functionality
    public function createAccount()
    {
        // Check if the form is submitted and if the username is set
        if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST["username"])) {
            // Extract form data
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
            echo $userAccount->createAccount();
        }
    }
}

// Instantiate the createAccountController class
$createAccountPageController = new createAccountPageController();

// Call the createAccount method
$createAccountPageController->createAccount();
