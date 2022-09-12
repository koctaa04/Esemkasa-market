<?php
    if (isset($_POST['btn'])) {
        $user = $_POST['username'];
        echo $user;
        //header("location:2.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <label for="username">Username</label>
        <input type="text" minlength="3" name="username" id="username">
        <button type="submit" name="btn" >Submit</button>
    </form>
</body>
</html>