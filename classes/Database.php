<?php
class Database {
    private $host = "localhost"; // MySQL host
    private $username = "root";  // MySQL username
    private $password = "";      // MySQL password (leave empty for default)
    private $dbname = "inventory_db"; // Your database name

    public $conn;

    public function connect() {
        $this->conn = null;

        try {
            // Connect to MySQL database
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
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
