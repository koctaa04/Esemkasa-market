<?php
include "../koneksi.php";
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}



?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-
    scale=1">

    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"> -->

    <!-- fontawesome new -->
    <link rel="stylesheet" type="text/css" href="../fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="../fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous" />

    <!-- lineawesome new -->
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="style-admin.css">

    <title>E-Market • Seller</title>
</head>

<body>

    <input type="checkbox" id="nav-toggle">
    <section class="sidebar">
        <div class="sidebar-brand">
            <h2><span><i class="fa-brands fa-accusoft"></i></span>
                <span>E - Market</span>
            </h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="" class="active"><span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
                        <span class="text">Dashboard</span></a>
                </li>
                <!-- <li>
                <a href="seller.php"><span class="icon"><i class="fa fa-users" aria-hidden="true"></i></span>
                <span class="text">Seller</span></a>
            </li> -->
                <li>
                    <a href="product.php"><span class="icon"><i class="fa-solid fa-box" aria-hidden="true"></i></span>
                        <span class="text">Product</span></a>
                </li>
                <li>
                    <a href="detail.php"><span class="icon"><i class="fa-solid fa-box" aria-hidden="true"></i></span>
                        <span class="text">Detail Product</span></a>
                </li>
                <li>
                    <a href=""><span class="icon"><i class="fa fa-cog" aria-hidden="true"></i></span>
                        <span class="text">Setting</span></a>
                </li>
                <!-- <li>
                    <a href=""><span class="icon"><i class="fa fa-address-card" aria-hidden="true"></i></span>
                        <span class="text">Accounts</span></a>
                </li> -->
                <li>
                    <a href="logout.php"><span class="icon"><i class="fa-solid fa-arrow-right-from-bracket" aria-hidden="true"></i></span>
                        <span class="text">Sign Out</span></a>
                </li>
            </ul>
        </div>
    </section>

    <section class="main-content">
        <header>
            <h2>
                <label for="nav-toggle">
                    <span class="fas fa-bars"></span>
                </label>

                Dashboard
            </h2>

            <div class="search-wrapper">
                <span class="las la-search" aria-hidden="true"></span>
                <input type="search" placeholder="Search...">
            </div>

            <div class="user-wrapper">
                <?php 
                $sesi = $_SESSION['name'];
                $profil = mysqli_fetch_array(mysqli_query($conn, "SELECT `profil` FROM `penjual` WHERE `name` = '$sesi';"));
                ?>

                <?php
                if (empty($profil['profil'])) { ?>
                    <img src="../img/logo/monyet.jpg" width="40px" height="40px" alt="">
                <?php } else { ?>
                    <img src="../img/logo/<?=$profil['profil']?>" width="40px" height="40px" alt="">
                <?php } ?>
                
                
                <div>
                    <h4><?=$_SESSION['name']?></h4>
                    <small>Seller</small>
                </div>
            </div>
        </header>

        <main>
            <div class="cards">
                <?php

                // DATA 
                $jmlseller = mysqli_query($conn, "SELECT count(id_penjual) AS jumlahSeller FROM penjual");
                $dtjmlseller = mysqli_fetch_array($jmlseller);

                $jmlproduk = mysqli_query($conn, "SELECT count(id_produk) AS jumlahProduk FROM produk");
                $dtjmlproduk = mysqli_fetch_array($jmlproduk);

                ?>
                <div class="card-single">
                    <div>
                        <h1>73</h1>
                        <span>Daily Views</span>
                    </div>
                    <div>
                        <span><i class="fa fa-eye"></i></span>
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1><?= $dtjmlproduk['jumlahProduk'] ?></h1>
                        <span>Inventory</span>
                    </div>
                    <div>
                        <span><i class="fa fa-suitcase"></i></span>
                    </div>
                </div>
            </div>

            <div class="details-dash">
                <div class="recentorders">
                    <div class="cardheader">
                        <h2>Recent Product</h2>
                        <a href="product.php" class="btn">View All</a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <td>Id</td>
                                <td>Name</td>
                                <td>Price</td>
                                <td>Weight</td>
                                <td>Stock</td>
                                <td>Kategori</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sesi = $_SESSION['name'];
                            //echo $sesi;
                            $ss = mysqli_query($conn, "SELECT `id_penjual` FROM penjual WHERE `name`= '$sesi' ");
                            $sss = mysqli_fetch_assoc($ss);
                            $ssss = $sss['id_penjual'];
                            //print_r ($ssss);

                            $produk = mysqli_query($conn, "SELECT * FROM produk 
                            LEFT JOIN kategori_produk ON produk.kategori = kategori_produk.id
                            LEFT JOIN penjual ON produk.id_penjual = penjual.id_penjual
                            LEFT JOIN gambar ON produk.gambar = gambar.id_gambar
                            where produk.id_penjual = '$ssss' limit 8");
                            while ($Tproduk = mysqli_fetch_array($produk)) {


                            ?>
                                <tr>
                                    <td><?= $Tproduk['id_produk'] ?></td>
                                    <td><?= $Tproduk['nama_produk'] ?></td>
                                    <td>Rp <?= $Tproduk['harga'] ?></td>
                                    <td><?= $Tproduk['berat'] ?> gram</td>
                                    <td><?= $Tproduk['stok'] ?> pcs</td>
                                    <td><?= $Tproduk['nama_kat'] ?></td>

                                </tr>
                            <?php $no++;
                            } ?>
                        </tbody>
                    </table>
                </div>
                <!-- <div class="recentcustomers">
                    <div class="cardheader">
                        <h2>Recent Seller</h2>
                    </div>
                    <table>
                        <tbody>
                            <?php
                            $no = 1;
                            $seller = mysqli_query($conn, "SELECT * FROM `penjual`");
                            while ($Tseller = mysqli_fetch_array($seller)) {

                            ?>
                            <tr>
                                <td width="60px">
                                    <div class="imgbox"><img src="../img/logo/spongebob.png" alt=""></div>
                                </td>
                                <td>
                                    <h4><?= $Tseller['name'] ?></h4><span><?= $Tseller['telepon'] ?></span>
                                </td>
                            </tr>
                            
                            <?php $no++;
                            } ?>
                        </tbody>
                    </table>
                </div> -->
            </div>
        </main>
    </section>

    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/solid.js" integrity="sha384-/BxOvRagtVDn9dJ+JGCtcofNXgQO/CCCVKdMfL115s3gOgQxWaX/tSq5V8dRgsbc" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/fontawesome.js" integrity="sha384-dPBGbj4Uoy1OOpM4+aRGfAOc0W37JkROT+3uynUgTHZCHZNMHfGXsmmvYTffZjYO" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>