<?php
// loginController.php

// Include the UserAccount class
require_once('../entity/Account.php');

// Check if the form is submitted
class loginController{

public function login(){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {//make sure request is post method
    // Retrieve the submitted username and password
    $username = $_POST['userName'];
    $password = $_POST['password'];
    $type = $_POST['user-type'];

    // Create an instance of the UserAccount class
    $userAccount = new Account();

    // Call the authentication method of the UserAccount class
    $result = $userAccount->authentication($username, $password, $type);

    // Return the result as JSON
    header('Content-Type: application/json');

    // Check the authentication result
    if ($result !== null) {
        // Authentication successful
        echo json_encode(array('success' => true, 'data' => $result));
        // You can redirect the user to a different page if needed
    } else {
        // Authentication failed
        echo json_encode(array('success' => false, 'data' =>"Invalid username or password."));
    }
}
}
}
$loginController = new loginController;
$loginController->login();
?>