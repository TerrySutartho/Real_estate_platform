<?php
// Review.php
require_once('database.php');

class Review{
    private int $agent_id;
    private String $review;
    private int $review_id;

    private $jdbcurl;
    private $jdbcname;
    private $jdbcpass;
    private $dbname;
    private $db;
    
    public function __construct($agent_id = 0, $review = "", $review_id = 0){
        $this->agent_id = $agent_id;
        $this->review = $review;
        $this->review_id = $review_id;

        $this->db = new database();
        $this->jdbcurl = $this->db->getURL();
        $this->jdbcname = $this->db->getName();
        $this->jdbcpass = $this->db->getPass();
        $this->dbname = $this->db->getDbname();
    }

    public function reviewForAgents($agent_id, $review){
        try {   
            // Establish connection
            $con = mysqli_connect($this->jdbcurl, $this->jdbcname, $this->jdbcpass, $this->dbname);
            if (!$con) {
                throw new Exception("Connection failed: " . mysqli_connect_error());
            }
            $send = "INSERT INTO review (review, agent_id) VALUES (? , ?)";
            $stmt = mysqli_prepare($con, $send);
            if (!$stmt) {
                throw new Exception("Error: " . mysqli_error($con));
            }

            mysqli_stmt_bind_param($stmt, "si", $review, $agent_id);
            // Set parameter and execute
            mysqli_stmt_execute($stmt);

            mysqli_close($con);
            return True;
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function viewReviews($agent_id) {
        try {
            $con = mysqli_connect($this->jdbcurl, $this->jdbcname, $this->jdbcpass, $this->dbname);
            if (!$con) {
                throw new Exception("Connection failed: " . mysqli_connect_error());
            }
            $query = "SELECT review_id, review, agent_id FROM review WHERE agent_id = ?";
            $stmt = mysqli_prepare($con, $query);
            if (!$stmt) {
                throw new Exception("Error preparing statement: " . mysqli_error($con));
            }
    
            mysqli_stmt_bind_param($stmt, "i", $agent_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $reviews = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $reviews[] = $row;
            }
            mysqli_close($con);
            return $reviews;
        } catch (Exception $e) {
            return ["error" => $e->getMessage()];
        }
    
    }
}
?>