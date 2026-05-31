<?php
// signup.php
require_once 'includes/auth_logic.php';

$error = '';
$redirect = $_GET['redirect'] ?? 'index.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if ($password !== $confirm_password) {
        $error = 'Passwords do not match.';
    } else {
        $result = register_user($name, $email, $password);
        if ($result['success']) {
            // Log them in immediately or redirect to login
            login_user($email, $password);
            header("Location: $redirect");
            exit;
        } else {
            $error = $result['message'];
        }
    }
}

include 'includes/header.php';
?>

<main class="container">
    <div class="auth-container">
        <div class="auth-header">
            <h2>Sign Up</h2>
            <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.5rem; text-transform: uppercase; letter-spacing: 1px;">Join the Lazarus community</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="signup.php?redirect=<?php echo urlencode($redirect); ?>" method="POST">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="name" required placeholder="John Doe">
            </div>
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="••••••••">
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" required placeholder="••••••••">
            </div>

            <button type="submit" class="btn-lazarus" style="margin-top: 1rem;">Create Account</button>
        </form>

        <div class="auth-footer">
            Already have an account? <a href="login.php?redirect=<?php echo urlencode($redirect); ?>">Sign In</a>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>
