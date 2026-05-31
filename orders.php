<?php
// orders.php
require_once 'includes/auth_logic.php';
require_login('orders.php');

require_once 'includes/header.php';
$user = get_logged_in_user();
?>

<main class="container">
    <div class="auth-container" style="max-width: 800px;">
        <div class="auth-header">
            <h2>My Orders</h2>
            <p style="font-size: 0.8rem; color: var(--text-muted); margin-top: 0.5rem; text-transform: uppercase; letter-spacing: 1px;">Review your acquisition history</p>
        </div>

        <div style="background: var(--bg); padding: 3rem; border: 1px solid var(--border); text-align: center;">
            <i class="fas fa-box-open" style="font-size: 3rem; color: var(--border); margin-bottom: 1.5rem;"></i>
            <p style="color: var(--text-muted); text-transform: uppercase; letter-spacing: 2px; font-size: 0.8rem;">You have no past orders.</p>
            <a href="index.php" class="btn-lazarus" style="width: auto; padding: 10px 25px; margin-top: 2rem; display: inline-flex;">Start Shopping</a>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>
</body>
</html>
