<?php 
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Handle logout
if (isset($_POST['logout'])) {
    session_destroy();  // Destroy the session
    header("Location: login.php"); // Redirect to the login page
    exit();
}

include('../includes/header.php');

// Predefined product details (name, description, price, stock, image)
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
?>

<main class="container mt-5">
    <h2>Admin Dashboard</h2>
    <h4>Manage Products</h4>
    <a href="add-product.php" class="btn btn-success mb-3">Add New Product</a>

    <!-- Logout Button -->
    <form method="POST" class="mb-3">
        <button type="submit" name="logout" class="btn btn-danger">Logout</button>
    </form>

    <div class="row">
        <?php foreach ($products as $product) { ?>
            <div class="col-md-4">
                <div class="card">
                    <img src="../assets/images/<?php echo $product['image']; ?>" class="card-img-top" alt="<?php echo $product['name']; ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product['name']; ?></h5>
                        <a href="edit-product.php?id=<?php echo $product['id']; ?>" class="btn btn-primary">Edit</a>
                        <a href="delete-product.php?id=<?php echo $product['id']; ?>" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</main>

<?php include('../includes/footer.php'); ?>
