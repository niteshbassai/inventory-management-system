<?php
session_start();

// Include necessary files
include('../includes/header.php');
include('../classes/CRUD.php');
include('../classes/Database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and trim the inputs
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password']);
    $confirmPassword = trim($_POST['confirm_password']); // Confirm password field

    // Validate that the passwords match
    if ($password !== $confirmPassword) {
        $error = "Passwords do not match. Please try again.";
    } else {
        // Check if email is already registered
        $crud = new CRUD();
        $adminExists = $crud->getAdminByEmail($email);

        if ($adminExists) {
            $error = "Email is already registered!";
        } else {
            // Hash the password before saving
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Create a new admin account
            $createResult = $crud->createAdmin($email, $hashedPassword);

            if ($createResult === "Account registered successfully.") {
                // Fetch the admin data for session
                $admin = $crud->getAdminByEmail($email);
                $_SESSION['admin'] = $admin['id'];  // Store admin ID in the session
                header("Location: admin-dashboard.php"); // Redirect to dashboard
                exit();
            } else {
                $error = $createResult;  // Show error if account creation failed
            }
        }
    }
}
?>

<main class="container mt-5">
    <h2>Register Admin Account</h2>

    <!-- Display error message if any -->
    <?php if (isset($error)): ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <!-- Registration Form -->
    <form method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="form-group">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</main>

<?php include('../includes/footer.php'); ?>
