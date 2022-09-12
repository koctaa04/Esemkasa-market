<?php
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['komen'];
    $no_wa = $_POST['noWa'];
    header("location:https://api.whatsapp.com/send?phone=$no_wa&text=Nama:%20$name%20%0DEmail:%20$email%20%0DPesan:%20$message");
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact | E-Market</title>

    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="style-home.css">

</head>

<body>

    <section id="header">

        <a href="homepage.php"><img src="../img/logo/logo.png" class="logo" alt=""></a>
        <div id="navbar" class="searchbar">
            <input type="text" name="box" placeholder="Search..">
        </div>

        <div>
            <ul id="navbar">
                <li><a href="wishlist.php">Wishlist</a></li>
                <li><a class="active" href="contact.php">Contact</a></li>
            </ul>
        </div>

        <div id="mobile">
            <i id="bar" class="fas fa-outdent"></i>
        </div>

    </section>

    <section id="page-header">

        <h2>#COVID2020</h2>
        <p>Save more with coupons & up to 30% off! </p>

    </section>

    <section id="contact-details" class="section-p1">

        <div class="details">
            <span>GET IN TOUCH</span>
            <h2>Visit one of our agency locations or contact us today</h2>
            <h3>Head Office</h3>
            <div>

                <li>
                    <i class="fa-regular fa-map"></i>
                    <p>Alamat Office e kene:v</p>
                </li>
                <li>
                    <i class="fa-regular fa-envelope"></i>
                    <p>Contact@example.com</p>
                </li>
                <li>
                    <i class="fa-solid fa-phone"></i>
                    <p>Contact@example.com</p>
                </li>
                <li>
                    <i class="fa-regular fa-clock"></i>
                    <p>Sopo wes seng tangi isuk:p</p>
                </li>

            </div>
        </div>
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3948.9047092793357!2d114.34868731415935!3d-8.212337684673377!
        2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd14ff70f397b65%3A0xd4855a1d5d5b2480!2sSMK%20Negeri%201%20Banyuwangi!5e0!3m2!1sen!2sid!4v1650359886424!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

    </section>

    <section id="form-details">

        <form action="" method="post">
            <span>Leave a message</span>
            <h2>We Love To Hear Message From You</h2>
            <input type="text" name="name" placeholder="Your name">
            <input type="text" name="email" placeholder="Email">
            <input type="hidden" name="noWa" value="6283122150023">
            <textarea name="komen" id="" cols="30" rows="10" placeholder="Your message">
            </textarea>
            <button type="submit" name="submit" class="normal">Send</button>
        </form>

    </section>


    <script src="scripts.js"></script>
</body>

</html>