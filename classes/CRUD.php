<?php
class CRUD {
    private $db;

    public function __construct() {
        // Initialize database connection
        $this->db = (new Database())->connect();
    }

    // --- CREATE PRODUCT ---
    public function createProduct($name, $description, $price, $quantity, $image) {
        // Insert product into the database
        $stmt = $this->db->prepare("INSERT INTO products (name, description, price, quantity, image) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssdis", $name, $description, $price, $quantity, $image);
        if ($stmt->execute()) {
            return "Product added successfully.";
        } else {
            return "Error adding product.";
        }
    }

    // --- READ PRODUCTS ---
    public function getAllProducts() {
        $stmt = $this->db->prepare("SELECT * FROM products");
        $stmt->execute();
        return $stmt->get_result();  // Return result set (products)
    }

    public function getProductById($id) {
        $stmt = $this->db->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();  // Return single product
    }

    // --- UPDATE PRODUCT ---
    public function updateProduct($id, $name, $description, $price, $quantity, $image) {
        // Update product details in the database
        $stmt = $this->db->prepare("UPDATE products SET name = ?, description = ?, price = ?, quantity = ?, image = ? WHERE id = ?");
        $stmt->bind_param("ssdisi", $name, $description, $price, $quantity, $image, $id);
        if ($stmt->execute()) {
            return "Product updated successfully.";
        } else {
            return "Error updating product.";
        }
    }

    // --- DELETE PRODUCT ---
    public function deleteProduct($id) {
        // Delete product from the database
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            return "Product deleted successfully.";
        } else {
            return "Error deleting product.";
        }
    }

    // --- CREATE ADMIN (USER) ---
    public function createAdmin($email, $password) {
        // First, check if the email already exists
        $stmt = $this->db->prepare("SELECT * FROM admins WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            return "Email already exists.";  // Return error message if email exists
        }

        // If email is unique, hash the password and insert the new admin
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO admins (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $hashedPassword);
        if ($stmt->execute()) {
            return "Account registered successfully.";
        } else {
            return "Error registering account.";
        }
    }

    // --- GET ADMIN BY EMAIL (FOR LOGIN VALIDATION) ---
    public function getAdminByEmail($email) {
        // Get admin data by email for login
        $stmt = $this->db->prepare("SELECT * FROM admins WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();  // Return the admin record
    }
}
?>
