<?php

include 'zaglavlje.php';

$user_id = $_SESSION['user_id'];

if(isset($_POST['send'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $number = $_POST['number'];
   $msg = mysqli_real_escape_string($conn, $_POST['message']);

   $select_message = mysqli_query($conn, "SELECT * FROM `poruka` WHERE ime = '$name' AND email = '$email' AND broj = '$number' AND poruka = '$msg'") or die('query failed');

   if(mysqli_num_rows($select_message) > 0){
      $message[] = 'Poruka je već poslana!';
   }else{
      mysqli_query($conn, "INSERT INTO `poruka`(user_id, ime, email, broj, poruka) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
      $message[] = 'Poruka uspješno poslana!';
   }

   foreach($message as $msg){
    echo '<div class="message">
            <span>'.$msg.'</span>
            <i class="fa fa-times" onclick="this.parentElement.style.display=\'none\';"></i>
          </div>';
}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Kontakt</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="styleapp.css">
</head>
<body>
   
<div class="zaglavlje-onama">
   <h3>Kontaktirajte nas</h3>
   <p> <a href="pocetna.php">Početna</a> / Kontakt </p>
</div>

<section class="kontakt">


   <form action="" method="post">
      <h3>Napišite nešto!</h3>
      <input type="text" name="name" required placeholder="Unesite ime" class="box">
      <input type="email" name="email" required placeholder="Unesite email" class="box">
      <input type="number" name="number" required placeholder="Unesite broj" class="box">
      <textarea name="message" class="box" placeholder="Unesite poruku" id="" cols="30" rows="10"></textarea>
      <input type="submit" value="Pošaljite" name="send" class="btn">
   </form>

</section>

<?php include 'podnozje.php'; ?>