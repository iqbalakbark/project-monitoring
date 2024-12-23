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
<link rel="stylesheet" href="../assets/css/admin-datapeminjaman.css">
<?php include '../includes/navbaradmin.php'; ?>

<div class="admin-content">
    <div class="header">
        <h1>DATA PEMINJAMAN</h1>
    </div>
        <!-- Tabel Data Kendaraan -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kendaraan</th>
                    <th>Tanggal Pemesanan</th>
                    <th>Tanggal Pengembalian</th>
                    <th>Nama Driver</th>
                    <th style='padding-left: 30px;'>Order</th>
                    <th style='padding-left: 0px;' >Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                try {
                    // Query untuk mengambil data dari tabel mobil
                    $stmt = $pdo->query("SELECT id, nama_kendaraan, no_polisi, jenis_kendaraan, status FROM mobil");
                    $no = 1;

                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>
                                <td>{$no}</td>
                                <td>{$row['nama_kendaraan']}</td>
                                <td>{$row['no_polisi']}</td>
                                <td>{$row['jenis_kendaraan']}</td>
                                <td>{$row['status']}</td>
                                <td style='padding-left: 30px;'>{$row['order']}</td>
                                <td style='padding-left: 0px;'>

                                    <a href='edit-car.php?id={$row['id']}' class='btn-add'>Disetujui</a>
                                    <a href='delete-car.php?id={$row['id']}'onclick='return confirm(\"Yakin ingin menghapus data ini?\" );' class='btn-addtolak'>Ditolak</a>
                                </td>
                            </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align:center;'>Tidak ada data peminjaman.</td></tr>";
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
