<?php

// Koneksi ke database
include "../koneksi.php";

// SWEET ALERT
function pesan($judul, $kata, $status)
{
  $pesan = "<script>
  Swal.fire('$judul','$kata','$status')</script>";
  return $pesan;
}


// LOGIN
session_start();

if (isset($_SESSION["login"])) {
  header("location: dashboard.php");
  exit;
}

if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $result = mysqli_query($conn, "SELECT * FROM `penjual` WHERE username = '$username'");
  // Cek Username
  if (mysqli_num_rows($result) === 1) {
    // Cek Password
    $data = mysqli_fetch_assoc($result);
    if (password_verify($password, $data["password"])) {

      // Set SESSION
      $_SESSION["login"] = false;
      $_SESSION["id_penjual"] = $data["id_penjual"];
      $_SESSION["name"] = $data["name"];
      // echo $_SESSION["login"] = true;
      header("location: dashboard.php");
      exit;
    }
  }
  $error = true;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>E-Market • Login Seller</title>

  <!-- Bootstrap -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" /> -->

  <!-- sweet alert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- fontawesome new -->
  <link rel="stylesheet" type="text/css" href="../fontawesome-free/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="../fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  <link rel="stylesheet" href="style-login.css" />
</head>

<body>
  <!-- navbar -->
  <section id="header">
        <a href="../homepage/homepage.php"><img src="../img/logo/logo.png" class="logo" alt=""></a>
        

        <div>
            <ul id="navbar">
                <li><a href="../homepage/wishlist.php">Cart</a></li>
                <li><a href="../homepage/contact.php">Contact</a></li>
                <i id="close" class="fa-solid fa-xmark"></i>
            </ul>
        </div>

        <div id="mobile">
            <i id="bar" class="fas fa-outdent"></i>
        </div>

    </section>

  <?php
  // REGISTRASI
  function registrasi($data)
  {

    // FILE GAMBAR
    // $user = $_POST['username'];
    // $name = $_POST['name'];
    // $pass = $_POST['password'];
    // $telp = $_POST['telepon'];

    // $gambar = basename($_FILES['gambar']['name']);

    global $conn;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $name = $data["name"];
    $hp = $data["hp"];

    $gambar = basename($_FILES['gambar']['name']);


    // $password2 = mysqli_real_escape_string($conn, $data["password2"]);

    // Cek username sudah ada atau belum
    $result = mysqli_query($conn, "SELECT username FROM penjual WHERE
        username = '$username'");
    if (mysqli_fetch_assoc($result)) {

      echo pesan("Oopss...", "Username has registered", "error");
      return 0;
    }

    // Enskripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Tambahkan User baru ke database
    //yy
    $ekstensi_diperbolehkan  = array('png', 'jpg', 'jpeg');
    $nama = $_FILES['gambar']['name'];
    $x = explode('.', $nama);
    $ekstensi = strtolower(end($x));
    $ukuran  = $_FILES['gambar']['size'];
    $file_tmp = $_FILES['gambar']['tmp_name'];

    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
      if ($ukuran < 1044070) {

        move_uploaded_file($file_tmp, '../img/logo/' . $nama);
        $query = mysqli_query($conn, "INSERT INTO `penjual`(`id_penjual`, `username`, `name`, `password`, `telepon`, `profil`) 
            VALUES ('','$username','$name','$password','$hp', '$gambar')");
        return mysqli_affected_rows($conn);
        if ($query) {

          echo pesan("Good Job!", "username successfully added", "success");
        } else {
          echo pesan("Oops...", "Failed to upload image", "error");
        }
      } else {
        echo pesan("Oops...", "File size is too big", "warning");
      }
    } else {
      echo pesan("Oops...", "Uploaded file extensions are not allowed", "warning");
    }
    //yy



  }

  if (isset($_POST["register"])) {

    if (registrasi($_POST) > 0) {
      echo pesan("Good Job!", "username successfully added", "success");
    } else {
      echo mysqli_error($conn);
    }
  }

  ?>

  <main>
    <div class="box">
      <div class="inner-box">
        <div class="forms-wrap">

          <!-- LOGIN -->
          <form action="" method="post" autocomplete="off" class="sign-in-form">
            <div class="logo">
              <!-- <img src="./img/logo.png" alt="easyclass" /> -->
            </div>

            <div class="heading">
              <h2>E-Market</h2>
              <h3>Login Seller</h3>
              <h6>Not registred yet?</h6>
              <a href="#" class="toggle">Register</a>

            </div>
            <div class="actual-form">
              <?php if (isset($error)) : ?>
                <p style="color: red;">username/password salah</p>
              <?php endif; ?>
              <div class="input-wrap">
                <input type="text" name="username" minlength="3" class="input-field" autofocus autocomplete="off" required />
                <label>Name</label>
              </div>

              <div class="input-wrap">
                <input type="password" name="password" minlength="3" class="input-field" autocomplete="off" required />
                <label>Password</label>
              </div>

              <input type="submit" name="login" value="Sign In" class="sign-btn" />

              <p class="text">
                Forgotten your password or you login datails?
                <a href="#">Get help</a> signing in
              </p>
            </div>
          </form>

          <!-- REGISTRASI -->
          <form action="" method="post" enctype="multipart/form-data" autocomplete="off" class="sign-up-form">
            <div class="logo">
              <!-- <img src="./img/logo.png" alt="easyclass" /> -->

            </div>

            <div class="heading">
              <h2>E-Market</h2>
              <h3>Register Seller</h3>
              <h6>Already have an account?</h6>
              <a href="#" class="toggle">Login</a>
            </div>

            <div class="actual-form">
              <div class="input-wrap">
                <input type="text" name="username" minlength="3" class="input-field" autofocus autocomplete="off" required />
                <label>Username</label>
              </div>
              <div class="input-wrap">
                <input type="text" name="name" minlength="3" class="input-field" autocomplete="off" required />
                <label>Name</label>
              </div>
              <div class="input-wrap">
                <input type="password" name="password" minlength="3" class="input-field" autocomplete="off" required />
                <label>Password</label>
              </div>
              <div class="input-wrap">
                <input type="text" name="hp" class="input-field" autocomplete="off" required />
                <label>Handphone</label>
              </div>
              <div class="input-wrap">
                <input name="gambar" type="file" class="form-control">
              </div>
              <input type="submit" name="register" value="Sign Up" class="sign-btn" />

              <p class="text">
                By signing up, I agree to the
                <a href="#">Terms of Services</a> and
                <a href="#">Privacy Policy</a>
              </p>
            </div>
          </form>
        </div>

        <div class="carousel">
          <div class="images-wrapper">
            <img src="./img/image1.png" class="image img-1 show" alt="" />
            <img src="./img/image2.png" class="image img-2" alt="" />
            <img src="./img/image3.png" class="image img-3" alt="" />
          </div>

          <div class="text-slider">
            <div class="text-wrap">
              <div class="text-group">
                <h4>Mudah</h4>
                <h4>Aman</h4>
                <h4>Terpercaya</h4>
              </div>
            </div>

            <div class="bullets">
              <span class="active" data-value="1"></span>
              <span data-value="2"></span>
              <span data-value="3"></span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>

  <!-- FOOTER -->
  <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col">
                    <h4>E-Market</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">our service</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Affiliator Binomo</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Help</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">Order Status</a></li>
                        <li><a href="#">Whatsapp</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Online Shop</h4>
                    <ul>
                        <li><a href="#">Watch</a></li>
                        <li><a href="#">Bag</a></li>
                        <li><a href="#">Shoes</a></li>
                        <li><a href="#">Dress</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
            </div>


        </div>
    </footer>

  <!-- Javascript file -->

  <script src="app.js"></script>
</body>

</html>