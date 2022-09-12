<?php
function pesan(){
    
     $t =  "<script>
     Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      })
   </script>";
   return $t;
}
echo pesan();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <a href="?coba=1" onclick="<?php
    
    echo "<script>
    Swal.fire({
       title: 'Are you sure?',
       text: 'You will not be able to revert this!',
       icon: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Yes, delete it!'
     }).then((result) => {
       if (result.isConfirmed) {
         Swal.fire(
           'Deleted!',
           'Your file has been deleted.',
           'success'
         )
       }
     })
  </script>";
   ?>">TES</a>
    
</body>
</html>