<?php

include 'povezivanje.php';
session_start();



if(isset($_POST['submit'])){
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, md5($_POST['password'])); 

   
   $select_users = mysqli_query($conn, "SELECT * FROM `korisnici` WHERE email_korisnika = '$email' AND zaporka_korisnika = '$password'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
       $row = mysqli_fetch_assoc($select_users);
       
       $_SESSION['korisnik'] = $row['email_korisnika']; 
       $_SESSION['user_id'] = $row['id'];
       header("location: pocetna.php");
       }
   else{
       
       $message[] = "Netočan e-mail ili lozinka!";
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="styleapp.css">
</head>
<body>

<?php

if(isset($message)){
   foreach($message as $msg){
      echo '
      <div class="message">
         <span>'.$msg.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>';
   }
}
?>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Prijavite se</h3>
      <input type="email" name="email" placeholder="Unesite e-mail adresu" required class="box">
      <input type="password" name="password" placeholder="Unesite zaporku" required class="box">
      <input type="submit" name="submit" value="Prijavite se" class="btn">
      <p>Ne posjedujete račun? <a href="REGISTRACIJA.php">Registrirajte se</a></p>
   </form>

</div>

</body>
</html>
