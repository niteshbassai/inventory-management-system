<?php
class Database {
    private $host = "localhost"; // Your database host
    private $username = "root"; // Your database username
    private $password = ""; // Your database password
    private $dbname = "inventory_db"; // Your database name

    public $conn;

    // Create database connection
    public function connect() {
        $this->conn = null;

        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

            // Check if connection was successful
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            echo "Connection error: " . $e->getMessage();
        }

        return $this->conn;
    }
}
?>
