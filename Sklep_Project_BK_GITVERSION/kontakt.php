<?php
session_start();
$imie = '';
$nazwisko = '';
$email = '';

$message_contact = "";
$conn = new mysqli("localhost", "root", "", "kutnik_store");


if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT imie, nazwisko, email FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $imie = $row['imie'];
        $nazwisko = $row['nazwisko'];
        $email = $row['email'];
    }
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $imie = $_POST['imie'];
  $nazwisko = $_POST['nazwisko'];
  $email = $_POST['email'];
  $telefon = $_POST['telefon'];
  $wiadomosc = $_POST['wiadomosc'];
  $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;

  $query = "INSERT INTO kontakt (user_id, imie, nazwisko, email, numer_tel, wiadomosc) 
  VALUES " . 
  (is_null($user_id) ? "(NULL, '$imie', '$nazwisko', '$email', '$telefon', '$wiadomosc')" : 
  "('$user_id', '$imie', '$nazwisko', '$email', '$telefon', '$wiadomosc')");

  if (mysqli_query($conn, $query)) {
        $_SESSION['message_contact'] = "Wiadomość została wysłana";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
  } else {
      echo "Błąd: " . mysqli_error($conn);
  }

  mysqli_close($conn);
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
    <?php
if (isset($_SESSION['message_contact'])) {
    $message_contact = $_SESSION['message_contact'];
    unset($_SESSION['message_contact']);
} else {
  $message_contact = '';
}
?>
<div id="popup_3" class="popup <?= !empty($message_contact) ? '' : 'hidden'; ?>" data-message="<?= htmlspecialchars($message_contact); ?>">
    <p></p>
</div>
        <div class="container-contact">
            <div class="text-top">
                <p><b>KONTAKT</b></p>
            </div>
                <div class="container">  
                <form id="contact" method="post">
                    <input placeholder="Twoje imie" type="text" name="imie" value="<?php echo $imie; ?>" tabindex="1" required autofocus>
                    <input placeholder="Twoje nazwisko" type="text" name="nazwisko" value="<?php echo $nazwisko; ?>" tabindex="2" required>
                    <input placeholder="Twoj E-mail" type="email" name="email" value="<?php echo $email; ?>" tabindex="3" required>
                    <input placeholder="Twoj numer telefonu" type="tel" name="telefon" tabindex="4" required>
                    <textarea placeholder="Twoja wiadomosc..." name="wiadomosc" tabindex="5" required></textarea>
                    <button name="submit" type="submit" id="contact-submit">Wyślij</button>
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
    <script src="assets/js/popup_kontakt.js"></script>
    <script src="assets/js/search.js"></script>
    <script src="assets/js/cart_counter.js"></script>
</body>
</html>