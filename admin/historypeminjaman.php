<?php
session_start();
require_once '../config.php'; // Koneksi database

// Cek apakah pengguna sudah login dan admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}
?>

<?php include '../includes/header.php'; ?>
<?php include '../includes/navbar.php'; ?>
<link rel="stylesheet" href="../assets/css/admin-historypeminjaman.css">
<?php include '../includes/navbaradmin.php'; ?>

<div class="admin-content">
    <div class="header">
        <h1>HISTORY PEMESANAN</h1>
    </div>
    <a href="add-car.php" class="btn-add">export to excel</a>
        <!-- Tabel History Pemesanan -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Pemesanan</th>
                    <th>Nama Kendaraan</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Nama Driver</th>
                    <th>Order</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    // Query untuk mengambil data dari tabel pemesanan
                    $stmt = $pdo->query("SELECT p.id_pemesanan, p.nama_kendaraan, p.tanggal_pemesanan, p.nama_driver, p.order
                                         FROM pemesanan p
                                         ORDER BY p.tanggal_pemesanan DESC");
                    $no = 1;

                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['id_pemesanan']}</td>
                                <td>{$row['nama_kendaraan']}</td>
                                <td>{$row['tanggal_pemesanan']}</td>
                                <td>{$row['nama_driver']}</td>
                                <td>{$row['order']}</td>
                            </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align:center;'>Tidak ada history pemesanan.</td></tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='6' style='text-align:center;'>Terjadi kesalahan: {$e->getMessage()}</td></tr>";
                }
                ?>
            </tbody>
        </table>

    </div>
            </div>
</div>
<?php include '../includes/footer.php'; ?>
