<?php
session_start();

// Unset semua variabel session
$_SESSION = array();

// Jangan lupa untuk menghancurkan session
session_destroy();

// Redirect pengguna ke halaman login atau halaman lain yang sesuai
header("Location: login_admin.php");
exit();
?>
