<?php
// contact.php - Contact Us & Message Submission
require_once 'db.php';
require_once 'header.php';

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        $error = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email address format.";
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (:name, :email, :subject, :message)");
            $stmt->execute([
                'name'    => $name,
                'email'   => $email,
                'subject' => $subject,
                'message' => $message
            ]);
            $success = "Thank you! Your message has been sent successfully.";
        } catch (PDOException $e) {
            $error = "Failed to send message. Please try again later.";
        }
    }
}
?>

<div class="form-container" style="max-width: 600px;">
    <h2>Contact Us</h2>
    <p style="text-align: center; margin-bottom: 1.5rem; color: #555;">Have questions or feedback? Send us a message!</p>

    <?php if ($success): ?>
        <div class="alert alert-success">
            <p><?= htmlspecialchars($success) ?></p>
        </div>
    <?php endif; ?>

    <?php if ($error): ?>
        <div class="alert alert-danger">
            <p><?= htmlspecialchars($error) ?></p>
        </div>
    <?php endif; ?>

    <form method="POST" action="contact.php" class="auth-form">
        <div class="form-group">
            <label for="name">Your Name</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="email">Your Email</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" required>
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" style="width: 100%; padding: 0.7rem; border: 1px solid #ccc; border-radius: 4px;" required></textarea>
        </div>

        <button type="submit" class="btn-primary btn-large">Send Message</button>
    </form>
</div>

<?php require_once 'footer.php'; ?>