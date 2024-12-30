<?php
    session_start();
    require_once '../config.php';

?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<link rel="stylesheet" href = "../assets/css/kabid-historypeminjaman.css">

<?php include '../includes/navbarkabid.php'; ?>

<div class='kabid-content'>
    <div class='header'>
        <h1>historypeminjaman</h1>
    </div>
    <a href= '...' class='excel'>Export to excel</a>



    <table>
        <thead>
            <tr>
                <th>NO</th>
                <th>ID Pemesanan</th>
                <th>Nama Kendaraan</th>
                <th>Tanggal Pemesanan</th>
                <th>Nama Driver</th>
                <th>Order</th>
            <tr>
        <thead>
            <tbody>
                <td></td>
            <tbody>
    </table>
</div>
</div>
