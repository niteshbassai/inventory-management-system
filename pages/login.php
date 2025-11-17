<?php
session_start();

// Check if already logged in and redirect to the admin dashboard
if (isset($_SESSION['admin'])) {
    header("Location: admin-dashboard.php");
    exit();
}

// Include necessary files
include('../includes/header.php');
include('../classes/CRUD.php');
include('../classes/Database.php');

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and trim user inputs to prevent SQL injection
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']); // Password will be validated later
    
    // Initialize the CRUD class
    $crud = new CRUD();
    
    // Fetch the admin by email from the database
    $admin = $crud->getAdminByEmail($email);

    // Check if the admin exists and verify the password
    if ($admin && password_verify($password, $admin['password'])) {
        // Store admin ID in the session
        $_SESSION['admin'] = $admin['id'];
        
        // Redirect to admin dashboard
        header("Location: admin-dashboard.php");
        exit();
    } else {
        // Display error message if credentials are incorrect
        $error = "Invalid email or password.";
    }
}
?>

<main class="container mt-5">
    <h2>Admin Login</h2>
    
    <!-- Display error message if login failed -->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>
    
    <!-- Login Form -->
    <form method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</main>

<?php include('../includes/footer.php'); ?>
