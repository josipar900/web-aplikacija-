<?php

include 'zaglavlje.php';

$user_id = $_SESSION['user_id'];

if(isset($_POST['order_btn'])){

   $name = mysqli_real_escape_string($conn, $_POST['ime']);
   $number = $_POST['broj'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $method = mysqli_real_escape_string($conn, $_POST['metoda']);
   $address = mysqli_real_escape_string($conn, $_POST['adresa'] . ', ' . $_POST['grad'] . ', ' . $_POST['drzava']);
   $placed_on = date('d-M-Y');
 
   $cart_total = 0;
   $cart_products[] = '';

   $cart_query = mysqli_query($conn, "SELECT * FROM `kosara` WHERE user_id = '$user_id'") or die('query failed'); // Dohvacanje kosara
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['ime_proizvoda'].' ('.$cart_item['kolicina'].') ';
         $sub_total = ($cart_item['cijena'] * $cart_item['kolicina']);
         $cart_total = $cart_total + $sub_total;
      }
   }

   $total_products = implode(', ',$cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `narudzbe` WHERE ime = '$name' AND broj = '$number' AND email = '$email' AND metoda_placanja = '$method' AND adresa = '$address' AND ukupni_proizvodi = '$total_products' AND ukupna_cijena = '$cart_total'") or die('query failed'); // Provjera postojanja

   if($cart_total == 0){
      $message[] = 'Vaša košara je prazna!';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'Narudžba već izvršena!'; 
      }
      else
      {
         mysqli_query($conn, "INSERT INTO `narudzbe`(user_id, ime, broj, email, metoda_placanja, adresa, ukupni_proizvodi, ukupna_cijena, postavljeno_na) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         $message[] = 'Narudžba uspješno izvršena!';
         mysqli_query($conn, "DELETE FROM `kosara` WHERE user_id = '$user_id'") or die('query failed');
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
   <title>Naplata</title>
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

<div class="zaglavlje-onama">
   <h3>Naplata</h3>
   <p> <a href="pocetna.php">Početna</a> / Naplata </p>
</div>

<section class="prikaz-narudzbe">
<?php  
      $grand_total = 0;
      $select_cart = mysqli_query($conn, "SELECT * FROM `kosara` WHERE user_id = '$user_id'") or die('query failed'); // Dohvacanje baza
      if(mysqli_num_rows($select_cart) > 0){
         while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = ($fetch_cart['cijena'] * $fetch_cart['kolicina']);
            $grand_total = $grand_total + $total_price;

   ?>
   <p> <?php echo $fetch_cart['ime_proizvoda']; ?> <span>(<?php echo 'BAM'. ' ' .$fetch_cart['cijena'].''.' x '. $fetch_cart['kolicina']; ?>)</span> </p>
   <?php
      }
   }else
   {
      echo '<p class="empty">Vaša košara je prazna!</p>';
   }
   ?>
  <div class="grand-total"> Ukupni iznos : <span> BAM <?php echo number_format($grand_total, 2); ?> </span> </div>

</section>

<section class="naplata">

   <form action="" method="post">
      <h3>Izvršite Vašu narudžbu</h3>
      <div class="flex">
         <div class="inputBox">
            <span> Vaše ime :</span>
            <input type="text" name="ime" required placeholder="Unesite ime">
         </div>
         <div class="inputBox">
            <span>Broj :</span>
            <input type="number" name="broj" required placeholder="Unesite broj">
         </div>
         <div class="inputBox">
            <span>Email :</span>
            <input type="email" name="email" required placeholder="Unesite email">
         </div>
         <div class="inputBox">
            <span>Način plaćanja :</span>
            <select name="metoda">
               <option value="Pouzećem">Pouzećem</option>
               <option value="MasterCard">MasterCard</option>
               <option value="PayPal">PayPal</option>
               <option value="Bankovni transfer">Bankovni transfer</option>
            </select>
         </div>
        
         <div class="inputBox">
            <span>Adresa :</span>
            <input type="text" name="adresa" required placeholder="Unesite adresu">
         </div>
         <div class="inputBox">
            <span>Grad :</span>
            <input type="text" name="grad" required placeholder="Unesite grad">
         </div>
         
         <div class="inputBox">
            <span>Država :</span>
            <input type="text" name="drzava" required placeholder="Unesite državu">
         </div>
         
      </div>
      <input type="submit" value="Naručite sada" class="btn" name="order_btn">
   </form>

</section>

<?php include 'podnozje.php'; ?>