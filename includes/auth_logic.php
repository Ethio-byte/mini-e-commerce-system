<?php
// includes/auth_logic.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

define('USERS_FILE', __DIR__ . '/../data/users.json');

function get_all_users() {
    if (!file_exists(USERS_FILE)) {
        return [];
    }
    $json = file_get_contents(USERS_FILE);
    return json_decode($json, true) ?: [];
}

function save_users($users) {
    file_put_contents(USERS_FILE, json_encode($users, JSON_PRETTY_PRINT));
}

function register_user($name, $email, $password) {
    $users = get_all_users();
    
    // Check if user already exists
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            return ['success' => false, 'message' => 'Email already registered.'];
        }
    }
    
    $new_user = [
        'id' => uniqid(),
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    $users[] = $new_user;
    save_users($users);
    
    return ['success' => true, 'message' => 'Registration successful!'];
}

function login_user($email, $password, $remember = false) {
    $users = get_all_users();
    
    foreach ($users as $user) {
        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email']
            ];
            
            if ($remember) {
                // Set a long-lived cookie if needed, but for simplicity we use session
                // In a real app, we'd set a token in a cookie and store it in DB
            }
            
            return ['success' => true];
        }
    }
    
    return ['success' => false, 'message' => 'Invalid email or password.'];
}

function logout_user() {
    unset($_SESSION['user']);
    // session_destroy(); // Better not to destroy everything as we might have cart
}

function is_logged_in() {
    return isset($_SESSION['user']);
}

function get_logged_in_user() {
    return $_SESSION['user'] ?? null;
}

function require_login($redirect_to = null) {
    if (!is_logged_in()) {
        $url = 'login.php';
        if ($redirect_to) {
            $url .= '?redirect=' . urlencode($redirect_to);
        }
        header("Location: $url");
        exit;
    }
}
?>