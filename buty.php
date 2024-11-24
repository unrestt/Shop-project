<?php
$conn = new mysqli("localhost", "root", "", "kutnik_store");


if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

$query = "SELECT * FROM items ORDER BY firma";
$result = $conn->query($query);

$products = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[$row['firma']][] = $row;
    }
} else {
    echo "Brak produktów w sklepie.";
}

$conn->close();
?>






<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kutnik Store</title>
    <link rel="icon" type="image/x-icon" href="assets/images/logo/icon.ico">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/nav.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/slider.css">
    <link rel="stylesheet" href="assets/css/products.css">
    <link rel="stylesheet" href="assets/css/footer.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
</head>
<body>
<header>
        <div class="container-header-left">
            <a href="index.php"><img src="assets/images/logo/logo.png" alt="logo kutnik store"></a>
        </div>
        <div class="container-header-right">
          <div class="searching-container">
            <div class="search-bar">
            <i class="fa-solid fa-magnifying-glass" id="search-icon"></i>
            <input type="text" placeholder="Szukaj..." class="search-input" id="search-input" oninput="showResults(this.value)">
          </div>
            <div id="search-results" class="search-results">
            </div>
          </div>

            <div class="circle-smth">
            <a href="login.php"><i class="fa-solid fa-user"></i></a> 
            <a href="koszyk.php"><i class="fa-solid fa-cart-shopping"></i></a>
              <div class="circle-cart" id="circle-cart">
                <p class="circle-number" id="circle-number">
                    
                </p>
              </div>
            </div>
           
        </div>
    </header>
    <div class="mobile-search-container" id="mobile-search-container">
    <input type="text" placeholder="Szukaj..." class="mobile-search-input" id="mobile-search-input" oninput="showResults(this.value)">
    <div id="mobile-search-results" class="search-results"></div>
  </div>
    <div class="navigation">
      <input type="checkbox" id="nav_check" hidden>
      <nav>
        <div class="logo">
          <img src="assets/images/logo/logo_black.png" alt="dsad">
        </div>
        <ul>
          <li>
            <a href="index.php">Home</a>
          </li>
          <li class="space">/</li>
          <li>
            <a href="buty.php">Buty</a>
          </li>
          <li class="space">/</li>
          <li>
            <a href="kontakt.php">Kontakt</a>
          </li>
        </ul>
    </nav>
    <label for="nav_check" class="hamburger">
      <div></div>
      <div></div>
      <div></div>
    </label>
    </div>
    
    <main>
    <section class="products">
            <?php foreach ($products as $brand => $brandProducts): ?>
                <div class="top-text">
                    <p><b><?php echo strtoupper($brand); ?></b></p>
                </div>
                <div class="containers">
                    <?php foreach ($brandProducts as $product): ?>
                        <div class="container-box">
                            <div class="container-box-image">
                                <a href="produkt.php?id=<?php echo $product['id']; ?>">
                                    <img src="<?php echo $product['image_url_1']; ?>" alt="<?php echo $product['nazwa']; ?>">
                                </a>
                            </div>
                            <p class="container-box-title"><b><?php echo $product['nazwa']; ?></b></p>
                            <p class="container-box-price"><?php echo number_format($product['cena'], 2, ',', ' ') . ' zł'; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?>
        </section>
    </main>
    <footer>
      <div class="footer-social">
        <a href="https://www.facebook.com/" target="_blank">
          <i class="fa-brands fa-facebook"></i>
        </a>
        <a href="https://www.instagram.com/" target="_blank">
          <i class="fa-brands fa-instagram"></i>
        </a>
        <a href="https://www.tiktok.com/pl-PL/" target="_blank">
          <i class="fa-brands fa-tiktok"></i>
        </a>
      </div>
      <div class="footer-text">
        <p>Copyright © Kutnik Store, Wszelkie prawa zastrzeżone 2024</p>
      </div>
    </footer>
    <script src="https://kit.fontawesome.com/70f2470b08.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script src="assets/js/search.js"></script>
    <script src="assets/js/slider.js"></script>
    <script src="assets/js/cart_counter.js"></script>
</body>
</html>