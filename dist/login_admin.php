<?php
session_start();

include 'head.php';
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $hashedPasswordInDB = $row['password'];

            if (password_verify($password, $hashedPasswordInDB)) {
                // Password benar
                $_SESSION['admin_username'] = $username;
                // Setelah proses validasi login berhasil, Anda dapat menambahkan kode berikut:
                $_SESSION['logged_in'] = true; // Set session 'logged_in' menjadi true
                $_SESSION['username'] = $username; // Simpan informasi username
                header('Location: index.php'); // Redirect ke halaman index.php
                exit(); // Penting untuk keluar agar skrip tidak dilanjutkan
            } else {
                // Password salah
                $error_message = "Username atau password salah.";
            }
        } else {
            // Username tidak ditemukan
            $error_message = "Username atau password salah.";
        }
    } else {
        // Kesalahan dalam menjalankan query
        $error_message = "Kesalahan dalam menjalankan query: " . mysqli_error($conn);
    }
}
?>



<div class="bg-light min-vh-100 d-flex flex-row align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="" method="post">
                    <div class="card-group d-block d-md-flex row">
                        <div class="card col-md-7 p-4 mb-0">
                            <div class="card-body">
                                <h1>Login Admin</h1>
                                <p class="text-medium-emphasis">Sign In to your account</p>
                                <?php if (isset($error_message)) : ?>
                                    <p style="color: red;"><?php echo $error_message; ?></p>
                                <?php endif; ?>
                                <div class="input-group mb-3"><span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user"></use>
                                        </svg></span>
                                    <input class="form-control" name="username" type="text" placeholder="Username">
                                </div>
                                <div class="input-group mb-4"><span class="input-group-text">
                                        <svg class="icon">
                                            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked"></use>
                                        </svg></span>
                                    <input class="form-control" name="password" type="password" placeholder="Password">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-primary px-4" type="submit">Login</button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <button class="btn btn-link px-0" type="button">Forgot password?</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card col-md-5 text-white bg-primary py-5">
                            <div class="card-body text-center">
                                <div>
                                    <h2>WEB PRESENSI SMK NEGERI 2 MAGELANG</h2>
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>

</html>