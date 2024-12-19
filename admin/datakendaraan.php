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
<link rel="stylesheet" href="../assets/css/admin-datakendaraan.css">
<?php include '../includes/navbaradmin.php'; ?>

<div class="admin-content">
    <div class="header">
        <h1>DATA KENDARAAN</h1>
    </div>
    <div class="kiri">
        <!-- Tindakan tambahan -->
        <a href="add-car.php" class="btn btn-add">+ Tambah Kendaraan</a>
       

        <!-- Tabel Data Kendaraan -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kendaraan</th>
                    <th>No. Polisi</th>
                    <th>Jenis Kendaraan</th>
                    <th>Status</th>
                    <th>Action</th>
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
                                <td>
                                    <a href='edit-car.php?id={$row['id']}' class='btn btn-edit'>Edit</a>
                                    <a href='delete-car.php?id={$row['id']}' class='btn btn-delete' onclick='return confirm(\"Yakin ingin menghapus data ini?\");'>Hapus</a>
                                </td>
                            </tr>";
                            $no++;
                        }
                    } else {
                        echo "<tr><td colspan='6' style='text-align:center;'>Tidak ada data kendaraan.</td></tr>";
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
