<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "db_belajar_keamanan");
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = mysqli_prepare($conn, "SELECT id, username, password FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if ($row['password'] === $password || $row['password'] === md5($password)) {
            session_regenerate_id(true);

            $_SESSION['login'] = true;
            $_SESSION['username'] = $row['username'];

            if (strtolower($row['username']) === 'budi') {
                $_SESSION['nama_user'] = 'Budi';
                $_SESSION['level'] = 1;
            } elseif (strtolower($row['username']) === 'siti') {
                $_SESSION['nama_user'] = 'Siti';
                $_SESSION['level'] = 2;
            } elseif (strtolower($row['username']) === 'wati') {
                $_SESSION['nama_user'] = 'Wati';
                $_SESSION['level'] = 2;
            } else {
                $_SESSION['nama_user'] = $row['username'];
                $_SESSION['level'] = 2;
            }

            header("Location: beranda.php");
            exit;
        }
    }

    echo "Kombinasi username dan password salah.";
    echo '<br> <a href="index.php">Balik</a>';

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>