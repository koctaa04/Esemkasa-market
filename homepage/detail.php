<?php
// Koneksi ke database
include "../koneksi.php";

if (isset($_GET['id_produk'])) {
    $id = $_GET['id_produk'];

    $qrec = mysqli_query($conn, "SELECT * FROM produk 
            join kategori_produk on produk.kategori = kategori_produk.id 
            left join gambar on produk.gambar = gambar.id_gambar WHERE id_produk = '$id'");
    $rec = mysqli_fetch_array($qrec);
    
    // header("location: data.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Product | E-Market</title>

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="style-home.css">
    <link rel="stylesheet" href="../detail/style.css" />

</head>

<body>

<section id="header">
        
        <a href="homepage.php"><img src="../img/logo/logo.png" class="logo" alt=""></a>
        <form action="">
        <div class="searchbar">
            <input type="text" name="box" placeholder="Search..">
            <!-- <span id="box" class="fa-solid fa-magnifying-glass"></span> -->
        </div>
        </form>

        <div>
            <ul id="navbar">
                <li><a href="wishlist.php">Cart</a></li>
                <li><a href="contact.php">Contact</a></li>
                <i id="close" class="fa-solid fa-xmark"></i>
            </ul>
        </div>

        <div id="mobile">
            <i id="bar" class="fas fa-outdent"></i>
        </div>

    </section>
    
    <section id="prodetails" class="section-p1">
        <div class="single-pro-image">
            <img src="../img/produk/<?= $rec['gambar'] ?>" width="100%" id="main-img" alt="">

            <!-- <div class="small-img-group">
                <div class="small-img-col">
                    <img src="../img/produk/1.jpg" width="100%" class="small-img" alt="">
                    </div>
                <div class="small-img-col">
                    <img src="../img/produk/2.jpg" width="100%" class="small-img" alt="">
                    </div>
                <div class="small-img-col">
                    <img src="../img/produk/3.jpg" width="100%" class="small-img" alt="">
                    </div>
                <div class="small-img-col">
                    <img src="../img/produk/4.jpg" width="100%" class="small-img" alt="">
                </div>
            </div> -->
        </div>

        <!-- card right -->
    <div class="product-content">
          <h2 class="product-title"><?= $rec['nama_produk'] ?></h2>
          <a href="homepage.php" class="product-link">Back to homepage</a>
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
            <h3>About this item:</h3>
            <p><?= $rec['deskripsi'] ?></p>
            <!-- <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Consequatur, perferendis eius. Dignissimos, labore suscipit. Unde.</p> -->
            <ul>
              <li>Type: <span>00 type</span></li>
              <li>Weight: <span><?= $rec['berat'] ?> gram</span></li>
              <!-- <li>Available: <span>sold stock</span></li> -->
              <li>Category: <span><?= $rec['nama_kat'] ?></span></li>
              <!-- <li>Shipping Area: <span>All over the Galaxy</span></li> -->
              <!-- <li>Shipping Fee: <span>Free</span></li> -->
            </ul>
          </div>

          <div class="purchase-info">
            <input type="number" min="0" value="1" />
            <button type="button" class="btn">Buy Now <i class="fas fa-shopping-cart"></i></button>
            <button type="button" class="btn">Add to cart</button>
          </div>
          <div class="social-links">
            <p>Share At : </p>
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
    </section>

    <section id="product1" class="section-p1">

        <h2>New Arrival</h2>
        <p>Summer And Winter</p>
        <div class="pro-container">
            
        <?php
        

            $tt = mysqli_query($conn, "SELECT * FROM `produk` 
            LEFT join penjual ON produk.id_penjual = penjual.id_penjual
            LEFT JOIN gambar ON produk.id_produk = gambar.id_pro limit 8;  ");

            while ($recpro=mysqli_fetch_array($tt) ) {
        ?>
            
            <div class="pro" onclick="window.location.href='detail.php?id_produk=<?=$recpro['id_produk']?>';" >
            <img src="../img/produk/<?= $recpro['img'] ?>" alt="">
            <div class="des">
                <span><?= $recpro ['name']?></span>
                <h5><?= $recpro ['nama_produk']?></h5><br>
                <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                </div>
                <h4>Rp. <?= $recpro ['harga']?></h4>
            </div>
            <a href="#"><i class="fa-regular fa-heart heart"></i></a>
            </div>


        <?php } ?>

        </div>
        </div>
        

    </section>

    

    <script src="scripts.js"></script>
</body>
</html>