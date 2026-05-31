<?php
// account.php
require_once 'includes/auth_logic.php';
require_login('account.php');

require_once 'includes/header.php';
$user = get_logged_in_user();
?>

<main class="container">
    <div class="auth-container" style="max-width: 800px;">
        <div class="auth-header">
            <h2>My Account</h2>
            <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.5rem; text-transform: uppercase; letter-spacing: 1px;">Manage your personal information</p>
        </div>

        <div style="background: var(--bg); padding: 2rem; border: 1px solid var(--border);">
            <div style="margin-bottom: 2rem;">
                <h3 style="font-size: 0.9rem; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 1rem;">Profile Details</h3>
                <div style="display: grid; grid-template-columns: 150px 1fr; gap: 1rem; font-size: 0.9rem;">
                    <span style="color: var(--text-muted);">Full Name:</span>
                    <strong><?php echo htmlspecialchars($user['name']); ?></strong>
                    
                    <span style="color: var(--text-muted);">Email Address:</span>
                    <strong><?php echo htmlspecialchars($user['email']); ?></strong>
                    
                    <span style="color: var(--text-muted);">Member Since:</span>
                    <strong>May 31, 2026</strong>
                </div>
            </div>
            
            <button class="btn-lazarus" style="width: auto; padding: 10px 25px;">Edit Profile</button>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>
