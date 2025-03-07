<?php
include 'zaglavlje.php'; 


if(isset($_POST['add_to_cart'])){
   
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];

    
    $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `kosara` WHERE ime_proizvoda = '$product_name' AND user_id = '$user_id'") or die('query failed');
    
    if(mysqli_num_rows($check_cart_numbers) > 0){
        $message[] = 'Već dodano u košaru!';
    } else {
       
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
    <title>Početna</title>

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
    
    <section class="home">
        <div class="content">
            <h3>Čitanje obogaćuje um - knjige mijenjaju život!</h3>
            <p>📖 Čitanje nam otvara vrata u svjetove mašte, znanja i novih perspektiva. Svaka knjiga nosi priču koja može inspirirati, poučiti i promijeniti način na koji vidimo svijet. <br>🌍 Svijet knjiga je putovanje koje nikada ne prestaje. Kroz svaku stranicu otkrivamo nove horizonte, upoznajemo različite kulture i proširujemo vlastite vidike.
            <br>💡 U knjigama se kriju odgovori na pitanja koja nismo ni znali postaviti. Neka svaka nova priča bude korak bliže razumijevanju sebe i svijeta oko nas.</p>
            <a href="onama.php" class="gumbotkrij">Otkrijte više</a>
        </div>
    </section>

    <section class="knjige">
        <h1 class="title">Najpopularnija izdanja</h1>

        <div class="box-container">
            <?php  
            $select_products = mysqli_query($conn, "SELECT * FROM `najpopularnije_knjige` LIMIT 6") or die('query failed');
            if(mysqli_num_rows($select_products) > 0){
                while($fetch_products = mysqli_fetch_assoc($select_products)){
            ?>
            <form action="" method="post" class="box">
                <img class="image" src="knjigeslike/<?php echo $fetch_products['slika']; ?>" alt="">
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
            } else {
                echo '<p class="empty">Nema dodanih knjiga!</p>';
            }
            ?>
        </div>

        <div class="load-more" style="margin-top: 2rem; text-align:center">
            <a href="shop.php" class="gumbotkrij">Učitaj više</a>
        </div>
    </section>

    <section class="onama">
        <div class="flex">
            <div class="image">
                <img src="onama.jpg" alt="">
            </div>

            <div class="content">
                <h3>O nama</h3>
                <p>Dobrodošli u <i>BookNest</i> - gnijezdo knjiga! Naša misija je pružiti vam jednostavan i ugodan način za otkrivanje i kupovinu knjiga koje volite. Bilo da ste strastveni čitatelj, kolekcionar ili tražite savršen poklon, ovdje ćete pronaći širok izbor literature koji zadovoljava sve vaše potrebe.</p>
                <a href="onama.php" class="btn">Pročitajte više</a>
            </div>
        </div>
    </section>

    <section class="pocetna-kontakt">
        <div class="content">
            <h3>Imate pitanja?</h3>
            <p>Kontaktirajte nas putem naših kanala i rado ćemo vam pomoći s odgovorima ili informacijama koje su vam potrebne.</p>
            <a href="kontakt.php" class="btn">Kontaktirajte nas</a>
        </div>
    </section>

    <?php include 'podnozje.php'; ?>


</body>
</html>
