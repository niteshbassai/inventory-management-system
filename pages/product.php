<?php 
include('../includes/header.php'); 

// Predefined product details (name, description, price, stock, image)
$products = [
    "Wireless Bluetooth Headphones" => [
        "name" => "Wireless Bluetooth Headphones",
        "description" => "High-quality wireless Bluetooth headphones with deep bass and noise-canceling technology.",
        "price" => 99.99,
        "stock" => 50,
        "image" => "wireless-bluetooth-headphones.jpg"
    ],
    "4K Ultra HD Smart TV" => [
        "name" => "4K Ultra HD Smart TV",
        "description" => "55-inch 4K Ultra HD Smart TV with built-in streaming apps and voice control.",
        "price" => 799.99,
        "stock" => 30,
        "image" => "4k-ultra-hd-smart-tv.jpg"
    ],
    "Gaming Laptop" => [
        "name" => "Gaming Laptop",
        "description" => "A powerful gaming laptop with 16GB RAM, 1TB SSD, and an RTX 3060 graphics card.",
        "price" => 1299.99,
        "stock" => 20,
        "image" => "gaming-laptop.jpg"
    ],
    "Portable Power Bank" => [
        "name" => "Portable Power Bank",
        "description" => "20,000mAh portable power bank with dual USB ports, perfect for charging devices on the go.",
        "price" => 49.99,
        "stock" => 100,
        "image" => "portable-power-bank.jpg"
    ],
    "Smartphone Case" => [
        "name" => "Smartphone Case",
        "description" => "Durable and stylish smartphone case with shock absorption and a sleek design.",
        "price" => 19.99,
        "stock" => 150,
        "image" => "smartphone-case.jpg"
    ],
    "Bluetooth Speaker" => [
        "name" => "Bluetooth Speaker",
        "description" => "Portable Bluetooth speaker with 360-degree sound and waterproof design.",
        "price" => 69.99,
        "stock" => 80,
        "image" => "bluetooth-speaker.jpg"
    ]
];

// Retrieve the product name from the URL
$product_name = $_GET['name'];
$product = $products[$product_name] ?? null; // Get the product details

if (!$product) {
    echo "Product not found!";
    exit();
}
?>

<main class="container mt-5">
    <h2><?php echo $product['name']; ?></h2>
    <div class="row">
        <div class="col-md-6">
            <img src="../assets/images/<?php echo $product['image']; ?>" class="img-fluid" alt="<?php echo $product['name']; ?>">
        </div>
        <div class="col-md-6">
            <p><strong>Description:</strong> <?php echo $product['description']; ?></p>
            <p><strong>Price:</strong> $<?php echo $product['price']; ?></p>
            <p><strong>Quantity in Stock:</strong> <?php echo $product['stock']; ?></p>
        </div>
    </div>
</main>

<?php include('../includes/footer.php'); ?>
