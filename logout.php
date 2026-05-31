<?php
// logout.php
require_once 'includes/auth_logic.php';
logout_user();
header('Location: index.php');
exit;
?>