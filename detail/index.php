<?php
include "../koneksi.php";

if (isset($_GET['id_produk'])) {
    $id = $_GET['id_produk'];
    
    $qrec = mysqli_query($conn, "SELECT * FROM produk join kategori_produk on produk.kategori = kategori_produk.id WHERE id_produk = '$id'");
    $rec = mysqli_fetch_array($qrec);
    // header("location: data.php");
}

$jmlgambar = mysqli_query($conn,"SELECT count(DISTINCT id_gambar) AS gambar FROM gambar WHERE id_produk=$id");
$dtjmlgambar = mysqli_fetch_array($jmlgambar);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Detail Produk</title>
    <link rel="stylesheet" href="style.css" />
    <!-- <link rel="stylesheet" href="../fontawesome/css/all.min.css" /> -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
      integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
      crossorigin="anonymous"
    />
  </head>
  <body>
    
    <div class="card-wrapper">
      <div class="card">
        <!-- card left -->
        <div class="product-imgs">
          <div class="img-display">
            <div class="img-showcase">
              <img src="../img/produk/<?= $rec['gambar'] ?>" alt="shoe image" />
              <!-- <img src="img/orange.png" alt="shoe image" />
              <img src="img/green.png" alt="shoe image" />
              <img src="img/blue.png" alt="shoe image" /> -->
            </div>
          </div>
          <div class="img-select">
            <!-- <div class="img-item">
              <a href="#" data-id="1">
                <img src="../img/produk/<?= $recGambar['img'] ?>" alt="shoe image" />
              </a>
            </div>
            <div class="img-item">
              <a href="#" data-id="2">
                <img src="img/orange.png" alt="shoe image" />
              </a>
            </div>
            <div class="img-item">
              <a href="#" data-id="3">
                <img src="img/green.png" alt="shoe image" />
              </a>
            </div>
            <div class="img-item">
              <a href="#" data-id="4">
                <img src="img/blue.png" alt="shoe image" />
              </a>
            </div> -->
          </div>
        </div>
        <!-- card right -->
        <div class="product-content">
          <h2 class="product-title"><?= $rec['nama_produk'] ?></h2>
          <a href="../index.php" class="product-link">visit E-Market</a>
          <div class="product-rating">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
            <span>4.7(21)</span>
          </div>

          <div class="product-price">
            <p class="price">Price: <span>Rp <?= $rec['harga'] ?></span></p>
          </div>

          <div class="product-detail">
            <h2>about this item:</h2>
            <p><?= $rec['deskripsi'] ?></p>
            <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, perferendis eius. Dignissimos, labore suscipit. Unde.</p> -->
            <ul>
              <!-- <li>Color: <span>Red,Orange,Green,Blue</span></li> -->
              <li>Type: <span><?= $dtjmlgambar['gambar'] ?> type</span></li>
              <li>Category: <span><?= $rec['kategori'] ?></span></li>
              <li>Weight: <span><?= $rec['berat'] ?> gram</span></li>
              <li>stock: <span><?= $rec['stok'] ?> stock</span></li>
            </ul>
          </div>

          <div class="purchase-info">
            <input type="number" min="0" value="1" />
            <button type="button" class="btn">Buy Now <i class="fas fa-shopping-cart"></i></button>
            <button type="button" class="btn">Add to Wishlist</button>
          </div>

          <div class="social-links">
            <p>Share At:</p>
            <a href="#">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="#">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#">
              <i class="fab fa-whatsapp"></i>
            </a>
            <a href="#">
              <i class="fab fa-pinterest"></i>
            </a>
          </div>
        </div>
      </div>
    </div>

    <script src="script.js"></script>
  </body>
</html>
