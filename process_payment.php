<?php
// process_payment.php
require_once 'includes/auth_logic.php';

if (!is_logged_in()) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$payment_method = $_POST['payment_method'] ?? 'Telebirr';
$customer_name = $_POST['name'] ?? '';

// Strict Validation
$isValid = true;
$errorMsg = "";

if ($payment_method === 'Telebirr' || $payment_method === 'CBE Birr') {
    if (empty(trim($_POST['phone'])) || empty(trim($_POST['pin']))) {
        $isValid = false;
        $errorMsg = "Mobile number and Payment PIN are required.";
    }
} elseif ($payment_method === 'Chapa') {
    if (empty(trim($_POST['card_no'])) || empty(trim($_POST['cvv']))) {
        $isValid = false;
        $errorMsg = "Card details are incomplete.";
    }
} elseif ($payment_method === 'Bank Transfer') {
    if (empty(trim($_POST['sender_acc']))) {
        $isValid = false;
        $errorMsg = "Your Bank Account Number is required for transfer verification.";
    }
}

if (!$isValid) {
    header('Location: checkout.php?error=' . urlencode($errorMsg));
    exit;
}

$phone = $_POST['phone'] ?? '';
$sender_acc = $_POST['sender_acc'] ?? ($_POST['card_no'] ?? $phone);

// We'll pass the form data to confirmation.php using session or hidden inputs
$_SESSION['pending_order'] = $_POST;

require_once 'includes/header.php';
?>

<main class="container">
    <div class="processing-container">
        <div class="loader-lazarus"></div>
        <h2 style="text-transform: uppercase; letter-spacing: 5px; font-weight: 800; margin-bottom: 1rem;">Processing Acquisition</h2>
        <p style="color: var(--text-muted); text-transform: uppercase; letter-spacing: 2px; font-size: 0.8rem;">
            Finalizing your secure transaction with <strong><?php echo $payment_method; ?></strong>...
        </p>
    </div>
</main>

<script>
    // Simplified simulation
    setTimeout(() => {
        window.location.href = 'confirmation.php';
    }, 3000);
</script>

<?php include 'includes/footer.php'; ?>
</body>
</html>
