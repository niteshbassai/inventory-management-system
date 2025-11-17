<?php include('../includes/header.php'); ?>
<main class="container mt-5">
    <h2 class="text-center">All Products</h2>
    <div class="row">
        <?php
        // Predefined product details (name, description, price, stock, image)
        $products = [
            [
                "name" => "Wireless Bluetooth Headphones",
                "description" => "High-quality wireless Bluetooth headphones with deep bass and noise-canceling technology.",
                "price" => 99.99,
                "stock" => 50,
                "image" => "wireless-bluetooth-headphones.jpg"
            ],
            [
                "name" => "4K Ultra HD Smart TV",
                "description" => "55-inch 4K Ultra HD Smart TV with built-in streaming apps and voice control.",
                "price" => 799.99,
                "stock" => 30,
                "image" => "4k-ultra-hd-smart-tv.jpg"
            ],
            [
                "name" => "Gaming Laptop",
                "description" => "A powerful gaming laptop with 16GB RAM, 1TB SSD, and an RTX 3060 graphics card.",
                "price" => 1299.99,
                "stock" => 20,
                "image" => "gaming-laptop.jpg"
            ],
            [
                "name" => "Portable Power Bank",
                "description" => "20,000mAh portable power bank with dual USB ports, perfect for charging devices on the go.",
                "price" => 49.99,
                "stock" => 100,
                "image" => "portable-power-bank.jpg"
            ],
            [
                "name" => "Smartphone Case",
                "description" => "Durable and stylish smartphone case with shock absorption and a sleek design.",
                "price" => 19.99,
                "stock" => 150,
                "image" => "smartphone-case.jpg"
            ],
            [
                "name" => "Bluetooth Speaker",
                "description" => "Portable Bluetooth speaker with 360-degree sound and waterproof design.",
                "price" => 69.99,
                "stock" => 80,
                "image" => "bluetooth-speaker.jpg"
            ]
        ];

        // Loop through the product array and display each product
        foreach ($products as $product) {
            echo "
            <div class='col-md-4'>
                <div class='card'>
                    <img src='../assets/images/{$product['image']}' class='card-img-top' alt='{$product['name']}'>
                    <div class='card-body'>
                        <h5 class='card-title'>{$product['name']}</h5>
                        <p class='card-text'>{$product['description']}</p>
                        <p class='card-text'><strong>Price:</strong> \${$product['price']}</p>
                        <p class='card-text'><strong>Stock:</strong> {$product['stock']} units</p>
                        <a href='product.php?name={$product['name']}' class='btn btn-primary'>View Product</a>
                    </div>
                </div>
            </div>";
        }
        ?>
    </div>
</main>
<?php include('../includes/footer.php'); ?>
