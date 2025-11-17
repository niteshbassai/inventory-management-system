<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include('../includes/header.php');

// Check if the 'id' is passed in the URL
if (isset($_GET['id'])) {
    $productId = $_GET['id']; // Get the product ID from the URL

    // Predefined products array (same as admin-dashboard.php)
    $products = [
        "Wireless Bluetooth Headphones" => [
            "id" => 1,
            "name" => "Wireless Bluetooth Headphones",
            "description" => "High-quality wireless Bluetooth headphones with deep bass and noise-canceling technology.",
            "price" => 99.99,
            "stock" => 50,
            "image" => "wireless-bluetooth-headphones.jpg"
        ],
        "4K Ultra HD Smart TV" => [
            "id" => 2,
            "name" => "4K Ultra HD Smart TV",
            "description" => "55-inch 4K Ultra HD Smart TV with built-in streaming apps and voice control.",
            "price" => 799.99,
            "stock" => 30,
            "image" => "4k-ultra-hd-smart-tv.jpg"
        ],
        "Gaming Laptop" => [
            "id" => 3,
            "name" => "Gaming Laptop",
            "description" => "A powerful gaming laptop with 16GB RAM, 1TB SSD, and an RTX 3060 graphics card.",
            "price" => 1299.99,
            "stock" => 20,
            "image" => "gaming-laptop.jpg"
        ],
        "Portable Power Bank" => [
            "id" => 4,
            "name" => "Portable Power Bank",
            "description" => "20,000mAh portable power bank with dual USB ports, perfect for charging devices on the go.",
            "price" => 49.99,
            "stock" => 100,
            "image" => "portable-power-bank.jpg"
        ],
        "Smartphone Case" => [
            "id" => 5,
            "name" => "Smartphone Case",
            "description" => "Durable and stylish smartphone case with shock absorption and a sleek design.",
            "price" => 19.99,
            "stock" => 150,
            "image" => "smartphone-case.jpg"
        ],
        "Bluetooth Speaker" => [
            "id" => 6,
            "name" => "Bluetooth Speaker",
            "description" => "Portable Bluetooth speaker with 360-degree sound and waterproof design.",
            "price" => 69.99,
            "stock" => 80,
            "image" => "bluetooth-speaker.jpg"
        ]
    ];

    // Ensure the product exists
    if (isset($products[$productId - 1])) {
        // Delete the product logic here (no actual deletion needed since products are predefined)
        unset($products[$productId - 1]); // Remove the product from the array
        header("Location: admin-dashboard.php"); // Redirect back to the dashboard after deletion
        exit();
    } else {
        echo "Product not found.";
    }
} else {
    echo "No product ID provided.";
}
?>
