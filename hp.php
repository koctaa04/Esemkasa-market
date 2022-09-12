<?php
  if (isset($_POST['submit'])) {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $message = $_POST['message'];
      $no_wa = $_POST['noWa'];
      header("location:https://api.whatsapp.com/send?phone=$no_wa&text=Nama:%20$name %20%0DEmail:%20$email%20%0DPesan:%20$message");
                                                                         
  } else {
      // echo "
      // <script>
      //      window.location=history.go(-1);      
      // </script>
      // ";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Send Wa</title>
  <link >
</head>
<body>
<section>
          <div class="container">
               <br><br>
               <h3>Form Send whatsApp</h3>
               <br><br>

               <div class="row">
                 <div class="col-6">
                 <form action="" method="post" target="_blank">
                    <div class="form-group">
                      <label for="name">nama</label>
                      <input type="text" class="form-control" name="name" placeholder="nama">
                    </div>

                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" name="email" placeholder="name@example.com">
                    </div>
                    
                    <div class="form-group">
                      <label for="message">Message</label>
                      <textarea class="form-control" name="message"  rows="3"></textarea>
                    </div>
                     <input type="hidden" name="noWa" value="6289682087745">
                    <button type="submit" name="submit" class="btn btn-primary">Send</button>
                  </form>
                  </div>
                     </div>
                         </div>
                             </section>          
                
</body>
</html>