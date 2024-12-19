<?php
session_start();
require_once 'config.php'; // Sambungkan ke database "peminjaman_mobil"

// Cek apakah form dikirim
$error = '';

// Token CSRF untuk menghindari serangan CSRF
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Membuat CSRF token baru jika belum ada
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validasi CSRF token
    if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('CSRF token invalid');
    }

    // Ambil input pengguna dan sanitasi
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = $_POST['password'];

    if (!$email) {
        $error = "Email tidak valid!";
    } else {
        // Query untuk mendapatkan data pengguna berdasarkan email
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                // Simpan data ke session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];  // Simpan role pengguna
                $_SESSION['name'] = $user['name'];

                // Redirect berdasarkan role
                if ($user['role'] === 'admin') {
                    header("Location: admin/dashboard.php"); // Halaman dashboard admin
                    exit;
                } elseif ($user['role'] === 'user') {
                    header("Location: user/dashboard.php"); // Halaman dashboard pengguna
                    exit;
                } else {
                    $error = "Role tidak valid! Hubungi administrator.";
                }
            } else {
                $error = "Email atau password salah!";
            }
        } else {
            $error = "Akun tidak ditemukan!";
        }
    }
}
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<link rel="stylesheet" href="assets/css/login.css">

<div class="login-container">

    <h2>SUCOFINDO</h2>
    <img src="https://www.sucofindo.co.id/wp-content/uploads/2022/08/image-4.webp" alt="Logo" class="login-logo">
    <p class="motto">Assure your confidence</p>
    <p class="motto">Login</p>

    <!-- Menampilkan pesan error jika ada -->
    <?php if ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <!-- CSRF Token -->
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
</div>

<?php include 'includes/footer.php'; ?>
