<?php
session_start();
require_once '../config.php'; // Sesuaikan path untuk file config

// Cek apakah pengguna sudah login dan apakah dia adalah pengguna biasa
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<link rel="stylesheet" href = "../assets/css/kabid-dashboard.css">

<?php include '../includes/navbarkabid.php'; ?>

<div class='kabid-content'>

    <div class="header">
    <h1>Welcome, KABID!</h1>
    <p>Berikut data peminjam kendaraan<p>
    </div>


    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kendaraan</th>
                <th>No Polisi      </th>
                <th>jenis Kendaraan</th>
                <th>status         </th>
                <th>action         </th
            <tr>
        <thead>
            <tbody>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                <a href='edit-car.php?id={$row['id']}' class='btn-add'>Disetujui</a>
                <a href='delete-car.php?id={$row['id']}'onclick='return confirm(\"Yakin ingin menghapus data ini?\" );' class='btn-addtolak'>Ditolak</a>
                </td>
            <tbody>
    </table>
</div>
</div>
</div>





<?php include '../includes/footer.php'; ?>



