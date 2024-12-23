<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/admin-datakendaraan.css">
    <title>Data Kendaraan</title>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <?php include '../includes/navbar.php'; ?>
    <?php include '../includes/navbaradmin.php'; ?>

    <div class="admin-content">
        <div class="header">
            <h1>DATA KENDARAAN</h1>
        </div>
        <button id="openModal" class="btn-add">+ Tambah Kendaraan</button>

        <!-- Tabel Data Kendaraan -->
        <table id="carsTable">
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
                <!-- Data akan diisi oleh JavaScript -->
            </tbody>
        </table>
    </div>

    <!-- Modal Add Car -->
    <div id="addCarModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" id="closeModal">&times;</span>
            <h2>Tambah Kendaraan</h2>
            <form id="addCarForm">
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
        const apiUrl = 'admin-car-handler.php';

        // Mendapatkan elemen modal dan tombol
        const modal = document.getElementById("addCarModal");
        const openModalBtn = document.getElementById("openModal");
        const closeModalBtn = document.getElementById("closeModal");

        // Membuka modal
        openModalBtn.onclick = function () {
            modal.style.display = "block";
        };

        // Menutup modal
        closeModalBtn.onclick = function () {
            modal.style.display = "none";
        };

        // Menutup modal jika area luar modal diklik
        window.onclick = function (event) {
            if (event.target === modal) {
                modal.style.display = "none";
            }
        };

        // Load data kendaraan
        async function loadCars() {
            const response = await fetch(apiUrl);
            const data = await response.json();
            const tbody = document.querySelector("#carsTable tbody");
            tbody.innerHTML = '';

            if (data.length > 0) {
                data.forEach((car, index) => {
                    tbody.innerHTML += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${car.nama_kendaraan}</td>
                            <td>${car.no_polisi}</td>
                            <td>${car.jenis_kendaraan}</td>
                            <td>${car.status}</td>
                            <td>
                                <a href="edit-car.php?id=${car.id}">
                                    <img src="../assets/images/edit-icon.png" class="btn">
                                </a>
                                <a href="delete-car.php?id=${car.id}" onclick="return confirm('Yakin ingin menghapus data ini?');">
                                    <img src="../assets/images/delete-icon.png" class="btn">
                                </a>
                            </td>
                        </tr>
                    `;
                });
            } else {
                tbody.innerHTML = '<tr><td colspan="6" style="text-align:center;">Tidak ada data kendaraan.</td></tr>';
            }
        }

        // Tambah kendaraan
        document.getElementById("addCarForm").onsubmit = async function (event) {
            event.preventDefault();
            const formData = new FormData(this);

            const response = await fetch(apiUrl, {
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            alert(result.message);

            if (result.success) {
                modal.style.display = "none";
                loadCars();
            }
        };

        // Load data ketika halaman dibuka
        loadCars();
    </script>
</body>
</html>
