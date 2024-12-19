<?php
session_start();
require_once '../config.php'; // Sesuaikan path untuk file config

// Cek apakah pengguna sudah login dan apakah dia adalah admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php"); // Arahkan ke login jika tidak ada sesi atau bukan admin
    exit;
}
?>
<?php include '../includes/header.php'; ?>

<?php include '../includes/navbar.php'; ?>

<!-- Pastikan path CSS sudah benar -->
<link rel="stylesheet" href="../assets/css/admin-dashboard.css"> <!-- Sesuaikan dengan path CSS dashboard admin Anda -->

<?php include '../includes/navbaradmin.php'; ?>

<!-- Konten Utama di Tengah -->
<div class="admin-content">
    
    <div class="header"> 
        <h1>Welcome, Admin!</h1> 
    </div>
    
    <div class="kiri">
        <p><a href="...">Dashboard Admin untuk mengelola sistem peminjaman mobil</a></p>
        
        <h2>Monitoring Peminjaman Mobil</h2>
        <p>Informasi dan kontrol peminjaman mobil.</p>
        
        <!-- Tabel untuk monitoring peminjaman -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Mobil</th>
                    <th>Status</th>
                    <th>Tanggal Peminjaman</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Mobil A</td>
                    <td>Disetujui</td>
                    <td>2024-12-20</td>
                    <td><a href="#" class="btn">Detail</a></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Mobil B</td>
                    <td>Menunggu Persetujuan</td>
                    <td>2024-12-21</td>
                    <td><a href="#" class="btn">Detail</a></td>
                </tr>
            </tbody>
        </table>
        
        <!-- Tindakan tambahan jika diperlukan -->
        <a href="add-car.php" class="btn">Tambah Mobil</a>
        
        <!-- Grafik untuk Data Mobil -->
        <h3>Total Peminjaman Mobil</h3>
        <canvas id="peminjamanChart"></canvas>
        
        <h3>Pemesanan Mobil per Bulan</h3>
        <canvas id="pemesananChart"></canvas>
        
        <h3>Jenis Kendaraan</h3>
        <canvas id="jenisKendaraanChart"></canvas>
        
        <h3>Data Kendaraan</h3>
        <canvas id="dataKendaraanChart"></canvas>
        
        <h3>Histori Pemesanan</h3>
        <canvas id="historiChart"></canvas>
        
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        <script>
            // Total Peminjaman Mobil
            const peminjamanChart = new Chart(document.getElementById('peminjamanChart'), {
                type: 'bar',
                data: {
                    labels: ['Mobil A', 'Mobil B', 'Mobil C'], // Nama Mobil
                    datasets: [{
                        label: 'Total Peminjaman',
                        data: [5, 7, 3], // Jumlah Peminjaman
                        backgroundColor: '#007bff',
                        borderColor: '#007bff',
                        borderWidth: 1
                    }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        // Pemesanan Mobil per Bulan
        const pemesananChart = new Chart(document.getElementById('pemesananChart'), {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'], // Bulan
                datasets: [{
                    label: 'Pemesanan Mobil',
                    data: [12, 19, 3, 5, 2, 3], // Jumlah Pemesanan
                    fill: false,
                    borderColor: '#28a745',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        // Jenis Kendaraan
        const jenisKendaraanChart = new Chart(document.getElementById('jenisKendaraanChart'), {
            type: 'pie',
            data: {
                labels: ['Sedan', 'SUV', 'Hatchback', 'MPV'], // Jenis Kendaraan
                datasets: [{
                    label: 'Jenis Kendaraan',
                    data: [10, 15, 5, 3], // Jumlah kendaraan per jenis
                    backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#FF33A1']
                }]
            }
        });
        
        // Data Kendaraan
        const dataKendaraanChart = new Chart(document.getElementById('dataKendaraanChart'), {
            type: 'bar',
            data: {
                labels: ['Mobil A', 'Mobil B', 'Mobil C'], // Nama Mobil
                datasets: [{
                    label: 'Jumlah Kendaraan',
                    data: [3, 5, 7], // Jumlah kendaraan tersedia
                    backgroundColor: '#f39c12',
                    borderColor: '#f39c12',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        
        // Histori Pemesanan
        const historiChart = new Chart(document.getElementById('historiChart'), {
            type: 'line',
            data: {
                labels: ['2024-01', '2024-02', '2024-03', '2024-04', '2024-05'], // Tanggal atau bulan
                datasets: [{
                    label: 'Histori Pemesanan',
                    data: [10, 5, 8, 12, 6], // Jumlah pemesanan per bulan
                    fill: false,
                    borderColor: '#ffc107',
                    tension: 0.1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
        </script>
    </div>
</div>
