<?php
// Include config file untuk koneksi database
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil inputan dari form
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password

    // Tentukan role default (misalnya 'user')
    $role = 'user';
    $created_at = date('Y-m-d H:i:s'); // Tanggal saat pendaftaran

    // Query SQL untuk memasukkan data ke tabel users
    $query = "INSERT INTO users (name, email, password, role, created_at) VALUES (:name, :email, :password, :role, :created_at)";
    $stmt = $pdo->prepare($query);

    // Bind parameter
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':role', $role);
    $stmt->bindParam(':created_at', $created_at);

    // Eksekusi query
    if ($stmt->execute()) {
        header("Location: login.php"); // Redirect ke halaman login jika berhasil
        exit;
    } else {
        $error = "Gagal mendaftarkan pengguna.";
    }
}
?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<link rel="stylesheet" href="assets/css/register.css">

<div class="register-container">
<h2>SUCOFINDO</h2>
    <img src="https://www.sucofindo.co.id/wp-content/uploads/2022/08/image-4.webp" alt="Logo" class="register-logo">
    <p class="motto">Assure your confidence</p>
    <p class="motto">Register</P>

    <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    <form method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Register</button>
    </form>
    <p>Sudah punya akun? <a href="login.php">login di sini</a></p>
</div>

<?php include 'includes/footer.php'; ?>
