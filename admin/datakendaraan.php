<?php
session_start();
require_once '../config.php'; // Koneksi database

// Cek apakah pengguna sudah login dan admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

// Proses form jika tombol submit ditekan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_kendaraan = $_POST['nama_kendaraan'];
    $no_polisi = $_POST['no_polisi'];
    $jenis_kendaraan = $_POST['jenis_kendaraan'];
    $status = $_POST['status'];

    try {
        // Query untuk menambah data kendaraan
        $stmt = $pdo->prepare("INSERT INTO mobil (nama_kendaraan, no_polisi, jenis_kendaraan, status) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nama_kendaraan, $no_polisi, $jenis_kendaraan, $status]);
        echo "<script>alert('Kendaraan berhasil ditambahkan!');</script>";
    } catch (PDOException $e) {
        echo "<script>alert('Terjadi kesalahan: {$e->getMessage()}');</script>";
    }
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
        <!-- Tombol untuk membuka modal -->
        <button id="openModal" class="btn-add">+ Tambah Kendaraan</button>

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
                                    <a href='edit-car.php?id={$row['id']}'>
                                    <img src='../assets/images/edit-icon.png' class='btn'></a>
                                    <a href='delete-car.php?id={$row['id']}' onclick='return confirm(\"Yakin ingin menghapus data ini?\");'>
                                    <img src='../assets/images/delete-icon.png' class='btn'></a>
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


<!-- Modal Add Car -->
<div id="addCarModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" id="closeModal">&times;</span>
        <h2>Tambah Kendaraan</h2>
        <!-- Form untuk tambah kendaraan -->
        <form method="POST">
            <div class="form-group">
                <label for="nama_kendaraan">Nama Kendaraan:</label>
                <input type="text" id="nama_kendaraan" name="nama_kendaraan" required>
            </div>

            <div class="form-group">
                <label for="no_polisi">No. Polisi:</label>
                <input type="text" id="no_polisi" name="no_polisi" required>
            </div>

            <div class="form-group">
                <label for="jenis_kendaraan">Jenis Kendaraan:</label>
                <input type="text" id="jenis_kendaraan" name="jenis_kendaraan" required>
            </div>

            <div class="form-group">
                <label for="status">Status:</label>
                <select id="status" name="status" required>
                    <option value="Tersedia">Tersedia</option>
                    <option value="Tidak Tersedia">Tidak Tersedia</option>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn-add">Tambah Kendaraan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Mendapatkan elemen modal dan tombol
    const modal = document.getElementById("addCarModal");
    const openModalBtn = document.getElementById("openModal");
    const closeModalBtn = document.getElementById("closeModal");

    // Membuka modal
    openModalBtn.onclick = function() {
        modal.style.display = "block";
    }

    // Menutup modal
    closeModalBtn.onclick = function() {
        modal.style.display = "none";
    }

    // Menutup modal jika area luar modal diklik
    window.onclick = function(event) {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    }
</script>



