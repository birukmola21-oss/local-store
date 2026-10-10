<?php
// register.php - User Registration Page
require_once 'db.php';
require_once 'header.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name'] ?? '');
    $email     = trim($_POST['email'] ?? '');
    $username  = trim($_POST['username'] ?? '');
    $password  = $_POST['password'] ?? '';

    // Basic Validation
    if (empty($full_name) || empty($email) || empty($username) || empty($password)) {
        $errors[] = "All fields are required.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    } else {
        // Check if username or email already exists
        $checkStmt = $pdo->prepare("SELECT id FROM users WHERE username = :username OR email = :email");
        $checkStmt->execute(['username' => $username, 'email' => $email]);
        
        if ($checkStmt->fetch()) {
            $errors[] = "Username or Email already taken.";
        } else {
            // Hash the password securely
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            try {
                $stmt = $pdo->prepare("INSERT INTO users (full_name, email, username, password) VALUES (:full_name, :email, :username, :password)");
                $stmt->execute([
                    'full_name' => $full_name,
                    'email'     => $email,
                    'username'  => $username,
                    'password'  => $hashedPassword
                ]);
                $success = "Registration successful! You can now login.";
            } catch (PDOException $e) {
                $errors[] = "Registration failed. Please try again.";
            }
        }
    }
}
?>

<div class="form-container">
    <h2>Create an Account</h2>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <?php foreach ($errors as $error): ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success">
            <p><?= htmlspecialchars($success) ?> <a href="login.php">Login here</a></p>
        </div>
    <?php endif; ?>

    <form method="POST" action="register.php" class="auth-form">
        <div class="form-group">
            <label for="full_name">Full Name</label>
            <input type="text" id="full_name" name="full_name" required>
        </div>

        <div class="form-group">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>

        <button type="submit" class="btn-primary btn-large">Register</button>
    </form>
    <p class="auth-switch">Already have an account? <a href="login.php">Login here</a></p>
</div>

<?php require_once 'footer.php'; ?>