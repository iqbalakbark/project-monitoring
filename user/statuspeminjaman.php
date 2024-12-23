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

<link rel="stylesheet" href = "../assets/css/user-statuspeminjaman.css">

<?php include '../includes/navbaruser.php'; ?>

<div class='user-content'>

    <div class="header">
    <h1>Welcome, user!</h1>
    <p>Silahkan pilih kendaraan terlebih dahulu<p>
    </div>


    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kendaraan</th>
                <th>No Polisi      </th>
                <th>jenis Kendaraan</th>
                <th>status         </th>
            <tr>
        <thead>
            <tbody>
                <td>belum ada database nyangkut</td>
                <td></td>
                <td></td>
                <td></td>
                <td><a href="add-car.php" class="btn-add"> status </a></td>
            <tbody>
    </table>
</div>
</div>
</div>





<?php include '../includes/footer.php'; ?>



