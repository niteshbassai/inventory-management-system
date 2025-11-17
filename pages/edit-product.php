<?php
session_start();

// Check if the admin is logged in, if not, redirect to login page
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

include('../includes/header.php');
include('../classes/CRUD.php');
include('../classes/Database.php');

// Ensure the product id is passed in the URL
if (isset($_GET['id'])) {
    $productId = $_GET['id']; // Get the product ID from the URL
} else {
    header("Location: all-products.php"); // Redirect to all products if no id is passed
    exit();
}

// Initialize CRUD class
$crud = new CRUD();

// Fetch the product details by ID
$product = $crud->getProductById($productId);

// If the product does not exist, redirect to the product list
if (!$product) {
    header("Location: all-products.php");
    exit();
}

// Handle form submission for product update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and trim the inputs
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    
    // Image upload handling (only if a new image is provided)
    $image = $product['image']; // Keep existing image by default
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = 'images/' . $_FILES['image']['name'];
        move_uploaded_file($_FILES['image']['tmp_name'], '../assets/' . $image); // Move uploaded file to folder
    }

    // Update the product in the database
    $updateResult = $crud->updateProduct($productId, $name, $description, $price, $quantity, $image);

    if ($updateResult === "Product updated successfully.") {
        header("Location: admin-dashboard.php"); // Redirect to admin dashboard after successful update
        exit();
    } else {
        $error = $updateResult; // Show error if updating failed
    }
}
?>

<main class="container mt-5">
    <h2>Edit Product</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <!-- Edit Product Form -->
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Product Description</label>
            <textarea class="form-control" id="description" name="description" required><?php echo $product['description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="price">Product Price</label>
            <input type="number" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" required>
        </div>
        <div class="form-group">
            <label for="quantity">Product Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $product['quantity']; ?>" required>
        </div>
        <div class="form-group">
            <label for="image">Product Image (optional)</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="../assets/<?php echo $product['image']; ?>" width="100px" alt="Current Image">
        </div>
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</main>

<?php include('../includes/footer.php'); ?>
