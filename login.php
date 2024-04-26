<?php
// Mencegah akses langsung ke file ini
// if (!defined('FROM_LOGIN_PAGE')) {
//   header('Location: login.php');
//   exit;
// }

session_start();
include 'conn.php';

if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Membuat prepared statement untuk memeriksa kecocokan username dan password
  $query = "SELECT * FROM user WHERE username=? AND password=?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

  if (mysqli_num_rows($result) > 0) {
    // Acak session ID
    session_regenerate_id(true);

    // Set session untuk status login
    $_SESSION['status_login'] = true;

    // Set session untuk informasi admin jika diperlukan
    $admin = mysqli_fetch_assoc($result);
    $_SESSION['admin'] = $admin;

    echo '<script>window.location="dashboard.php"</script>';
  } else {

    // Pesan kesalahan disanitasi menggunakan htmlspecialchars()
    $error_message = htmlspecialchars("Maaf, username atau password Anda salah. Silakan coba lagi.", ENT_QUOTES, 'UTF-8');

    echo '<div class="alert alert-danger" role="alert">
        <strong>Kesalahan!</strong> ' . $error_message . '
    </div>';
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Login Admin - MTS NUR IMAN MLANGI</title>
  <link href="assets/img/logo-mts.png" rel="icon">
  <link href="https://fonts.googleapis.com/css?family=Karla:400,700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.materialdesignicons.com/4.8.95/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/template/login/assets/css/login.css">
  <style>
    .brand-wrapper img,
    .brand-wrapper span {
      display: inline-block;
      vertical-align: middle;
      font-size: x-large;
      font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
      padding-left: 5px;
    }
  </style>
</head>

<body>
  <main class="d-flex align-items-center min-vh-100 py-3 py-md-0">
    <div class="container">
      <div class="card login-card">
        <div class="row no-gutters">
          <div class="col-md-5">
            <img src="assets/img/login.jpg" alt="login" class="login-card-img logo">
          </div>
          <div class="col-md-7">
            <div class="card-body">
              <div class="brand-wrapper">
                <img src="assets/img/logo-mts.png" alt="logo" class="logo">
                <span>MTS NUR IMAN MLANGI</span>
              </div>
              <!-- <p class="login-card-description">Selamat Datang</p> -->
              <h4>Selamat Datang</h4>
              <p class="login-card-footer-text">Silahkan masuk sesuai dengan akun Anda</p>
              <form action="#" method="POST">
                <div class="form-group">
                  <label for="username" class="sr-only">Username</label>
                  <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="form-group mb-4">
                  <label for="password" class="sr-only">Password</label>
                  <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                </div>
                <input name="login" id="login" class="btn btn-block login-btn mb-4" type="submit" value="Login">
              </form>
              <nav class="login-card-footer-nav">
              </nav>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</body>

</html>