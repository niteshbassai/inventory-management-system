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

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and trim the inputs
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    
    // Image upload handling
    $image = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = 'images/' . $_FILES['image']['name']; // Save the image to the 'images' directory
        move_uploaded_file($_FILES['image']['tmp_name'], '../assets/' . $image); // Move uploaded file to folder
    }

    // Initialize CRUD class and add product to the database
    $crud = new CRUD();
    $createResult = $crud->createProduct($name, $description, $price, $quantity, $image);

    if ($createResult === "Product added successfully.") {
        header("Location: admin-dashboard.php"); // Redirect to admin dashboard after adding product
        exit();
    } else {
        $error = $createResult;  // Show error if adding product failed
    }
}
?>

<main class="container mt-5">
    <h2>Add New Product</h2>

    <!-- Display error message if any -->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <!-- Product Add Form -->
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="description">Product Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <div class="form-group">
            <label for="price">Product Price</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="form-group">
            <label for="quantity">Product Quantity</label>
            <input type="number" class="form-control" id="quantity" name="quantity" required>
        </div>
        <div class="form-group">
            <label for="image">Product Image</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</main>

<?php include('../includes/footer.php'); ?>
