<?php
session_start();
$conn = new mysqli("localhost", "root", "", "kutnik_store");
$message_order = '';
if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

if (isset($_SESSION['user_id'])){
    
  $user_id = $_SESSION['user_id'];

  $query = "SELECT SUM(koszyk.ilosc * items.cena) AS total_price_koszyk
  FROM koszyk 
  INNER JOIN items ON koszyk.item_id = items.id
  WHERE koszyk.user_id = $user_id";




$result = $conn->query($query);

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $total_price = $row["total_price_koszyk"];
  }
}




$message_order = isset($_SESSION['message_order']) && isset($_SESSION['user_id']) ? $_SESSION['message_order'] : '';
}


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
    <link rel="stylesheet" href="assets/css/kontakt.css">
    <link rel="stylesheet" href="assets/css/koszyk.css">
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
      <div id="popup_4" class="popup <?= !empty($message_order) ? '' : 'hidden'; ?>" data-message="<?= htmlspecialchars($message_order); ?>">
    <p><?= htmlspecialchars($message_order); ?></p>
  </div>
        <div class="top-text">
            <p><b>KOSZYK</b></p>
          </div>

        <div class="cart-container">
            <div class="cart-text">
                <span class="span-text" id="text_1">PRODUKT</span>
                <span class="span-space"></span>
                <span class="span-text" id="text_2">ILOŚĆ</span>
                <span class="span-text" id="text_3">RAZEM</span>
            </div>
            <div class="cart-line">
                <div class="cart-boxes">
                  
  <?php

$conn = new mysqli("localhost", "root", "", "kutnik_store");

if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

if (isset($_SESSION['user_id'])) {
  
    $user_id = $_SESSION['user_id'];

    $query = "SELECT items.nazwa, koszyk.rozmiar, items.cena, koszyk.ilosc, items.image_url_1, koszyk.item_id
    FROM koszyk 
    INNER JOIN users ON koszyk.user_id = users.id
    INNER JOIN items ON koszyk.item_id = items.id
    WHERE users.id = $user_id";

    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $nazwa = $row['nazwa'];
            $rozmiar = $row['rozmiar'];
            $cena = $row['cena'];
            $ilosc = $row['ilosc'];
            $url = $row['image_url_1'];
            $item_id = $row["item_id"];
            $subtotal = $cena * $ilosc;

            echo '
            <div class="cart-box" data-item-id="'.$item_id.'" data-rozmiar="'.$rozmiar.'">
                <img class="cart-box-image" src="'.$url.'" alt="'.$nazwa.'">
                <div class="middle-div">
                 <div class="cart-box-text">
                    <p><b>' . $nazwa . '</b></p>
                    <p>' . $rozmiar . '</p>
                    <p>' . number_format($cena, 2) . ' Zl</p>
                
              

                </div>
                <div class="cart-box-amount">
                          <div class="cart-box-counter">
                              <p class="cart-char cart-char-minus" id="cart-char-minus">-</p>
                              <p class="cart-quantity">' . $ilosc . '</p>
                              <p class="cart-char cart-char-plus" id="cart-char-plus">+</p>
                          </div>
                      <p class="delete-cart-item" data-item-id="'.$item_id.'" data-rozmiar="'.$rozmiar.'"><u>USUŃ</u></p>
              </div>
                </div>
               
                <div class="cart-box-prize">    
                    <p>' . number_format($subtotal, 2) . ' Zl</p>
                </div>
            </div>';
        }
    } else {
      echo '
      <div class="no-items">
        <div class="space-1"></div>
        <div class="space-2">
        <p>Brak produktów w koszyku.</p>
        </div>
        <div class="space-3"></div>

      </div>';
    };
}else{
  echo '
  <div class="no-items"> 
    <div class="space-1"></div>
    <div class="space-2">
    <p>Brak produktów w koszyku.</p>
    </div>
    <div class="space-3"></div>

  </div>';
}
$conn->close();
?>

                    
                    
                    
                </div>
            </div>
            <div class="cart-below">
                <p><?php
                    if(isset($_SESSION['user_id'])){
                      echo '<b id="total-price">RAZEM: ' . $total_price . ' Zl</b>';
                    }
                  
                ?></p>
              <form method="POST" action="submit_order.php">
                  <button type="submit"><b>ZŁÓŻ ZAMÓWIENIE</b></button>
              </form>
            </div>
        </div>
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
    <script src="assets/js/delete_cart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/search.js"></script>
    <script src="assets/js/cart_counter.js"></script>
    <script src="assets/js/change_quantity.js"></script>
    <script src="assets/js/popup_cart.js"></script>

    <?php
unset($_SESSION['message_order']);
?>
</body>
</html>