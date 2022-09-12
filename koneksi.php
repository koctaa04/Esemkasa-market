<?php
$server="localhost";
$dbusername="root";
$dbpassword="";

$dbname="em";

$conn = mysqli_connect($server,$dbusername,$dbpassword,$dbname);
if (!($conn)) 'koneksi gagal dilakukan';

?>