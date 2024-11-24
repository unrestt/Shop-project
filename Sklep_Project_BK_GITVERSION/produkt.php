<?php
session_start();
$conn = new mysqli("localhost", "root", "", "kutnik_store");

if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

$message = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = $conn->prepare("SELECT firma, model, nazwa, cena, kolor, image_url_1, image_url_2, image_url_3 FROM items WHERE id = ?");
    $query->bind_param("i", $id);
    $query->execute();

    $result = $query->get_result();

    if ($row = $result->fetch_assoc()) {
        $firma = htmlspecialchars($row['firma']);
        $model = htmlspecialchars($row['model']);
        $nazwa = htmlspecialchars($row['nazwa']);
        $kolor = htmlspecialchars($row['kolor']);
        $cena = number_format($row['cena'], 2, ',', ' ');
        $image_url_1 = htmlspecialchars($row['image_url_1']);
        $image_url_2 = htmlspecialchars($row['image_url_2']);
        $image_url_3 = htmlspecialchars($row['image_url_3']);

        $color_query = $conn->prepare("SELECT id, kolor, image_url_1 FROM items WHERE model = ? AND id != ?");
        $color_query->bind_param("si", $model, $id);
        $color_query->execute();
        $color_result = $color_query->get_result();

        $available_colors = [];
        while ($color_row = $color_result->fetch_assoc()) {
            $available_colors[] = $color_row;
        }
    } else {
        echo "Produkt nie znaleziony.";
    }
} else {
    echo "Nie wybrano produktu.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $item_id = $_POST['item_id'];
  if (!isset($_SESSION['user_id'])) {
    echo "<div id='popup_log_to_buy' class='popup hidden' data-message='Musisz się zalogować, aby dodać przedmioty do koszyka'><p></p></div>";
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                showPopup('popup_log_to_buy');
            });
          </script>";
}
else{
    $user_id = $_SESSION['user_id'];
    $rozmiar = $_POST['rozmiar'];
    $ilosc = $_POST['ilosc'];


    $stmt = $conn->prepare("SELECT ilosc FROM koszyk WHERE user_id = ? AND item_id = ? AND rozmiar = ?");
    $stmt->bind_param("iis", $user_id, $item_id, $rozmiar);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($existing_ilosc);
        $stmt->fetch();
        $nowa_ilosc = $existing_ilosc + $ilosc;

        $stmt_update = $conn->prepare("UPDATE koszyk SET ilosc = ? WHERE user_id = ? AND item_id = ? AND rozmiar = ?");
        $stmt_update->bind_param("iiis", $nowa_ilosc, $user_id, $item_id, $rozmiar);
        $stmt_update->execute();
        $stmt_update->close();
    } else {
        $stmt_insert = $conn->prepare("INSERT INTO koszyk (user_id, item_id, rozmiar, ilosc) VALUES (?, ?, ?, ?)");
        $stmt_insert->bind_param("iisi", $user_id, $item_id, $rozmiar, $ilosc);
        $stmt_insert->execute();
        $stmt_insert->close();
    }

    $stmt->close();
    $message = "Dodano do koszyka";
    header("Location: " . $_SERVER['PHP_SELF'] . "?message=" . urlencode($message) . "&id=" . $id);
    exit;
  }

   
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
    <link rel="stylesheet" href="assets/css/single_product.css">
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
      <section class="single_product">
        <div class="product-left">
            <div class="image-big">
              <img id="bigImage" src="<?php echo $image_url_1; ?>" alt="<?php echo $nazwa; ?>">
            </div>
            <div class="images-small">
              <img class="small-image" src="<?php echo $image_url_1; ?>" alt="<?php echo $nazwa; ?>">
              <img class="small-image" src="<?php echo $image_url_2; ?>" alt="<?php echo $nazwa; ?>">
              <img class="small-image" src="<?php echo $image_url_3; ?>" alt="<?php echo $nazwa; ?>">
            </div>
        </div>
        <div class="product-right">
            <div class="product-top-text">
            <p><?php echo $nazwa; ?> (<?php echo $kolor; ?>)</p>
              <p><b><?php echo $cena; ?> zł</b></p><br>
            </div>
            <hr><br>
            <div class="product-colors">
                    <p>Dostępne kolory:</p><br>
                    <?php foreach ($available_colors as $color): ?>
                        <a href="produkt.php?id=<?php echo $color['id']; ?>">
                            <img class="color-image" src="<?php echo $color['image_url_1']; ?>" alt="Kolor: <?php echo $color['kolor']; ?>">
                        </a>
                    <?php endforeach; ?>
                </div>
              <form method="POST" id="produkt_form">
                <input type="hidden" name="item_id" value="<?php echo $id; ?>">
                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                
                <div class="product-size">
                    <p>Wybierz rozmiar</p><br>
                    <div class="sizes">
                        <div class="single-size" data-size="35">35</div>
                        <div class="single-size" data-size="36">36</div>
                        <div class="single-size" data-size="37">37</div>
                        <div class="single-size" data-size="38">38</div>
                        <div class="single-size" data-size="39">39</div>
                        <div class="single-size" data-size="40">40</div>
                        <div class="single-size" data-size="41">41</div>
                        <div class="single-size" data-size="42">42</div>
                        <div class="single-size" data-size="43">43</div>
                        <div class="single-size" data-size="44">44</div>
                        <div class="single-size" data-size="45">45</div>
                        <div class="single-size" data-size="46">46</div>
                    </div>
                    <div id="popup_size" class="popup hidden" data-message="Proszę wybrać rozmiar przed dodaniem do koszyka.">
                        <p></p>
                    </div>

                    <input type="hidden" name="rozmiar" id="selected-size" required><br>
                </div>
                <div class="table-size">
                    <i class="fa-solid fa-ruler-vertical"></i>
                    <p id="tabela"><u>Tabela rozmiarów</u></p>
                    <div id="modal" class="modal">
                        <div class="modal-content" id="modal-content">
                            <img src="assets/images/tabela_rozmiaru.png" alt="tabela rozmiaru">
                            <span class="close-button">&times;</span>
                        </div>
                    </div>
                </div><br>
                
                <div class="product-add-cart">
                    <p>Ilosc</p>
                    <div class="product-add-cart-flex">
                        <button id="dec" type="button">-</button>
                        <p id="licznik">1</p>
                        <button id="inc" type="button">+</button>
                        <input type="hidden" name="ilosc" id="hidden-quantity" value="1">
                        <button type="submit" class="big-button">Dodaj do koszyka</button>
                    </div>
                </div>
            </form>
              <div id="popup-message" class="popup" style="display:none;">
                <p>Dodano do koszyka</p>
              </div>

            <br><br>
            <div class="product-infomations">
                <i class="fa-solid fa-truck"></i> Darmowa dostawa od 300 zł<br><br>
                <i class="fa-solid fa-arrow-rotate-left"></i> 30 dni na darmowy zwrot<br><br>
                <i class="fa-solid fa-clock"></i> Standardowa dostawa: <b>2 - 4 dni robocze</b><br><br>
            </div>
        </div>
        <div id="show_box_cart" class="show-box hidden">
            <div class="show-box-content">
              <div class="show-box-content-text">
                <p>Produkt pomyślnie dodano do koszyka!</p>
              </div><br>
                <div class="show-box-content-buttons">
                  <button id="continue_shopping">Kontynuuj zakupy</button>
                  <button id="checkout">Złóż zamówienie</button>
                </div>
            </div>
        </div>
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
    <script src="assets/js/single_product.js"></script>
    <script src="assets/js/search.js"></script>
    <script src="assets/js/cart_counter.js"></script>
    <script>
        <?php if (isset($_GET['message']) && $_GET['message'] == "Dodano do koszyka"): ?>
            document.addEventListener("DOMContentLoaded", function() {
                showCartBox();
            });
        <?php endif; ?>
    </script>
    <script src="assets/js/popup_produkt.js"></script>
</body>
</html>