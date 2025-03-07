<?php
session_start();  

include 'povezivanje.php'; 

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];  
} else {
    $user_id = 0; 
}

if ($user_id != 0) {
    $cart_query = mysqli_query($conn, "SELECT SUM(kolicina) AS total_quantity FROM `kosara` WHERE user_id = '$user_id'");
    $cart_data = mysqli_fetch_assoc($cart_query);
    
    if (isset($cart_data['total_quantity']) && $cart_data['total_quantity'] !== NULL) {
        $total_cart_quantity = $cart_data['total_quantity'];
    } else {
        $total_cart_quantity = 0;
    }
}

?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BookNest</title>
    <link rel="stylesheet" href="styleapp.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>
<body>

<header class="header">

<div class="header-1">
    <div class="flex">
        <div class="share">
            <a href="#" class="fab fa-facebook-f"></a>
            <a href="#" class="fab fa-instagram"></a>
            <a href="#" class="f-solid fa-x"></a>
            <a href="#" class="fab fa-linkedin"></a>
        </div>
        <p> Nova <a href="login.php">Prijava</a> | <a href="registracija.php">Registracija</a> </p>

    </div>
</div>

<div class="header-2">
   <div class="flex">
   <a href="pocetna.php" class="logo"><i>BookNest</i></a>

   <nav class="navbar"> 
    <a href="pocetna.php">Početna</a>
    <a href="onama.php">O nama</a>
    <a href="shop.php">Shop</a>
    <a href="kontakt.php">Kontakt</a>
    <a href="narudzbe.php">Narudžbe</a>
   </nav>

   <div class="ikone">
    
    <a href="trazilica.php" class="fas fa-search"></a>
    <div id="user-btn" class="fas fa-user"></div>
    <?php
        $select_cart_number = mysqli_query($conn, "SELECT * FROM `kosara` WHERE user_id = '$user_id'") or die('query failed');
        $cart_rows_number = mysqli_num_rows($select_cart_number); 
     ?>
     <a href="kosara.php"> <i class="fas fa-shopping-cart"></i> <span>(<?php echo $cart_rows_number; ?>)</span> </a>
         
</div>

   <?php

if (isset($_SESSION['korisnik'])) {
   
    $email = $_SESSION['korisnik'];

    $select_user = mysqli_query($conn, "SELECT ime_korisnika FROM `korisnici` WHERE email_korisnika = '$email'") or die('query failed');
    if (mysqli_num_rows($select_user) > 0) {
        $row = mysqli_fetch_assoc($select_user);
        $ime_korisnika = $row['ime_korisnika']; 
    }

    echo "<div class='user-box'>
            <p>Dobrodošli, $ime_korisnika <br> $email </br></p>
            <a href='logout.php' class='logout-btn'>Odjava</a>
          </div>";
    } 
    else {
    echo "<p>Molimo prijavite se.</p>";
      }
   ?>
</div>
</div>

</header>

<script>
    document.getElementById('user-btn').addEventListener('click', function() {
        var userBox = document.querySelector('.user-box');
        
        if (userBox.style.display === 'block') {
            userBox.style.display = 'none'; 
        } else {
            userBox.style.display = 'block'; 
        }
    });
</script>

</body>