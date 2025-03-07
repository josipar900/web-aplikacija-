<?php

include 'zaglavlje.php';

$user_id = $_SESSION['user_id'];

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

};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Tražilica</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="styleapp.css">
</head>
<body>

<div class="zaglavlje-onama">
   <h3>Tražilica</h3>
   <p> <a href="pocetna.php">Početna</a> / Tražilica </p>
</div>

<section class="search-form">

<form action="" method="post">
      <input type="text" name="search" placeholder="Pretražite knjige..." class="box">
      <input type="submit" name="submit" value="Pretraži" class="btn">
   </form>

<section class="knjige" style="padding-top: 0;">

   <div class="box-container">
   <?php
      if(isset($_POST['submit'])){
         $search_item = $_POST['search'];

        $select_products = mysqli_query($conn, "
            (SELECT *, 'najpopularnije_knjige' AS source FROM `najpopularnije_knjige` WHERE ime LIKE '%{$search_item}%')
            UNION
            (SELECT *, 'shop_knjige' AS source FROM `shop_knjige` WHERE ime LIKE '%{$search_item}%')
         ") or die('query failed');

         if(mysqli_num_rows($select_products) > 0){
            while($fetch_product = mysqli_fetch_assoc($select_products)){
               $image_path = ($fetch_product['source'] == 'najpopularnije_knjige') ? 'knjigeslike/' : 'shopknjige/';
               $image_path .= $fetch_product['slika'];
   ?>
   <form action="" method="post" class="box">
      <img class="image" src="<?php echo $image_path; ?>" alt="" >
      <div class="name"><?php echo $fetch_product['ime']; ?></div>
      <div class="price"><?php echo $fetch_product['cijena']; ?> BAM </div>
      <input type="number"  class="qty" name="product_quantity" min="1" value="1">
      <input type="hidden" name="product_name" value="<?php echo $fetch_product['ime']; ?>">
      <input type="hidden" name="product_price" value="<?php echo $fetch_product['cijena']; ?>">
      <input type="hidden" name="product_image" value="<?php echo $image_path; ?>">
      <input type="submit" class="btn" value="Dodaj u košaru" name="add_to_cart">
   </form>
   <?php
            }
         }else{
            echo '<p class="empty">Nema rezultata!</p>';
         }
      }else{
         echo '<p class="empty">Unesite pojam za pretragu!</p>';
      }
   ?>
   </div>

</section>

</section>

<?php include 'podnozje.php'; ?>


</body>
</html>
