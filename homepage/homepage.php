<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage | E-Market</title>

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="style-home.css">

</head>

<body>

    <section id="header">
        <a href="homepage.php"><img src="../img/logo/logo.png" class="logo" alt=""></a>
        <form action="cari.php" method="post">
            <div class="searchbar">
                <input type="search" name="cari" placeholder="Search..">
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

    <section id="hero">

        <h4>Trade-in-offer</h4>
        <h2>Super value deals</h2>
        <h1>On all products</h1>
        <p>Save more with coupons & up to 70% off! </p>
        <button onclick="window.location.href='shop.php';">Shop Now</button>

    </section>

    <section id="feature" class="section-p1">

        <div class="fe-box">
            <img src="../img/homepage-acc1.svg" alt="">
            <h6>Mudah</h6>
        </div>
        <div class="fe-box">
            <img src="../img/homepage-acc2.svg" alt="">
            <h6>Aman</h6>
        </div>
        <div class="fe-box">
            <img src="../img/homepage-acc4.svg" alt="">
            <h6>Nyaman</h6>
        </div>
        <div class="fe-box">
            <img src="../img/homepage-acc3.svg" alt="">
            <h6>Terpercaya</h6>
        </div>

    </section>

    <section id="sm-banner" class="section-p1">

        <div class="banner-box">
            <h4>Crazy Deals</h4>
            <h2>Buy 1 Get 1</h2>
            <span>The best brodo shoes</span>
            <button class="white">Learn more</button>
        </div>
        <div class="banner-box banner-box2">
            <h4>Winter or Summer</h4>
            <h2>Upcomming Season</h2>
            <span>The best shirt in summer or winter</span>
            <button class="white">Collection</button>
        </div>

    </section>

    <section id="banner3">

        <div class="banner-box">
            <h2>Seasonal Sale</h2>
            <h3>Winter Collection -50% Off</h3>
        </div>
        <div class="banner-box banner-box2">
            <h2>Seasonal Sale</h2>
            <h3>Winter Collection -50% Off</h3>
        </div>
        <div class="banner-box banner-box3">
            <h2>Seasonal Sale</h2>
            <h3>Winter Collection -50% Off</h3>
        </div>

    </section>

    <section id="product1" class="section-p1">

        <h2>New Release</h2>
        <p>Brodo Event Shoes Collection</p>
        <div class="pro-container">
            <?php
            // Koneksi ke database
            include "../koneksi.php";

            $tt = mysqli_query($conn, "SELECT * FROM `produk` 
            LEFT join penjual ON produk.id_penjual = penjual.id_penjual
                order by produk.id_produk DESC limit 4; ");

            while ($recpro = mysqli_fetch_array($tt)) {
            ?>

                <div class="pro" onclick="window.location.href='detail.php?id_produk=<?= $recpro['id_produk'] ?>';">
                    <img src="../img/produk/<?= $recpro['gambar'] ?>" alt="">
                    <div class="des">
                        <span><?= $recpro['name'] ?></span>
                        <h5><?= $recpro['nama_produk'] ?></h5><br>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h4>Rp. <?= $recpro['harga'] ?></h4>
                    </div>
                </div>


            <?php } ?>

        </div>

    </section>

    <section id="banner" class="section-m1">

        <h4>Repair Services</h4>
        <h2>Up to <span> 30% Off </span> - All Brodo Shoes</h2>
        <button class="normal">Explore More</button>

    </section>

    <section id="product1" class="section-p1">

        <h2>Another Products</h2>
        <p>Esemkasa Market Collection</p>
        <div class="pro-container">
            <?php

            $tt = mysqli_query($conn, "SELECT * FROM `produk` 
            LEFT join penjual ON produk.id_penjual = penjual.id_penjual
            LEFT JOIN gambar ON produk.id_produk = gambar.id_pro GROUP by gambar.id_pro
                order by produk.id_produk ASC limit 8; ");

            while ($recpro = mysqli_fetch_array($tt)) {
            ?>

                <div class="pro" onclick="window.location.href='detail.php?id_produk=<?= $recpro['id_produk'] ?>';">
                    <img src="../img/produk/<?= $recpro['img'] ?>" alt="">
                    <div class="des">
                        <span><?= $recpro['name'] ?></span>
                        <h5><?= $recpro['nama_produk'] ?></h5><br>
                        <div class="star">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <h4>Rp. <?= $recpro['harga'] ?></h4>
                    </div>
                </div>


            <?php } ?>

        </div>

    </section>

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

    <script src="scripts.js"></script>
</body>

</html>