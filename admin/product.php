<?php
include "../koneksi.php";
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

// SWEET ALERT
function pesan($judul, $kata, $status){
    $pesan = "<script> Swal.fire('$judul','$kata','$status').then((result) => {
                window.location.href='product.php';
    });
             </script>";
    return $pesan;
}


// DELETE SELLER
if (isset($_GET['delP'])) {
    $id = $_GET['delP'];
    mysqli_query($conn, "DELETE FROM `produk` WHERE id_produk = '$id'");

    echo "<script>
            alert('Data berhasil dihapus');
            document.location.href = 'product.php'
          </script>";
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

    <!-- sweet alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Style -->
    <link rel="stylesheet" href="style-admin.css">

    <title>Admin | E-Market</title>
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
                    <a href="dashboard.php"><span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
                        <span class="text">Dashboard</span></a>
                </li>
                <li>
                    <a href="seller.php"><span class="icon"><i class="fa fa-users" aria-hidden="true"></i></span>
                        <span class="text">Seller</span></a>
                </li>
                <li>
                    <a href="product.php" class="active"><span class="icon"><i class="fa-solid fa-box" aria-hidden="true"></i></span>
                        <span class="text">Product</span></a>
                </li>
                <!-- <li>
                <a href=""><span class="icon"><i class="fa fa-comments" aria-hidden="true"></i></span>
                <span class="text">Messages</span></a>
            </li> -->
                <!-- <li>
                    <a href=""><span class="icon"><i class="fa fa-question-circle" aria-hidden="true"></i></span>
                        <span class="text">Help</span></a>
                </li>
                <li>
                    <a href=""><span class="icon"><i class="fa fa-cog" aria-hidden="true"></i></span>
                        <span class="text">Setting</span></a>
                </li> -->
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

                Product
            </h2>

            <div class="user-wrapper">
                <img src="../img/logo/monyet.jpg" width="40px" height="40px" alt="">
                <div>
                    <h4><?=$_SESSION['username']?></h4>
                    <small>Admin</small>
                </div>
            </div>
        </header>
        <main>

            <div class="container">
                <div class="search_wrap">
                    <div class="search_box">
                        <div class="button button_common">
                            <i class="las la-search"></i>
                        </div>
                        <input type="text" class="input" placeholder="Search...">
                    </div>
                </div>
            </div>

            <div class="details">
                <div class="recentorders">
                    <div class="cardheader">
                        <h2>Product</h2>

                    </div>

                    <table>
                        <thead>
                            <tr>
                                <td>Name</td>
                                <td>Seller</td>
                                <td>Price</td>
                                <td>Weight</td>
                                <td>Stock</td>
                                <td>Category</td>
                                <td colspan="2">Menu</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $product = mysqli_query($conn, "SELECT * FROM produk 
                            LEFT JOIN kategori_produk ON produk.kategori = kategori_produk.id
                            LEFT JOIN penjual ON produk.id_penjual = penjual.id_penjual
                            LEFT JOIN gambar ON produk.gambar = gambar.id_gambar");
                            while ($Tproduct = mysqli_fetch_array($product)) {
                            ?>
                                <tr>
                                    
                                    <td><?= $Tproduct['nama_produk'] ?></td>
                                    <td><?= $Tproduct['name'] ?></td>
                                    <td>Rp <?= $Tproduct['harga'] ?></td>
                                    <td><?= $Tproduct['berat'] ?> gram</td>
                                    <td><?= $Tproduct['stok'] ?> pcs</td>
                                    <td><?= $Tproduct['nama_kat'] ?></td>
                                    <td><a href="" class="btn">Detail</a></td>
                                    <td><a href="?delP=<?= $Tproduct['id_produk'] ?>" class="btn" onclick="return confirm('Apakah anda yakin menghapus data tersebut?');"><i class="fa-solid fa-trash"></i></a></td>
                                </tr>
                            <?php $no++;
                            } ?>
                        </tbody>
                    </table>
                </div>
                
        </main>
    </section>

    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/solid.js" integrity="sha384-/BxOvRagtVDn9dJ+JGCtcofNXgQO/CCCVKdMfL115s3gOgQxWaX/tSq5V8dRgsbc" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/fontawesome.js" integrity="sha384-dPBGbj4Uoy1OOpM4+aRGfAOc0W37JkROT+3uynUgTHZCHZNMHfGXsmmvYTffZjYO" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <script src="script.js"></script>
</body>

</html>