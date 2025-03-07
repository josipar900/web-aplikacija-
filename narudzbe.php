<?php

include 'zaglavlje.php';

$user_id = $_SESSION['user_id'] ;

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Narudžbe</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="styleapp.css">
</head>
<body>

<div class="zaglavlje-onama">
   <h3>Vaše narudžbe</h3>
   <p> <a href="pocetna.php">Početna</a> / Narudžbe </p>
</div>

<section class="izvrsene-narudzbe">

   <h1 class="title">Izvršene narudžbe</h1>

   <div class="box-container">

   <?php
      $order_query = mysqli_query($conn, "SELECT * FROM `narudzbe` WHERE user_id = '$user_id'") or die('query failed'); // Dohvacanje baza
         if(mysqli_num_rows($order_query) > 0){
            while($fetch_orders = mysqli_fetch_assoc($order_query)){
   ?>
      <div class="box">
         <p> Datum narudžbe : <span><?php echo $fetch_orders['postavljeno_na']; ?></span> </p>
         <p> Ime : <span><?php echo $fetch_orders['ime']; ?></span> </p>
         <p> Broj : <span><?php echo $fetch_orders['broj']; ?></span> </p>
         <p> Email : <span><?php echo $fetch_orders['email']; ?></span> </p>
         <p> Adresa : <span><?php echo $fetch_orders['adresa']; ?></span> </p>
         <p> Način plaćanja : <span><?php echo $fetch_orders['metoda_placanja']; ?></span> </p>
         <p> Vaša narudžba: <span><?php echo $fetch_orders['ukupni_proizvodi']; ?></span> </p>
         <p> Ukupni iznos : <span>  <?php echo $fetch_orders['ukupna_cijena']; ?> BAM </span> </p>
         <p> Status plaćanja : <span style="color:<?php if($fetch_orders['status_placanja'] == 'Na čekanju'){ echo 'red'; }else{ echo 'green'; } ?>;"><?php echo $fetch_orders['status_placanja']; ?></span> </p>
         </div>
         <?php
       }
      }
      else
      {
         echo '<p class="empty">Još nema izvršenih narudžbi!</p>';
      }
      ?>
   </div>

</section>

<?php include 'podnozje.php'; ?>