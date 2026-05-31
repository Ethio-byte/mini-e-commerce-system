<?php
// login.php
require_once 'includes/auth_logic.php';

$error = '';
$success = '';
$redirect = $_GET['redirect'] ?? 'index.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $remember = isset($_POST['remember']);

    $result = login_user($email, $password, $remember);
    if ($result['success']) {
        header("Location: $redirect");
        exit;
    } else {
        $error = $result['message'];
    }
}

include 'includes/header.php';
?>

<main class="container">
    <div class="auth-container">
        <div class="auth-header">
            <h2>Sign In</h2>
            <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.5rem; text-transform: uppercase; letter-spacing: 1px;">Access your Lazarus account</p>
        </div>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if (isset($_GET['message'])): ?>
            <div class="alert alert-info"><?php echo htmlspecialchars($_GET['message']); ?></div>
        <?php endif; ?>

        <form action="login.php?redirect=<?php echo urlencode($redirect); ?>" method="POST">
            <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="email" required placeholder="name@example.com">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required placeholder="••••••••">
            </div>
            
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                <div class="form-check" style="margin-bottom: 0;">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" style="margin-bottom: 0; cursor: pointer;">Remember Me</label>
                </div>
                <a href="#" style="font-size: 0.8rem; color: var(--text-muted); text-decoration: none;">Forgot Password?</a>
            </div>

            <button type="submit" class="btn-lazarus">Sign In</button>
        </form>

        <div class="auth-footer">
            Don't have an account? <a href="signup.php?redirect=<?php echo urlencode($redirect); ?>">Create Account</a>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>
