<?php

include 'povezivanje.php';

if(isset($_POST['submit'])){

   $ime = mysqli_real_escape_string($conn, $_POST['ime']);
   $prezime = mysqli_real_escape_string($conn, $_POST['prezime']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpassword = mysqli_real_escape_string($conn, md5($_POST['cpassword']));

   $select_korisnici = mysqli_query($conn, "SELECT * FROM `korisnici` WHERE email_korisnika = '$email'") or die('query failed');

   if(mysqli_num_rows($select_korisnici) > 0){
      $message[] = 'Korisnik već postoji!';
   } else {
      if($password != $cpassword){
         $message[] = 'Potvrđena lozinka se ne podudara!';
      } else {
         mysqli_query($conn, "INSERT INTO `korisnici`(ime_korisnika, prezime_korisnika, email_korisnika, zaporka_korisnika, potvrda_zaporke) VALUES('$ime', '$prezime', '$email', '$password', '$cpassword')") or die('query failed');
         $_SESSION['success_message'] = 'Registracija uspješna!';  
         header('location:login.php');
         exit();
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Registracija</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
   <link rel="stylesheet" href="styleapp.css">
</head>
<body>

<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>';
   }
}
?>

<div class="form-container">
    <form method="post" action="">
        <h3>Registrirajte se</h3> 
        <input type="text" name="ime" placeholder="Unesite svoje ime" required class="box">
        <input type="text" name="prezime" placeholder="Unesite svoje prezime" required class="box">
        <input type="email" name="email" placeholder="Unesite e-mail adresu" required class="box">
        <input type="password" name="password" placeholder="Unesite zaporku" required class="box">
        <input type="password" name="cpassword" placeholder="Potvrdite zaporku" required class="box">
        <input type="submit" name="submit" value="POTVRDITE" class="btn">
        <p>Već posjedujete račun? <a href="login.php">Prijavite se</a></p>
    </form>
</div>

</body>
</html>
