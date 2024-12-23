<?php
    session_start();
    require_once '../config.php';

if (!isset ($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit;
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>

<link rel="stylesheet" href = "../assets/css/user-historypeminjaman.css">

<?php include '../includes/navbaruser.php'; ?>

<div class='user-content'>

    <div class='header'>
        <h1>historypeminjaman</h1>
    </div>

    <a href= '...' class='btn-add'>Export to excel</a>

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
                <td>belum ada database nyangkut jokk aduh tekacip</td>
            <tbody>
    </table>
</div>
</div>
