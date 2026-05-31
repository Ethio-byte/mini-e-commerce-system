<?php
// checkout.php
require_once 'includes/auth_logic.php';
require_once 'includes/cart_logic.php';

// Requirement: Show sign in page if guest tries to checkout
if (!is_logged_in()) {
    header('Location: login.php?redirect=checkout.php&message=' . urlencode('Please sign in or create an account to complete your purchase.'));
    exit;
}

require_once 'includes/header.php';
$cart = get_cart();

if (empty($cart)) {
    header('Location: index.php');
    exit;
}

$user = get_logged_in_user();
?>

<main class="container">
    <div class="checkout-container">
        <section class="checkout-form">
            <h2 style="text-transform: uppercase; letter-spacing: 2px; margin-bottom: 2rem;">Shipping Information</h2>
            
            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle" style="margin-right: 10px;"></i>
                    <?php echo htmlspecialchars($_GET['error']); ?>
                </div>
            <?php endif; ?>

            <form action="process_payment.php" method="POST">
                <div class="form-group">
                    <label>Full Name</label>
                    <input type="text" name="name" required placeholder="John Doe" value="<?php echo htmlspecialchars($user['name']); ?>">
                </div>
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" required placeholder="john@example.com" value="<?php echo htmlspecialchars($user['email']); ?>">
                </div>
                <div class="form-group">
                    <label>Shipping Address</label>
                    <input type="text" name="address" required placeholder="123 Avenue">
                </div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label>City</label>
                        <input type="text" name="city" required>
                    </div>
                    <div class="form-group">
                        <label>ZIP Code</label>
                        <input type="text" name="zip" required>
                    </div>
                </div>

                <div class="payment-section">
                    <h3 style="text-transform: uppercase; letter-spacing: 1px; font-size: 0.9rem; border-bottom: 1px solid var(--border); padding-bottom: 0.5rem;">Select Payment Method</h3>
                    <div class="payment-grid">
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="Telebirr" required checked onclick="togglePaymentInfo('telebirr')">
                            <div class="payment-card telebirr">
                                <div class="payment-logo">
                                    <svg viewBox="0 0 100 100" width="30"><circle cx="50" cy="50" r="45" fill="#0067b8"/><path d="M30 30h40v40h-40z" fill="#fff"/><path d="M40 40h20v20h-20z" fill="#0067b8"/></svg>
                                </div>
                                <span>Telebirr</span>
                            </div>
                        </label>
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="CBE Birr" onclick="togglePaymentInfo('cbe')">
                            <div class="payment-card cbe">
                                <div class="payment-logo">
                                    <svg viewBox="0 0 100 100" width="30"><circle cx="50" cy="50" r="45" fill="#4b2d89"/><path d="M30 30h40v40h-40z" fill="#f8b617"/><circle cx="50" cy="50" r="15" fill="#4b2d89"/></svg>
                                </div>
                                <span>CBE Birr</span>
                            </div>
                        </label>
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="Chapa" onclick="togglePaymentInfo('chapa')">
                            <div class="payment-card chapa">
                                <div class="payment-logo">
                                    <svg viewBox="0 0 100 100" width="30"><rect width="100" height="100" rx="20" fill="#6c5ce7"/><path d="M25 50l25 25l25-50" stroke="#fff" stroke-width="10" fill="none"/></svg>
                                </div>
                                <span>Chapa</span>
                            </div>
                        </label>
                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="Bank Transfer" onclick="togglePaymentInfo('bank')">
                            <div class="payment-card bank">
                                <div class="payment-logo">
                                    <i class="fas fa-university" style="font-size: 24px;"></i>
                                </div>
                                <span>Bank Transfer</span>
                            </div>
                        </label>
                    </div>

                    <!-- Payment Requirements Fields -->
                    <div id="payment-details-box" style="margin-top: 1.5rem; background: #fff; border: 1px solid var(--border); padding: 1.5rem; display: none;">
                        <div id="info-mobile" class="payment-info-fields">
                            <div class="form-group">
                                <label id="mobile-label">Telebirr Phone Number</label>
                                <input type="tel" name="phone" id="input-phone" placeholder="0912345678" style="background: var(--bg);" oninput="this.value = this.value.trim()">
                            </div>
                            <div class="form-group" style="margin-bottom: 0;">
                                <label>Payment PIN</label>
                                <input type="password" name="pin" id="input-pin" placeholder="••••" maxlength="4" style="background: var(--bg);" oninput="this.value = this.value.trim()">
                                <p style="font-size: 10px; color: var(--text-muted); margin-top: 5px;">Securely encrypted for transaction verification.</p>
                            </div>
                        </div>
                        <div id="info-chapa" class="payment-info-fields" style="display: none;">
                            <div class="form-group">
                                <label>Card Number</label>
                                <input type="text" name="card_no" id="input-card" placeholder="4111 •••• •••• ••••" style="background: var(--bg);" oninput="this.value = this.value.trim()">
                            </div>
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label>Expiry Date</label>
                                    <input type="text" name="expiry" id="input-expiry" placeholder="MM/YY" style="background: var(--bg);" oninput="this.value = this.value.trim()">
                                </div>
                                <div class="form-group" style="margin-bottom: 0;">
                                    <label>CVV</label>
                                    <input type="password" name="cvv" id="input-cvv" placeholder="•••" maxlength="3" style="background: var(--bg);" oninput="this.value = this.value.trim()">
                                </div>
                            </div>
                        </div>
                        <div id="info-bank" class="payment-info-fields" style="display: none;">
                            <div class="form-group">
                                <label>Your Bank Account Number</label>
                                <input type="text" name="sender_acc" id="input-bank-acc" placeholder="Enter your account no." style="background: var(--bg);" oninput="this.value = this.value.trim()">
                                <p style="font-size: 10px; color: var(--text-muted); margin-top: 5px;">The account from which you will transfer funds.</p>
                            </div>
                            <p style="font-size: 0.85rem; color: var(--text-muted); margin-bottom: 1rem;"><strong>Transfer to:</strong></p>
                            <div style="font-size: 0.8rem; line-height: 1.8; background: var(--bg); padding: 10px;">
                                <div style="display: flex; justify-content: space-between;">
                                    <span><strong>CBE Account</strong></span>
                                    <span>1000123456789</span>
                                </div>
                                <div style="display: flex; justify-content: space-between;">
                                    <span><strong>Store Holder</strong></span>
                                    <span>LAZARUS SYSTEMS</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-lazarus" style="margin-top: 3rem;">Complete Acquisition</button>
            </form>
        </section>

        <section class="order-summary">
            <!-- ... -->
        </section>
    </div>
</main>

<script>
    function togglePaymentInfo(method) {
        const box = document.getElementById('payment-details-box');
        const infos = document.querySelectorAll('.payment-info-fields');
        const mobileLabel = document.getElementById('mobile-label');
        
        box.style.display = 'block';
        infos.forEach(i => i.style.display = 'none');

        if (method === 'telebirr' || method === 'cbe') {
            document.getElementById('info-mobile').style.display = 'block';
            mobileLabel.innerText = method === 'telebirr' ? 'Telebirr Phone Number' : 'CBE Birr Phone Number';
        } else if (method === 'chapa') {
            document.getElementById('info-chapa').style.display = 'block';
        } else if (method === 'bank') {
            document.getElementById('info-bank').style.display = 'block';
        }
    }
    
    // Initialize on load
    document.addEventListener('DOMContentLoaded', () => {
        togglePaymentInfo('telebirr');
    });
</script>

<script src="assets/js/app.js"></script>
<?php include 'includes/footer.php'; ?>
</body>
</html>
