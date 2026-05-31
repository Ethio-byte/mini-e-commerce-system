// assets/js/app.js
document.addEventListener('DOMContentLoaded', () => {
    const cartBtn = document.getElementById('cart-btn');
    const closeCart = document.getElementById('close-cart');
    const sidebar = document.getElementById('cart-sidebar');
    const overlay = document.getElementById('overlay');
    const cartItemsContainer = document.getElementById('cart-items');
    const cartCount = document.getElementById('cart-count');
    const cartTotal = document.getElementById('cart-total');

    // Sidebar Toggles
    const toggleCart = () => {
        sidebar.classList.toggle('open');
        overlay.classList.toggle('active');
    };

    cartBtn.addEventListener('click', toggleCart);
    closeCart.addEventListener('click', toggleCart);
    overlay.addEventListener('click', toggleCart);

    // AJAX Cart Actions
    const updateCart = async (action, id, qty = 1) => {
        const formData = new FormData();
        formData.append('action', action);
        formData.append('id', id);
        formData.append('qty', qty);

        try {
            const response = await fetch('api/update_cart.php', {
                method: 'POST',
                body: formData
            });
            const data = await response.json();

            if (data.success) {
                cartItemsContainer.innerHTML = data.html;
                cartCount.textContent = data.count;
                
                const totalText = `${data.total} ETB`;
                if (cartTotal) cartTotal.textContent = totalText;
                
                const cartPageTotal = document.getElementById('cart-page-total');
                if (cartPageTotal) cartPageTotal.textContent = totalText;
                
                if (action === 'add' && !sidebar.classList.contains('open')) {
                    toggleCart();
                }

                // If on cart page and action was remove or qty update, 
                // we might want a reload to refresh the main list, 
                // but let's try to just update the total if possible.
                // For simplicity, reload still ensures the main list reflects changes.
                if (window.location.pathname.includes('cart.php')) {
                    location.reload();
                }
            }
        } catch (error) {
            console.error('Error updating cart:', error);
        }
    };

    // Event Delegation for Cart Actions
    document.addEventListener('click', (e) => {
        // Add to Cart
        if (e.target.classList.contains('btn-add-to-cart')) {
            const id = e.target.dataset.id;
            updateCart('add', id);
        }

        // Plus/Minus Quantity
        if (e.target.classList.contains('qty-btn')) {
            const id = e.target.dataset.id;
            const currentQty = parseInt(e.target.parentElement.querySelector('.qty').textContent);
            const newQty = e.target.classList.contains('plus') ? currentQty + 1 : currentQty - 1;
            updateCart('update', id, newQty);
        }

        // Remove Item
        if (e.target.classList.contains('remove-item')) {
            const id = e.target.dataset.id;
            updateCart('remove', id);
        }
    });
});
