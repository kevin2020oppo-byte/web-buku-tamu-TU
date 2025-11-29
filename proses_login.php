<?php
session_start();

// Username dan password yang benar
$admin_user = "admin";
$admin_pass = "12345";

if ($_POST['username'] == $admin_user && $_POST['password'] == $admin_pass) {
    $_SESSION['admin'] = $admin_user;
    header("Location: dashboard.php");
    exit();
} else {
    echo "<script>
        alert('Username atau password salah!');
        window.location.href='beranda.php';
    </script>";
}
?>
