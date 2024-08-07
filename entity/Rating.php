<?php
// Rating.php
require_once('database.php');

class Rating{
    private int $agent_id;
    private int $rating;
    private int $rating_id;

    private $jdbcurl;
    private $jdbcname;
    private $jdbcpass;
    private $dbname;
    private $db;
    
    public function __construct($agent_id = 0, $rating = 0, $rating_id = 0){
        $this->agent_id = $agent_id;
        $this->rating = $rating;
        $this->rating_id = $rating_id;

        $this->db = new database();
        $this->jdbcurl = $this->db->getURL();
        $this->jdbcname = $this->db->getName();
        $this->jdbcpass = $this->db->getPass();
        $this->dbname = $this->db->getDbname();
    }

    public function ratingForAgents($agent_id, $rating){
        try {   
            // Establish connection
            $con = mysqli_connect($this->jdbcurl, $this->jdbcname, $this->jdbcpass, $this->dbname);
            if (!$con) {
                throw new Exception("Connection failed: " . mysqli_connect_error());
            }
            $send = "INSERT INTO rating (rating, agent_id) VALUES (? , ?)";
            $stmt = mysqli_prepare($con, $send);
            if (!$stmt) {
                throw new Exception("Error: " . mysqli_error($con));
            }

            mysqli_stmt_bind_param($stmt, "ii", $rating, $agent_id);
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


    public function viewRatings($agent_id){
        try {   
            $con = mysqli_connect($this->jdbcurl, $this->jdbcname, $this->jdbcpass, $this->dbname);
            if (!$con) {
                throw new Exception("Connection failed: " . mysqli_connect_error());
            }
            $query = "SELECT rating, COUNT(*) as count FROM rating WHERE agent_id = ? GROUP BY rating";
            $stmt = mysqli_prepare($con, $query);
            if (!$stmt) {
                throw new Exception("Error: " . mysqli_error($con));
            }

            mysqli_stmt_bind_param($stmt, "i", $agent_id);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $ratings = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $ratings[] = $row;
            }
            mysqli_close($con);
            return $ratings;
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
