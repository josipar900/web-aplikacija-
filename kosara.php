<?php

include 'zaglavlje.php';


$user_id = $_SESSION['user_id'] ;

if(isset($_POST['update_cart'])){
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    mysqli_query($conn, "UPDATE `kosara` SET kolicina = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
    $message[] = ' Količina proizvoda u košari ažurirana! ';
 }
 
 
 if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `kosara` WHERE id = '$delete_id'") or die('query failed');
    header('location:kosara.php');
 }
 
 if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `kosara` WHERE user_id = '$user_id'") or die('query failed');
    header('location:kosara.php');
 }
 
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Košara</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="styleapp.css">
</head>
<body>

<?php
if(isset($message) && is_array($message)){
    foreach($message as $msg){
        echo '<div class="message">
                <span>'.$msg.'</span>
                <i class="fa fa-times" onclick="this.parentElement.style.display=\'none\';"></i>
              </div>';
    }
}
?>

<div class="zaglavlje-onama">
   <h3>Vaša košara</h3>
   <p> <a href="pocetna.php">Početna</a> / Košara </p>
</div>

<section class="kosara-kupovina">

   <h1 class="title">Dodani proizvodi</h1>

   <div class="box-container">

   <?php
         $grand_total = 0;
         $select_cart = mysqli_query($conn, "SELECT * FROM `kosara` WHERE user_id = '$user_id'") or die('query failed');
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){   
   ?>

<?php
$naziv_slike = $fetch_cart['image']; 
$mape = ['knjigeslike/', 'shopknjige/']; 
$slika_putanja = 'default.jpg'; 

foreach ($mape as $mapa) {
    if (file_exists($mapa . $naziv_slike)) { 
        $slika_putanja = $mapa . $naziv_slike;
        break;
    }
}
?>
      <div class="box">
         <a href="kosara.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('Izbrisati iz košare?');"></a>
         <img src="<?php echo $slika_putanja; ?>" alt="Knjiga">
         <div class="name"><?php echo $fetch_cart['ime_proizvoda']; ?></div>
         <div class="price"><?php echo number_format($fetch_cart['cijena'], 2); ?> BAM</div>
         <form action="" method="post">
            <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id']; ?>">
            <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['kolicina']; ?>">
            <input type="submit" name="update_cart" value="Ažuriraj" class="option-btn">
         </form>
         <div class="sub-total"> Ukupno : <span><?php echo number_format($sub_total = ($fetch_cart['kolicina'] * $fetch_cart['cijena']), 2); ?> BAM</span> </div>

      </div>

      <?php
      $grand_total = $grand_total + $sub_total;
      }
      }else{
         echo '<p class="empty">Vaša košara je prazna!</p>';
      }
      ?>
      </div>

<div style="margin-top: 2rem; text-align:center;">
<?php
if ($grand_total > 1) {
    echo '<a href="kosara.php?delete_all" class="delete-btn" onclick="return confirm(\'Izbrisati sve iz košare?\');">Izbrisati sve</a>';
} else {
    echo '<a href="#" class="delete-btn disabled" onclick="return confirm(\'Izbrisati sve iz košare?\');">Izbrisati sve</a>';
}
?>

</div>

<div class="cart-total">
<p>Ukupni iznos : <span><?php echo number_format($grand_total, 2); ?> BAM</span></p>

   <div class="flex">
      <a href="shop.php" class="option-btn">Nastavite kupovinu</a>
      <?php
   if ($grand_total > 1) {
       echo '<a href="naplata.php" class="btn">Nastavite na naplatu</a>';
   } else {
       echo '<a href="#" class="btn disabled">Nastavite na naplatu</a>';
   }
   ?>
   </div>
</div>

</section>

<?php include 'podnozje.php'; ?>