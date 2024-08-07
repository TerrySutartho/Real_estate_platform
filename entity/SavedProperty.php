<?php
// SavedProperty.php
require_once('database.php');

class SavedProperty{
    private int $property_id;
    private int $amountSaved;
    private int $saved_id;


    private $jdbcurl;
    private $jdbcname;
    private $jdbcpass;
    private $dbname;
    private $db;
    
    public function __construct( $property_id = 0, $amountSaved = 0, $saved_id = 0){
        $this->property_id = $property_id;
        $this->amountSaved = $amountSaved;
        $this->saved_id = $saved_id;

        $this->db = new database();
        $this->jdbcurl = $this->db->getURL();
        $this->jdbcname = $this->db->getName();
        $this->jdbcpass = $this->db->getPass();
        $this->dbname = $this->db->getDbname();
    }

    public function addSaveNewProp($property_id){
        try {   
            // Establish connection
            $con = mysqli_connect($this->jdbcurl, $this->jdbcname, $this->jdbcpass, $this->dbname);
            if (!$con) {
                throw new Exception("Connection failed: " . mysqli_connect_error());
            }
            $send = "UPDATE savedProperty SET saved = saved +1 WHERE property_id=?";
            $stmt = mysqli_prepare($con, $send);
            if (!$stmt) {
                throw new Exception("Error: " . mysqli_error($con));
            }

            mysqli_stmt_bind_param($stmt, "i", $property_id);
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

    public function addSaveSoldProp($property_id){
        try {   
            // Establish connection
            $con = mysqli_connect($this->jdbcurl, $this->jdbcname, $this->jdbcpass, $this->dbname);
            if (!$con) {
                throw new Exception("Connection failed: " . mysqli_connect_error());
            }
            $send = "UPDATE savedProperty SET saved = saved +1 WHERE property_id=?";
            $stmt = mysqli_prepare($con, $send);
            if (!$stmt) {
                throw new Exception("Error: " . mysqli_error($con));
            }

            mysqli_stmt_bind_param($stmt, "i", $property_id);
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

    public function retrieveFav($prop_id){
        $num = 0;
        try {
            // Establish connection
            $con = mysqli_connect($this->jdbcurl, $this->jdbcname, $this->jdbcpass, $this->dbname);
            if (!$con) {
                throw new Exception("Connection failed: " . mysqli_connect_error());
            }
            $insert = "INSERT INTO savedProperty (property_id, saved) SELECT ?, ? WHERE NOT EXISTS (SELECT 1 FROM savedProperty WHERE property_id=?)";

            $in = mysqli_prepare($con, $insert);
            if (!$in) {
                throw new Exception("Error: " . mysqli_error($con));
            }

            mysqli_stmt_bind_param($in, "iii", $prop_id,$num,$prop_id);
            // Set parameter and execute
            mysqli_stmt_execute($in);

            $search = "SELECT saved FROM savedProperty WHERE property_id=?";

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

            $fav = $row["saved"];

            mysqli_close($con);
        } catch (mysqli_sql_exception $e) {
            echo "Error: " . $e->getMessage();
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
        return $fav;
    }
}
?>