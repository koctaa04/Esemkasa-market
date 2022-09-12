<?php
// Koneksi ke database
include "../koneksi.php";
if(isset($_POST['cari'])){
    $cari = $_POST['cari'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search | E-Market</title>

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="style-home.css">

</head>

<body>

    <section id="header">

        <a href="homepage.php"><img src="../img/logo/logo.png" class="logo" alt=""></a>
        <form action="" method="post">
            <div class="searchbar">
                <input type="search" name="cari" placeholder="Search..">
                <!-- <span id="box" class="fa-solid fa-magnifying-glass"></span> -->
            </div>
        </form>

        <div>
            <ul id="navbar">
                <li><a class="active" href="wishlist.php">Cart</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href=""><i class="fa-solid fa-ellipsis-vertical"></i></a></li>
            </ul>
        </div>

        <div id="mobile">
            <i id="bar" class="fas fa-outdent"></i>
        </div>

    </section>

    <!-- <section id="page-header">

        <h2>#COVID2020</h2>
        <p>Save more with coupons & up to 30% off! </p>

    </section> -->


    <!-- PRODUK -->

    <section id="product1" class="section-p1">
        <?php
            if (empty($_POST['cari'])) { ?>
                <h3>'No product searched'</h3>
            <?php } else { ?>
                <h3>Result from "<?=$cari?>"</h3>
            <?php } ?>
        <!-- <p>Brodo Event Shoes Collection</p> -->
        <div class="pro-container">
            <?php
            if(isset($_POST['cari'])){
                $cari = $_POST['cari'];
                $qrec = mysqli_query($conn, "SELECT produk.id_produk, produk.gambar, penjual.name, produk.nama_produk, produk.harga FROM `produk` 
                LEFT JOIN penjual ON produk.id_penjual = penjual.id_penjual WHERE produk.nama_produk LIKE '%$cari%'");

            // $tt = mysqli_query($conn, "SELECT produk.gambar, penjual.name, produk.nama_produk, produk.harga FROM `produk` 
            // LEFT JOIN penjual ON produk.id_penjual = penjual.id_penjual WHERE produk.nama_produk LIKE '%sepatu%'; ");

            while ($recpro = mysqli_fetch_array($qrec)) {?>

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


            <?php if (empty($recpro)) {
                echo "produk yang dicari tidak ada";
            }} }?>

        </div>

    </section>
    
    <!-- End PRODUK -->

    <!-- Produk Lain -->
    <section id="product1" class="section-p1">
        <h2>Another Product</h2>
        <p>Brodo Event Shoes Collection</p>
        <div class="pro-container">
            <?php
            // Koneksi ke database
            include "../koneksi.php";

            $tt = mysqli_query($conn, "SELECT * FROM `produk` 
            LEFT join penjual ON produk.id_penjual = penjual.id_penjual
                order by produk.id_produk DESC limit 8; ");

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
    <!-- End of Produk Lain -->
    <!-- <section id="wishlist" class="section-p1">
        <table id="subtotal" width="100%">
            <thead>
                <tr>
                    <td>Remove</td>
                    <td>Image</td>
                    <td>Product</td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                    <td>Menu</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><a href=""><i class="fa-solid fa-trash trash"></i></a></td>
                    <td><img src="../img/produk/1.jpg" alt=""></td>
                    <td>Brodo Hi Struggle Popomangun Black</td>
                    <td>Rp. 475.000</td>
                    <td><input type="number" value="1"></td>
                    <td>Rp. 475.000</td>
                    <form action="" method="post">
                        <input type="hidden" name="noWa" value="6283122150023">
                        <td><button type="submit" name="submit" class="normal">Checkout</button></td>
                    </form>
                </tr>
                <tr>
                    <td><a href=""><i class="fa-solid fa-trash trash"></i></a></td>
                    <td><img src="../img/produk/2.jpg" alt=""></td>
                    <td>Brodo Signature Black</td>
                    <td>Rp. 399.000</td>
                    <td><input type="number" value="1"></td>
                    <td>Rp. 399.000</td>
                    <form action="" method="post">
                        <input type="hidden" name="noWa" value="6283122150023">
                        <td><button type="submit" name="submit" class="normal">Checkout</button></td>
                    </form>
                </tr>
                <tr>
                    <td><a href=""><i class="fa-solid fa-trash trash"></i></a></td>
                    <td><img src="../img/produk/3.jpg" alt=""></td>
                    <td>Brodo Vulcan Classic Low Black</td>
                    <td>Rp. 279.000</td>
                    <td><input type="number" value="1"></td>
                    <td>Rp. 279.000</td>
                    <form action="" method="post">
                        <input type="hidden" name="noWa" value="6283122150023">
                        <td><button type="submit" name="submit" class="normal">Checkout</button></td>
                    </form>
                </tr>
            </tbody>
        </table>
    </section>

    <section id="wishlist-add" class="section-p1">
        <div id="subtotal">
            <h3>Cart Totals</h3>
            <table>
                <tr>
                    <td>Cart Subtotal</td>
                    <td>Rp. 1.153.000</td>
                </tr>
                <tr>
                    <td>Shipping</td>
                    <td>Free</td>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                    <td><strong>Rp. 1.153.000</strong></td>
                </tr>
            </table>
        </div>
    </section> -->

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