<?php
// Properties.php
require_once('database.php');

class Properties {
    private int $property_id;
    private int $agent_id;
    private int $seller_id;
    private $post_date;
    private String $address;
    private float $price;
    private String $conditions;
    private int $view;

    private int $lease = 30;
    private int $months = 12;
    private float $interest = 0.05;

    private $jdbcurl;
    private $jdbcname;
    private $jdbcpass;
    private $dbname;
    private $db;

    public function __construct($property_id = 0, $agent_id = 0, $post_date = "", $address = "", $price = 0.0, $conditions = "", $view = 0) {
        $this->property_id = $property_id;
        $this->agent_id = $agent_id;
        $this->post_date = $post_date;
        $this->address = $address;
        $this->price = $price;
        $this->conditions = $conditions;
        $this->view = $view;

        $this->db = new database();
        $this->jdbcurl = $this->db->getURL();
        $this->jdbcname = $this->db->getName();
        $this->jdbcpass = $this->db->getPass();
        $this->dbname = $this->db->getDbname();
    }

    public function getPropDetail($prop_id){
        try {   
            // Establish connection
            $con = mysqli_connect($this->jdbcurl, $this->jdbcname, $this->jdbcpass, $this->dbname);
            if (!$con) {
                throw new Exception("Connection failed: " . mysqli_connect_error());
            }
            $update = "UPDATE property SET views = views +1 WHERE property_id=?";
            $stmg = mysqli_prepare($con, $update);
            if (!$stmg) {
                throw new Exception("Error: " . mysqli_error($con));
            }
            mysqli_stmt_bind_param($stmg, "i", $prop_id);
            // Set parameter and execute
            mysqli_stmt_execute($stmg);

            $search = "SELECT * FROM property WHERE property_id=?";
            $stmt = mysqli_prepare($con, $search);
            if (!$stmt) {
                throw new Exception("Error: " . mysqli_error($con));
            }

            mysqli_stmt_bind_param($stmt, "i", $prop_id);
            // Set parameter and execute
            mysqli_stmt_execute($stmt);

            // Get result
            $result = mysqli_stmt_get_result($stmt);

            $prop = mysqli_fetch_assoc($result);

            mysqli_close($con);
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return $prop;
    }

    public function getSellerPropDetail($prop_id){
        try {   
            // Establish connection
            $con = mysqli_connect($this->jdbcurl, $this->jdbcname, $this->jdbcpass, $this->dbname);
            if (!$con) {
                throw new Exception("Connection failed: " . mysqli_connect_error());
            }
            $search = "SELECT * FROM property WHERE property_id=?";
            $stmt = mysqli_prepare($con, $search);
            if (!$stmt) {
                throw new Exception("Error: " . mysqli_error($con));
            }

            mysqli_stmt_bind_param($stmt, "i", $prop_id);
            // Set parameter and execute
            mysqli_stmt_execute($stmt);

            // Get result
            $result = mysqli_stmt_get_result($stmt);

            $prop = mysqli_fetch_assoc($result);

            mysqli_close($con);
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return $prop;
    }

    public function getNewProp(){
        $temp = 'new';
        $prop = array();
        try {
            // Establish connection
            $con = mysqli_connect($this->jdbcurl, $this->jdbcname, $this->jdbcpass, $this->dbname);
            if (!$con) {
                throw new Exception("Connection failed: " . mysqli_connect_error());
            }
            $search = "SELECT * FROM property WHERE conditions=?";
            $stmt = mysqli_prepare($con, $search);
            if (!$stmt) {
                throw new Exception("Error: " . mysqli_error($con));
            }

            mysqli_stmt_bind_param($stmt, "s", $temp);
            // Set parameter and execute
            mysqli_stmt_execute($stmt);

            // Get result
            $result = mysqli_stmt_get_result($stmt);

            while ($row = mysqli_fetch_assoc($result)) {
                $prop[] = $row;
            }

            mysqli_close($con);
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return $prop;
    }

    public function getSoldProp(){
        $temp = "sold";
        $prop = array();
        try {
            // Establish connection
            $con = mysqli_connect($this->jdbcurl, $this->jdbcname, $this->jdbcpass, $this->dbname);
            if (!$con) {
                throw new Exception("Connection failed: " . mysqli_connect_error());
            }
            $search = "SELECT * FROM property WHERE conditions=?";
            $stmt = mysqli_prepare($con, $search);
            if (!$stmt) {
                throw new Exception("Error: " . mysqli_error($con));
            }

            mysqli_stmt_bind_param($stmt, "s", $temp);
            // Set parameter and execute
            mysqli_stmt_execute($stmt);

            // Get result
            $result = mysqli_stmt_get_result($stmt);

            while ($row = mysqli_fetch_assoc($result)) {
                $prop[] = $row;
            }

            mysqli_close($con);
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return $prop;
    }

    public function searchNewProp($min = 0, $max = 900000){
        $temp = 'new';
        $prop = array();
        try {
            // Establish connection
            $con = mysqli_connect($this->jdbcurl, $this->jdbcname, $this->jdbcpass, $this->dbname);
            if (!$con) {
                throw new Exception("Connection failed: " . mysqli_connect_error());
            }
            $search = "SELECT * FROM property WHERE conditions=? AND price>=? AND price<=?";

            $stmt = mysqli_prepare($con, $search);
            if (!$stmt) {
                throw new Exception("Error: " . mysqli_error($con));
            }

            mysqli_stmt_bind_param($stmt, "sii", $temp, $min, $max);

            // Set parameter and execute
            mysqli_stmt_execute($stmt);

            // Get result
            $result = mysqli_stmt_get_result($stmt);

            while ($row = mysqli_fetch_assoc($result)) {
                $prop[] = $row;
            }

            mysqli_close($con);
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return $prop;
    }

    public function searchSoldProp($min = 0, $max = 900000){
        $temp = 'sold';
        $prop = array();
        try {
            // Establish connection
            $con = mysqli_connect($this->jdbcurl, $this->jdbcname, $this->jdbcpass, $this->dbname);
            if (!$con) {
                throw new Exception("Connection failed: " . mysqli_connect_error());
            }
            $search = "SELECT * FROM property WHERE conditions=? AND price>=? AND price<=?";

            $stmt = mysqli_prepare($con, $search);
            if (!$stmt) {
                throw new Exception("Error: " . mysqli_error($con));
            }

            mysqli_stmt_bind_param($stmt, "sii", $temp, $min, $max);

            // Set parameter and execute
            mysqli_stmt_execute($stmt);

            // Get result
            $result = mysqli_stmt_get_result($stmt);

            while ($row = mysqli_fetch_assoc($result)) {
                $prop[] = $row;
            }

            mysqli_close($con);
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return $prop;
    }

    public function calcMortgage($price){
        $monthlyInterest = $this->interest / $this->months;
        $term = $this->months * $this->lease;
        $monthly = ($price * $monthlyInterest) / (1 - pow(1 + $monthlyInterest, -$term));
        return $monthly; 
    }

    public function getSellerProp($seller_id){
        $prop = array();
        try {
            // Establish connection
            $con = mysqli_connect($this->jdbcurl, $this->jdbcname, $this->jdbcpass, $this->dbname);
            if (!$con) {
                throw new Exception("Connection failed: " . mysqli_connect_error());
            }
            $search = "SELECT * FROM property WHERE seller_id=?";
            $stmt = mysqli_prepare($con, $search);
            if (!$stmt) {
                throw new Exception("Error: " . mysqli_error($con));
            }

            mysqli_stmt_bind_param($stmt, "s", $seller_id);
            // Set parameter and execute
            mysqli_stmt_execute($stmt);

            // Get result
            $result = mysqli_stmt_get_result($stmt);

            while ($row = mysqli_fetch_assoc($result)) {
                $prop[] = $row;
            }

            mysqli_close($con);
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return $prop;
    }

    public function retrieveViews($prop_id){
        try {
            // Establish connection
            $con = mysqli_connect($this->jdbcurl, $this->jdbcname, $this->jdbcpass, $this->dbname);
            if (!$con) {
                throw new Exception("Connection failed: " . mysqli_connect_error());
            }
            $search = "SELECT views FROM property WHERE property_id=?";
            $stmt = mysqli_prepare($con, $search);
            if (!$stmt) {
                throw new Exception("Error: " . mysqli_error($con));
            }

            mysqli_stmt_bind_param($stmt, "i", $prop_id);
            // Set parameter and execute
            mysqli_stmt_execute($stmt);

            // Get result
            $result = mysqli_stmt_get_result($stmt);

            $row = mysqli_fetch_assoc($result);

            $views = $row['views'];

            mysqli_close($con);
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return $views;
    }

    // Function to get a listing by address
    public function getListing($address,$agent_id) {
        $sql = "SELECT * FROM property WHERE address LIKE ? AND agent_id = ?";
        $con = mysqli_connect($this->jdbcurl, $this->jdbcname, $this->jdbcpass, $this->dbname);
        $stmt = mysqli_prepare($con, $sql);
        $searchTerm = '%' . $address . '%';
        $stmt->bind_param('si', $searchTerm, $agent_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $properties = null;
        while ($row = $result->fetch_assoc()) {
            $properties[] = $row;
        }
        return $properties;
    }
    
    public function getMyProp($agent_id){
        $temp = $agent_id;
        $prop = array();
        try {
            // Establish connection
            $con = mysqli_connect($this->jdbcurl, $this->jdbcname, $this->jdbcpass, $this->dbname);
            if (!$con) {
                throw new Exception("Connection failed: " . mysqli_connect_error());
            }
            $search = "SELECT * FROM property WHERE agent_id=?";
            $stmt = mysqli_prepare($con, $search);
            if (!$stmt) {
                throw new Exception("Error: " . mysqli_error($con));
            }

            mysqli_stmt_bind_param($stmt, "s", $temp);
            // Set parameter and execute
            mysqli_stmt_execute($stmt);

            // Get result
            $result = mysqli_stmt_get_result($stmt);

            while ($row = mysqli_fetch_assoc($result)) {
                $prop[] = $row;
            }

            mysqli_close($con);
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return $prop;
    }

    // Function to update a property listing
    public function updateListing($property_id, $address, $price) {
        if (empty($property_id) || empty($address) || empty($price) || !is_numeric($price)) {
            return json_encode(['success' => false, 'message' => 'Invalid input.']);
        }
    
        $sql = "UPDATE property SET address = ?, price = ? WHERE property_id = ?";
        $con = mysqli_connect($this->jdbcurl, $this->jdbcname, $this->jdbcpass, $this->dbname);
        $stmt = mysqli_prepare($con, $sql);
        if ($stmt) {
            $stmt->bind_param("sdi", $address, $price, $property_id);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                $stmt->close();
                return json_encode(['success' => true, 'message' => 'Listing updated successfully']);
            } else {
                $stmt->close();
                return json_encode(['success' => false, 'message' => 'No records updated. Check your inputs and try again.']);
            }
        } else {
            return json_encode(['success' => false, 'message' => 'Error preparing query: ' . $con->error]);
        }
    }

    public function getListingById($property_id) {
        // Prepare the SQL statement using mysqli
        $sql = "SELECT * FROM property WHERE property_id = ?";
        $con = mysqli_connect($this->jdbcurl, $this->jdbcname, $this->jdbcpass, $this->dbname);
            $stmt = mysqli_prepare($con, $sql);
        if (!$stmt) {
            die('mysqli error: ' . $con->error);
        }

        // Bind parameters
        $stmt->bind_param("i", $property_id);

        // Execute the query
        $stmt->execute();

        // Get the results
        $result = $stmt->get_result();

        // Fetch associative array
        if ($property = $result->fetch_assoc()) {
            $stmt->close();
            return $property;
        } 
    }//

    // Function to delete a property listing
    public function deletePropertyListing($propertyId) {
        $sql = "DELETE FROM property WHERE property_id = ?";
        $con = mysqli_connect($this->jdbcurl, $this->jdbcname, $this->jdbcpass, $this->dbname);
        if ($stmt = mysqli_prepare($con, $sql)) {
            $stmt->bind_param("i", $propertyId);
            if ($stmt->execute()) {
                $affectedRows = $stmt->affected_rows;
                $stmt->close();
                return $affectedRows > 0;
            }
        } 
    }//

    public function createPropertyListing($address, $price, $agent_id, $seller_id) {
        // Validate input
        if (empty($address) || !is_numeric($price) ||empty($price) || empty($seller_id) || !is_numeric($seller_id)) {
            return json_encode(['success' => false, 'message' => 'Invalid input']);
        }
        $con = mysqli_connect($this->jdbcurl, $this->jdbcname, $this->jdbcpass, $this->dbname);

        $sql = "INSERT INTO property (agent_id, seller_id, address, price) VALUES (?, ?, ?, ?)";
    
        try {
            $stmt = mysqli_prepare($con, $sql);
            if (!$stmt) {
                throw new Exception('Failed to prepare statement: ' . $con->error);
            }
            $stmt->bind_param("iisd",$agent_id, $seller_id, $address, $price);
            if (!$stmt->execute()) {
                throw new Exception('Failed to execute statement: ' . $stmt->error);
            }
            $stmt->close();
            if (!$con->commit()) {
                throw new Exception('Failed to commit transaction: ' . $con->error);
            }
            return json_encode(['success' => true, 'message' => 'Listing created successfully']);
        } catch (Exception $e) {
            $con->rollback();
            return json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
        }
    }//

}
?>