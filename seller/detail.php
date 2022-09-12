<?php
include "../koneksi.php";
session_start();

if (!isset($_SESSION["login"])) {
    header("location: login.php");
    exit;
}

// SWEET ALERT
function pesan($judul, $kata, $status)
{
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


// EDIT SELLER
if (isset($_GET['editP'])) {
    $id = $_GET['editP'];

    $ep = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id'");
    $rep = mysqli_fetch_array($ep);

    // header("location: data.php");
}

// MODAL
if (isset($_GET['detail'])) {
    $id = $_GET['detail'];

    $pp = mysqli_query($conn, "SELECT * FROM produk 
    LEFT JOIN kategori_produk ON produk.kategori = kategori_produk.id
    LEFT JOIN penjual ON produk.id_penjual = penjual.id_penjual
    WHERE id_produk = '$id';
");
    $yy = mysqli_fetch_array($pp);
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
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->

    <title>Admin</title>
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
                    <a href="dashboard.php" class="active"><span class="icon"><i class="fa fa-home" aria-hidden="true"></i></span>
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

                Product
            </h2>

            <div class="user-wrapper">
                <img src="../img/logo/monyet.jpg" width="40px" height="40px" alt="">
                <div>
                    <h4><?=$_SESSION['name']?></h4>
                    <small>Seller</small>
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
                        <h2>Detail Product</h2>
                    </div>
                    <!-- Pilih Produk -->
                    <form action="" method="post">
                    <div class="mb-3">
                            <label class="" for="">Pilih Produk</label>
                            <select name="id" class="form-control" aria-label="Default select example">
                                <option selected>Open this select menu</option>
                    
                                <?php
                                $qkat = mysqli_query($conn, "SELECT * FROM produk where");
                                while ($rkat = mysqli_fetch_array($qkat)) {
                                ?>
                                    <option value="<?= $rkat['id_produk'] ?>" >
                                        <?= $rkat['nama_produk'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <button class="btn btn-primary" name="pilih" type="submit">Pilih Produk</button>
                    </form>
                    <table>
                        <?php
                        if (isset($_POST['pilih'])) {
                            $id = $_POST['id'];
                            //echo $id;
                            $yy = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang = $id");
                            $recBarang = mysqli_fetch_array($yy);
                        }
                        ?>
                        <thead>
                            <tr>
                                <td>Name</td>
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

                            // Session
                            $sesi = $_SESSION['name'];
                            //echo $sesi;
                            $ss = mysqli_query($conn, "SELECT `id_penjual` FROM penjual WHERE `name`= '$sesi' ");
                            $sss = mysqli_fetch_assoc($ss);
                            $ssss = $sss['id_penjual'];
                            //print_r ($ssss);

                            $product = mysqli_query($conn, "SELECT * FROM produk 
                            LEFT JOIN kategori_produk ON produk.kategori = kategori_produk.id
                            LEFT JOIN penjual ON produk.id_penjual = penjual.id_penjual
                            LEFT JOIN gambar ON produk.gambar = gambar.id_gambar
                            where produk.id_penjual = '$ssss'");
                            while ($Tproduct = mysqli_fetch_array($product)) {
                            ?>
                                <tr>

                                    <td><?= $Tproduct['nama_produk'] ?></td>
                                    <td>Rp <?= $Tproduct['harga'] ?></td>
                                    <td><?= $Tproduct['berat'] ?> gram</td>
                                    <td><?= $Tproduct['stok'] ?> pcs</td>
                                    <td><?= $Tproduct['nama_kat'] ?></td>
                                    <td><a href="?delP=<?= $Tproduct['id_produk'] ?>" class="btn" onclick="return confirm('Apakah anda yakin menghapus data tersebut?');"><i class="fa-solid fa-trash"></i></a></td>

                                    <td><a href="?editP=<?= $Tproduct['id_produk'] ?>" class="btn"><i class="fa-solid fa-pen-to-square"></i></a></td>
                                    <td>                                    
                                </tr>
                            <?php $no++;
                            } ?>
                        </tbody>
                    </table>
                </div>
                <div class="recentcustomers">
                    <div class="form-container">
                        <div class="form-btn">
                            <?php if (isset($_GET['editP'])) { ?>
                                <div class="cardheader">
                                    <h2>Edit Product</h2>
                                </div>
                                <form action="" method="post" enctype="multipart/form-data"><br>
                                    <!-- <input type="text" placeholder="Id Seller"> -->

                                    <input type="text" readonly="readonly" name="id" value="<?= $id ?>">
                                    <!-- <select class="" name="seller" required>
                                        <option selected>Seller</option>
                                        <?php
                                        $qkat = mysqli_query($conn, "SELECT * FROM penjual ORDER BY username ASC");
                                        while ($rkat = mysqli_fetch_array($qkat)) {
                                        ?>
                                            <option value="<?= $rkat['id_penjual'] ?>" <?php if ($rep['id_penjual'] == $rkat['id_penjual']) {
                                                                                            echo "selected=selected";
                                                                                        }   ?>>
                                                <?= $rkat['username'] ?>
                                            </option>
                                        <?php } ?>
                                    </select> -->
                                    <input type="hidden" name="seller"  value="<?= $ssss?>">
                                    <input type="text" minlength="3" name="produk" placeholder="Product Name" autofocus autocomplete="off" value="<?= $rep['nama_produk'] ?>">
                                    <input type="number" minlength="3" name="harga" placeholder="Price" autocomplete="off" value="<?= $rep['harga'] ?>">
                                    <input type="number" minlength="3" name="berat" placeholder="Weight (Gram)" autocomplete="off" value="<?= $rep['berat'] ?>">
                                    <input type="text" minlength="1" name="stok" placeholder="Stock" autocomplete="off" value="<?= $rep['stok'] ?>">
                                    <input type="textarea" minlength="3" name="deskripsi" placeholder="Description" autocomplete="off" value="<?= $rep['deskripsi'] ?>">
                                    <select class="" name="kategori" required>
                                        <option selected>Category</option>
                                        <?php
                                        $qkat = mysqli_query($conn, "SELECT * FROM kategori_produk ORDER BY nama_kat ASC");
                                        while ($rkat = mysqli_fetch_array($qkat)) {
                                        ?>
                                            <option value="<?= $rkat['id'] ?>" <?php if ($rep['kategori'] == $rkat['id']) {
                                                                                    echo "selected=selected";
                                                                                }   ?>>
                                                <?= $rkat['nama_kat'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <input name="gambar" type="file" class="form-control" placeholder="File Gambar">

                                    <button type="submit" name="edit" class="btn">
                                        Update
                                    </button>
                                </form>
                                <?php
                                // UPDATE FILE GAMBAR
                                if (isset($_POST['edit'])) {
                                    $p = $_POST['produk'];
                                    $pnj = $_POST['seller'];
                                    $hrg = $_POST['harga'];
                                    $brt = $_POST['berat'];
                                    $stk = $_POST['stok'];
                                    $desc = $_POST['deskripsi'];
                                    $kat = $_POST['kategori'];


                                    $id = $_POST['id'];
                                    $gambar = basename($_FILES['gambar']['name']);

                                    $ekstensi_diperbolehkan    = array('png', 'jpg', 'jpeg');
                                    $nama = $_FILES['gambar']['name'];
                                    $x = explode('.', $nama);
                                    $ekstensi = strtolower(end($x));
                                    $ukuran    = $_FILES['gambar']['size'];
                                    $file_tmp = $_FILES['gambar']['tmp_name'];

                                    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                                        if ($ukuran < 1044070) {

                                            move_uploaded_file($file_tmp, '../img/produk/' . $nama);
                                            $query = mysqli_query(
                                                $conn,
                                                "UPDATE `produk` SET `nama_produk`='$p', `id_penjual`='$pnj', 
                                            `harga`='$hrg',`berat`='$brt',`stok`='$stk',`deskripsi`='$desc',`gambar` = '$gambar', `kategori` = '$kat' 
                                            WHERE id_produk = '$id'"
                                            );
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
                                }
                                ?>
                            <?php } else { ?>
                                <div class="cardheader">
                                    <h2>Add Product</h2>
                                </div>
                                <form action="" method="post" enctype="multipart/form-data"><br>
                                    <!-- <input type="text" placeholder="Id PRODUCT"> -->
                                    <!-- <select class="" name="seller" required>
                                        <option selected>Seller</option>
                                        <?php
                                        $qkat = mysqli_query($conn, "SELECT * FROM penjual ORDER BY username ASC");
                                        while ($rkat = mysqli_fetch_array($qkat)) {
                                        ?>
                                            <option value="<?= $rkat['id_penjual'] ?>">
                                                <?= $rkat['username'] ?>
                                            </option>
                                        <?php } ?>
                                    </select> -->
                                    <input type="hidden" name="seller"  value="<?= $ssss?>">
                                    <input type="text" minlength="3" required name="produk" autocomplete="off" placeholder="Product Name">
                                    <input type="number" minlength="3" required name="harga" autocomplete="off" placeholder="Price">
                                    <input type="number" minlength="3" required name="berat" autocomplete="off" placeholder="Weight (Gram)">
                                    <input type="text" minlength="1" required name="stok" autocomplete="off" placeholder="Stock">
                                    <input type="textarea" minlength="3" required name="deskripsi" autocomplete="off" placeholder="Description">
                                    <input type="hidden" name="id" value="<?= $id ?>">
                                    <select class="" name="kategori" required>
                                        <option selected>Category</option>
                                        <?php
                                        $qkat = mysqli_query($conn, "SELECT * FROM kategori_produk ORDER BY nama_kat ASC");
                                        while ($rkat = mysqli_fetch_array($qkat)) {
                                        ?>
                                            <option value="<?= $rkat['id'] ?>">
                                                <?= $rkat['nama_kat'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <input name="gambar" type="file" class="form-control" placeholder="File Gambar">
                                    <button type="submit" name="add" class="btn">Add</button>
                                </form>
                                <?php
                                // ADD FILE GAMBAR
                                if (isset($_POST['add'])) {
                                    $p = $_POST['produk'];
                                    $pnj = $_POST['seller'];
                                    $hrg = $_POST['harga'];
                                    $brt = $_POST['berat'];
                                    $stk = $_POST['stok'];
                                    $desc = $_POST['deskripsi'];
                                    $kat = $_POST['kategori'];


                                    $id = $_POST['id'];
                                    $gambar = basename($_FILES['gambar']['name']);

                                    $ekstensi_diperbolehkan    = array('png', 'jpg', 'jpeg');
                                    $nama = $_FILES['gambar']['name'];
                                    $x = explode('.', $nama);
                                    $ekstensi = strtolower(end($x));
                                    $ukuran    = $_FILES['gambar']['size'];
                                    $file_tmp = $_FILES['gambar']['tmp_name'];

                                    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                                        if ($ukuran < 1044070) {

                                            move_uploaded_file($file_tmp, '../img/produk/' . $nama);
                                            $query = mysqli_query($conn, "INSERT INTO `produk`(`id_produk`, `id_penjual`, `nama_produk`, `harga`, `berat`, `stok`, `deskripsi`, `gambar`, `kategori`) 
                                            VALUES ('','$pnj', '$p','$hrg','$brt','$stk','$desc', '$gambar', '$kat')");

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
                                }
                                ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
        </main>
    </section>


    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/solid.js" integrity="sha384-/BxOvRagtVDn9dJ+JGCtcofNXgQO/CCCVKdMfL115s3gOgQxWaX/tSq5V8dRgsbc" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/fontawesome.js" integrity="sha384-dPBGbj4Uoy1OOpM4+aRGfAOc0W37JkROT+3uynUgTHZCHZNMHfGXsmmvYTffZjYO" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>