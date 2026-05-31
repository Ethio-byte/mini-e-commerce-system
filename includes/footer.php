<?php
// includes/footer.php
?>
    <footer class="main-footer">
        <div class="container footer-content">
            <div class="footer-section brand-info">
                <a href="index.php" class="logo" style="margin-bottom: 20px;">
                    <img src="assets/images/elogo.jpg" alt="LAZARUS" class="logo-img">
                    <span>LAZARUS</span>
                </a>
                <p class="description">
                    Curated excellence for the modern individual. LAZARUS is a premier destination for high-performance electronics, handcrafted apparel, and refined lifestyle essentials, serving the global community from the heart of Ethiopia.
                </p>
                <div class="contact-info">
                    <p><i class="fas fa-envelope"></i> admin@lazarus.et</p>
                    <p><i class="fas fa-headset"></i> support@lazarus.et</p>
                </div>
            </div>

            <div class="footer-section links">
                <h4>Collections</h4>
                <ul>
                    <li><a href="collection.php?id=electronics">Electronics</a></li>
                    <li><a href="collection.php?id=apparel">Apparel & Bags</a></li>
                    <li><a href="collection.php?id=workspace">Workspace</a></li>
                    <li><a href="collection.php?id=home">Home & Living</a></li>
                </ul>
            </div>

            <div class="footer-section links">
                <h4>Support</h4>
                <ul>
                    <li><a href="#">Shipping Policy</a></li>
                    <li><a href="#">Returns & Exchanges</a></li>
                    <li><a href="#">Membership Info</a></li>
                    <li><a href="#">Inquiries</a></li>
                </ul>
            </div>

            <div class="footer-section newsletter">
                <h4>Newsletter</h4>
                <p>Acquire updates on new collections and limited releases.</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Email Address">
                    <button type="button" class="btn-lazarus">Join</button>
                </form>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p>&copy; <?php echo date('Y'); ?> LAZARUS Store. All rights reserved. | Currency: ETB</p>
            </div>
        </div>
    </footer>
