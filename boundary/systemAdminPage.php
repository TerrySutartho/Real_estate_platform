<?php
// Database configuration
require_once('../entity/database.php');
$db = new database();
$servername = $db->getURL();
$username = $db->getName();
$password = $db->getPass();
$database = $db->getDbname();
// Create connection
try {
    $conn = mysqli_connect($servername, $username, $password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    } else {
        // echo "Connected successfully"; 
    }
} catch (mysqli_sql_exception $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Admin Page</title>
    <link rel="stylesheet" href="systemAdminPage.css">
</head>

<body id="system-admin">
    <div class="tab-container">
        <h3>System Admin Page</h3>
        <!-- Different tabs for user account and user profile -->
        <div class="tabs">
            <button class="tablink" onclick="openTab('user-account-tab')">User Account Management</button>
            <button class="tablink" onclick="openTab('user-profile-tab')">User Profile Management</button>
        </div>

        <span id="debug"></span> <!-- For debugging/testing -->

        <!---------------------------------------- USER ACCOUNT ---------------------------------------->
        <div id="user-account-tab" class="tabcontent" style="display: none;">
            <!-- Search for user accounts -->
            <div class="search-container">
                <form id="search-account-form">
                    <input type="text" class="search-box" id="search-account-box" placeholder="Search Account (Username)">
                    <button type="submit" class="search-btn"><img src="../image/search-icon.png" style="height: 15px; width: 15px;" alt="Search"></button>
                </form>
            </div>

            <!-- Table to display user accounts -->
            <table id="user-account-table" border="0">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Password</th>
                        <th>Username</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Date Of Birth</th>
                        <th>Address</th>
                        <th>Profile</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody id="account-table-rows">
                    <?php
                    $sql = "SELECT * from userAccount WHERE suspend IS NULL";
                    $stmt = mysqli_prepare($conn, $sql);
                    if ($stmt) {
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                            if ($result && mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo    '<tr>
                                                    <th scope="row">' . $row['user_id'] . '</th>
                                                    <td>' . $row['password'] . '</td>
                                                    <td>' . $row['username'] . '</td>
                                                    <td>' . $row['firstName'] . '</td>
                                                    <td>' . $row['lastName'] . '</td>
                                                    <td>' . $row['dateofBirth'] . '</td>
                                                    <td>' . $row['address'] . '</td>
                                                    <td>' . $row['userProfile'] . '</td>
                                                    <td>' . '<button class="view-btn" onclick="viewAccount(' . $row['user_id'] . ')"> 
                                                    <img src="../image/view-icon.png" alt="View"></button>' . '</td>
                                                </tr>';
                                }
                            }
                    }
                    ?>
                </tbody>
            </table>

            <!-- Create account -->
            <form id="create-account-form" action="createAccountPage.html" method="post">
                <button type="submit" class="create-btn" id="create-account-btn">Create</button>
            </form>
        </div>

        <!---------------------------------------- USER PROFILE ---------------------------------------->
        <div id="user-profile-tab" class="tabcontent" style="display: none;">
            <!-- Search for user profiles -->
            <div class="search-container">
                <form id="search-profile-form">
                    <input type="text" class="search-box" id="search-profile-box" placeholder="Search Profile (User Profile)">
                    <button type="submit" class="search-btn"><img src="../image/search-icon.png" style="height: 15px; width: 15px;" alt="Search"></button>
                </form>
            </div>

            <!-- Table to display user profiles -->
            <table id="user-profile-table" border="0">
                <thead>
                    <tr>
                        <th style="width: 10%;">User Profile</th>
                        <th >Description</th>
                        <th style="width: 10%;">View</th>
                    </tr>
                </thead>
                <tbody id="profile-table-rows">
                    <?php
                    $sql = "SELECT * from userProfile WHERE suspend IS NULL"; 
                    $stmt = mysqli_prepare($conn, $sql);
                    if ($stmt) {
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        if ($result && mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo    '<tr>
                                        <th scope="row">' . $row['userProfile'] . '</th> 
                                        <td>' . $row['description'] . '</td>' .
                                        '<td>' . '<button class="view-btn" onclick="viewProfile(\'' . $row['userProfile'] . '\')"> 
                                        <img src="../image/view-icon.png" alt="View"></button>' . '</td>
                                    </tr>';
                            }
                        }
                    }
                    ?>
                </tbody>
            </table>

            <!-- Create profile -->
            <form id="create-profile-form" action="createProfilePage.html" method="post">
                <button type="submit" class="create-btn" id="create-profile-btn">Create</button>
            </form>
        </div>

        <!-- Logout button -->
        <div>
            <button class="logout-btn" onclick="logout()">Logout</button>
        </div>
    </div>


    <script>
        function openTab(tabName) {
            // Hide all tab content
            var tabcontent = document.getElementsByClassName("tabcontent");
            for (var i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Deactivate all tab links
            var tablinks = document.getElementsByClassName("tablink");
            for (var i = 0; i < tablinks.length; i++) {
                tablinks[i].classList.remove("active");
            }

            // Show the selected tab content
            document.getElementById(tabName).style.display = "block";

            // Activate the selected tab button
            event.currentTarget.classList.add("active");
        }

        function logout() {
            window.location.href = 'login_page.html'; 
            window.history.replaceState({}, document.title, '/boundary/login_page.html'); 
        }
        
        document.getElementById("search-account-form").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get input username
            var username = document.getElementById("search-account-box").value;

            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Configure the request
            xhr.open("POST", "../controller/searchAccountPageController.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // Set the content type

            // Define what happens on successful data submission/ if send and receive successful, alert response
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    // Handle successful response
                    var response = JSON.parse(xhr.responseText);

                    if (response.success) {
                        // Access and display search results
                        var searchData = response.data;
                        if (searchData && searchData.length > 0) {
                            // Clear previous search results
                            var accountTableRows = document.getElementById("account-table-rows");
                            accountTableRows.innerHTML = "";

                            // Iterate through search results and append rows to the table
                            for (var i = 0; i < searchData.length; i++) {
                                var account = searchData[i];
                                var newRow = "<tr>" +
                                    "<td>" + account.user_id + "</td>" +
                                    "<td>" + account.password + "</td>" +
                                    "<td>" + account.username + "</td>" +
                                    "<td>" + account.firstName + "</td>" +
                                    "<td>" + account.lastName + "</td>" +
                                    "<td>" + account.dateofBirth + "</td>" +
                                    "<td>" + account.address + "</td>" +
                                    "<td>" + account.userProfile + "</td>" +
                                    "<td><button class='view-btn' onclick='viewAccount(" + account.user_id + ")'><img src='../image/view-icon.png' alt='View'></button></td>" +
                                    "</tr>";
                                document.getElementById("account-table-rows").innerHTML += newRow;
                            }
                        }
                    } else {
                        // No search results found
                        document.getElementById("account-table-rows").innerHTML = "<tr><td colspan='8' style='padding-top: 20px;'>No results found</td></tr>";
                    }
                } else {
                    // Handle error response
                    console.error("Error: " + xhr.status);
                }
            };

            // Construct the form data string
            var formData = "username=" + encodeURIComponent(username);

            // Send the request with the form data
            xhr.send(formData);
        });

        document.getElementById("search-profile-form").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Get input user type
            var userProfile = document.getElementById("search-profile-box").value;

            // Create a new XMLHttpRequest object
            var xhr = new XMLHttpRequest();

            // Configure the request
            xhr.open("POST", "../controller/searchProfilePageController.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // Set the content type

            // Define what happens on successful data submission/ if send and receive successful, alert response
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    // Handle successful response
                    var response = JSON.parse(xhr.responseText);

                    if (response.success) {
                        // Access and display search results
                        var searchData = response.data;
                        if (searchData && searchData.length > 0) {
                            // Clear previous search results
                            var profileTableRows = document.getElementById("profile-table-rows");
                            profileTableRows.innerHTML = "";

                            // Iterate through search results and append rows to the table
                            for (var i = 0; i < searchData.length; i++) {
                                var profile = searchData[i];
                                var newRow = "<tr>" +
                                    "<th>" + profile.userProfile + "</th>" +
                                    "<td>" + profile.description + "</td>" + 
                                    "<td><button class='view-btn' onclick='viewProfile(\"" + profile.userProfile + "\")'><img src='../image/view-icon.png' alt='View'></button></td>" +
                                    "</tr>";
                                document.getElementById("profile-table-rows").innerHTML += newRow;
                            }
                        }
                    } else {
                        // No search results found
                        document.getElementById("profile-table-rows").innerHTML = "<tr><td colspan='8' style='padding-top: 20px;'>No results found</td></tr>";
                    }
                } else {
                    // Handle error response
                    console.error("Error: " + xhr.status);
                }
            };

            // Construct the form data string
            var formData = "userProfile=" + encodeURIComponent(userProfile);

            // Send the request with the form data
            xhr.send(formData);
        });

        function viewAccount(user_id) {
            // Redirect to view account page
            window.location.href = "viewAccountPage.html?user_id=" + encodeURIComponent(user_id);
        }

        function viewProfile(userProfile) {
            // Redirect to view profile page
            window.location.href = "viewProfilePage.html?userProfile=" + encodeURIComponent(userProfile);
        }
    </script>
</body>

</html>