# How to Run Your Mini-Ecommerce System

Follow these steps to get your professional tech store up and running on your local machine.

## Option 1: Using PHP's Built-in Server (Easiest)
If you have PHP installed on your system, this is the fastest way:

1. **Open your terminal/command prompt.**
2. **Navigate to the project directory:**
   ```bash
   cd C:\Users\Abei\OneDrive\Desktop\ip-assignment
   ```
3. **Start the PHP server:**
   ```bash
   php -S localhost:8000
   ```
4. **Open your browser** and go to: `http://localhost:8000`

---

## Option 2: Using XAMPP / WAMP / Laragon
If you prefer using a local server environment:

1. **Copy the project folder:**
   - Copy the `ip-assignment` folder.
2. **Paste it into the web root:**
   - For **XAMPP**: `C:\xampp\htdocs\`
   - For **WAMP**: `C:\wamp64\www\`
3. **Start Apache:**
   - Open your XAMPP/WAMP Control Panel and click **Start** next to "Apache".
4. **Open your browser** and go to: `http://localhost/ip-assignment`

---

## Features to Test
1. **Browse Products:** Scroll through the professional grid layout.
2. **Add to Cart:** Click any "Add to Cart" button. Notice the sidebar slides out automatically without the page refreshing!
3. **Manage Quantities:** Use the `+` and `-` buttons in the sidebar to update your cart live.
4. **Checkout:** Click "Checkout" in the sidebar, fill in the shipping form, and place your order to see the confirmation page.

## Troubleshooting
- **No Styles?** Ensure the `assets/css/styles.css` file is in the correct folder.
- **Cart not working?** PHP sessions require a server environment. Make sure you are accessing the site via `http://localhost` and not by opening the `.php` files directly in the browser.
