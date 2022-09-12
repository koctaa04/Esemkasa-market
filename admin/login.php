<?php

// Koneksi ke database
include "../koneksi.php";

// SWEET ALERT
function pesan ($judul, $kata,$status){
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

  $result = mysqli_query($conn, "SELECT * FROM `admin` WHERE username = '$username'");
  // Cek Username
  if (mysqli_num_rows($result)  === 1) {
    // Cek Password
    $data = mysqli_fetch_assoc($result);
    if (password_verify($password, $data["password"])) {

      // Set SESSION
      $_SESSION["login"] = false;
      $_SESSION["username"] = $data["username"];
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
  <title>Sign in Admin | E-Market</title>


  <!-- Bootstrap -->
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous" /> -->

  <!-- Fontawesome -->
  <!-- fontawesome new -->
  <link rel="stylesheet" type="text/css" href="../fontawesome-free/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="../fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  <!-- sweet alert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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


  <main>
    <div class="box">
      <div class="inner-box">
        <div class="forms-wrap">

          <!-- LOGIN -->
          <form action="" method="post" autocomplete="off"  class="sign-in-form">
            <div class="logo">
              <!-- <img src="./img/logo.png" alt="easyclass" /> -->
            </div>

            <div class="heading">
              <h2>E-Market</h2>
              <h3>Sign In Admin</h3>
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