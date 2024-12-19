<?php
session_start();
require_once '../config.php'; // Sesuaikan path untuk file config

// Cek apakah pengguna sudah login dan apakah dia adalah pengguna biasa
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php"); // Arahkan ke login jika tidak ada sesi atau bukan pengguna
    exit;
}

?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<div class="user-dashboard">
    <h1>Welcome, <?= $_SESSION['name'] ?>!</h1>
    <p>Dashboard Pengguna untuk mengelola peminjaman mobil.</p>
    
    <!-- Informasi peminjaman mobil yang relevan untuk pengguna -->
</div>

<?php include '../includes/footer.php'; ?>
