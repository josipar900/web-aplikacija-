<?php

include 'zaglavlje.php';

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = 0;
}

if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
 
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `kosara` WHERE ime_proizvoda = '$product_name' AND user_id = '$user_id'") or die('query failed');
 
    if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'Već dodano u košaru!';
    }else{
       mysqli_query($conn, "INSERT INTO `kosara`(user_id, ime_proizvoda, cijena, kolicina, image) VALUES('$user_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
       $message[] = 'Proizvod dodan u košaru!';
    }
 
 }
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>

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
   <h3>Naš shop</h3>
   <p> <a href="pocetna.php">Početna</a> / Shop </p>
</div>

<section class="knjige">

   <h1 class="title">Najbolje ponude</h1>

   <div class="box-container">
    
   <?php  
      $select_products = mysqli_query($conn, "SELECT * FROM `shop_knjige` ") or die('query failed');
      if(mysqli_num_rows($select_products) > 0){
       while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
     <form action="" method="post" class="box">
      <img class="image" src="shopknjige/<?php echo $fetch_products['slika']; ?>" alt="">
      <div class="name"><?php echo $fetch_products['ime']; ?></div>
      <div class="price"><?php echo number_format($fetch_products['cijena'], 2); ?> BAM</div>
      <input type="number" min="1" name="product_quantity" value="1" class="qty">
      <input type="hidden" name="product_name" value="<?php echo $fetch_products['ime']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_products['cijena']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $fetch_products['slika']; ?>">
      <input type="submit" value="Dodaj u košaru" name="add_to_cart" class="btn">
     </form>
     <?php
         }
      }else{
         echo '<p class="empty">Još uvijek nema dodanih proizvoda!</p>';
      }
      ?>
   </div>

</section>

<?php include 'podnozje.php'; ?>


