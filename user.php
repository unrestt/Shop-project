<?php
session_start();
$conn = new mysqli("localhost", "root", "", "kutnik_store");

if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$message = "";
$message_password = "";

$sql = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['imie_change']) && isset($_POST['nazwisko_change'])) {
        $imie = htmlspecialchars($_POST['imie_change']);
        $nazwisko = htmlspecialchars($_POST['nazwisko_change']);

        $sql = "UPDATE users SET imie = ?, nazwisko = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $imie, $nazwisko, $user_id);

        if ($stmt->execute()) {
          $_SESSION['message'] = "Udało się! Twoje dane zostały zapisane";
          header("Location: " . $_SERVER['PHP_SELF']);
          exit;
        } else {
            echo "Błąd aktualizacji: " . $stmt->error;
        }

        $stmt->close();
    }

// Zmiana hasła
if (isset($_POST['actual_password']) && isset($_POST['new_password_1']) && isset($_POST['new_password_2'])) {
    $actualPassword = $_POST['actual_password'];
    $newPassword1 = $_POST['new_password_1'];
    $newPassword2 = $_POST['new_password_2'];

    if (password_verify($actualPassword, $user['password'])) {
        $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
        
        if (!preg_match($passwordPattern, $newPassword1)) {
            echo "Hasło musi zawierać min. 8 znaków, w tym małą literę, dużą literę, cyfrę i znak specjalny.";
        } elseif ($newPassword1 !== $newPassword2) {
            echo "Nowe hasła nie są takie same.";
        } else {
            $newPasswordHash = password_hash($newPassword1, PASSWORD_DEFAULT);
            $updateStmt = $conn->prepare("UPDATE users SET password = ? WHERE id = ?");
            $updateStmt->bind_param("si", $newPasswordHash, $user_id);
            
            if ($updateStmt->execute()) {
                $_SESSION['message_password'] = "Udało się! Twoje hasło zostało zaktualizowane";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit;
            } else {
                echo "Wystąpił problem z aktualizacją hasła: " . $updateStmt->error;
            }
            $updateStmt->close();
        }
    } else {
      $message_password = "Aktualne hasło jest niepoprawne";
    }
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
    <link rel="stylesheet" href="assets/css/kontakt.css">
    <link rel="stylesheet" href="assets/css/login-register.css">
    <link rel="stylesheet" href="assets/css/user.css">
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
        <div class="text-top">
            <b><p id="text-top">UŻYTKOWNIK</p></b>
        </div>
        <div class="user-container">
                <div class="user-options">
                    <div class="user-single-option"><b>Panel</b></div>
                    <div class="user-single-option">Dane kontaktowe</div>
                    <div class="user-single-option">Moje zamówienia</div>
                    <div class="user-single-option">Zmień hasło</div>
                                          
                </div>
            <div class="user-profile-mojeKonto">
                <p class="header-profile-text">Moje Konto</p>
                <div class="user-profile-row">
                    <div class="user-profile-text">
                      <p><b><?= htmlspecialchars($user['imie'])." ".htmlspecialchars($user['nazwisko']); ?></b></p>
                      <p><?= htmlspecialchars($user['email']); ?></p>
                    </div>
                    
                    <div class="change-button">
                      <i class="fa-solid fa-pencil"></i>
                      <p>Zmień</p>
                    </div>

                </div>
              
                <div class="user-profile-row-zamowienia">
                <?php
        $conn = new mysqli("localhost", "root", "", "kutnik_store");

        if ($conn->connect_error) {
            die("Błąd połączenia: " . $conn->connect_error);
        }

        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];

            $query = "SELECT * FROM zamowienia WHERE user_id = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $user_id);
            $stmt->execute();
            $result = $stmt->get_result();


            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='user-profile-text zamowienie'>";
                    echo "<b><p>Zamówienie #".$row['id']."</p></b>";
                    echo "<p class='user-profile-p'>Data zamówienia: ".$row['data_zamowienia']."</p>";
                    echo "<p class='user-profile-p'>Kwota: ".$row['calk_kwota']." zł</p>";
                    echo "<p class='user-profile-p'><b>Status: ".$row['status']."</b></p>";
                    echo "</div>";
                }
            } else {
                echo "<div class='user-profile-text' id='nie-masz-zamowien'>";
                echo "<b><p>Moje zamówienia</p></b>";
                echo "<p>Obecnie nie masz żadnych zamówień</p>";
                echo "</div>";
            }
        } else {
            echo "Nie jesteś zalogowany.";
        }

        $conn->close();
        ?>
                </div>
                
            </div>
            <div class="user-profile-daneKontaktowe">
            <p class="header-profile-text">Dane kontaktowe</p>
              <form method="post">
              <div class="user-profile-column">
                  <p class="input_name">Imię *</p>
                  <input type="text" name="imie_change" value="<?= htmlspecialchars($user['imie']); ?>">
                  <p class="input_name">Nazwisko *</p>
                  <input type="text" name="nazwisko_change" value="<?= htmlspecialchars($user['nazwisko']); ?>">
                  <p class="input_name">E-mail *</p>
                  <input type="text" name="email_change" disabled value="<?= htmlspecialchars($user['email']); ?>"><br><br>

                  <button type="submit">Zapisz</button>
                </div>
              </form>
               
        
            </div>
            <div class="user-profile-zamowienia">
            <p class="header-profile-text">Moje zamówienia</p>
            <?php
$conn = new mysqli("localhost", "root", "", "kutnik_store");

if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $query = "SELECT * FROM zamowienia WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    echo '<div class="user-profile-zamowienia-all">';

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "<div class='user-profile-row-zamowienia-section'>";
            echo "<div class='user-profile-text'>";
            echo "<b><p>Zamówienie #".$row['id']."</p></b>";
            echo "<p class='user-profile-p'>Data zamówienia: ".$row['data_zamowienia']."</p>";
            echo "<p class='user-profile-p'>Kwota: ".$row['calk_kwota']." zł</p>";
            echo "<p class='user-profile-p'><b>Status: ".$row['status']."</b></p>";
            echo "</div>";
            echo "<div class='user-profile-space'></div>";

            $query_items = "SELECT przedmioty_zamowione.*, items.nazwa, items.firma 
                            FROM przedmioty_zamowione 
                            INNER JOIN items ON przedmioty_zamowione.item_id = items.id 
                            WHERE przedmioty_zamowione.zamowienie_id = ?";
            $stmt_items = $conn->prepare($query_items);
            $stmt_items->bind_param("i", $row['id']);
            $stmt_items->execute();
            $result_items = $stmt_items->get_result();

            echo "<div class='order-items'>";
            while ($item = $result_items->fetch_assoc()) {
                echo "<div class='order-item'>";
                echo "<p>".$item['nazwa']."</p> <b>x".$item['ilosc']."</b>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
        }
    } else {
        echo "<div class='user-profile-row-zamowienia-section'>";
        echo "<div class='user-profile-text'>";
        echo "<b><p>Moje zamówienia</p></b>";
        echo "<p>Obecnie nie masz żadnych zamówień</p>";
        echo "</div>";
        echo "</div>";
    }
    echo '</div>';
    
} else {
    echo "Nie jesteś zalogowany.";
}

$conn->close();
?>
            </div>
            <div class="user-profile-zmienHaslo">
            <p class="header-profile-text">Zmień hasło</p>
            <form id="password-form" method="post">
               <div class="user-profile-column">
                  <p class="input_name">Aktualne hasło *</p>
                  <input type="text" name="actual_password" required>  
                  <p class="input_name">Nowe hasło *</p>
                  <div class="password-information">
                    <i class="fa-solid fa-circle-info"></i>
                    <p id="walidacja">Hasło musi zawierać min. 8 znaków, dużą literę, cyfrę i znak specjalny.</p>
                  </div>
                  
                  
                  <input type="text" name="new_password_1" required>
                  <p class="input_name">Powtórz hasło *</p>
                  <input type="text" name="new_password_2" required><br><br>

                  <button type="submit" id="password_button">Zapisz</button><br>
                  <div id="password_validation">

                  </div>
            </form>
           


            </div>

        </div>
        <?php
if (isset($_SESSION['message_password'])) {
    $message_password = $_SESSION['message_password'];
    unset($_SESSION['message_password']);
} else {
  $message_password = '';
}
?>
<div id="popup_2" class="popup <?= !empty($message_password) ? '' : 'hidden'; ?>" data-message="<?= htmlspecialchars($message_password); ?>">
    <p></p>
</div>


        
        <?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
} else {
    $message = '';
}
?>

<div id="popup" class="popup <?= !empty($message) ? '' : 'hidden'; ?>" data-message="<?= htmlspecialchars($message); ?>">
    <p></p>
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
    <script src="assets/js/user.js"></script>
    <script src="assets/js/popup.js"></script>
    <script src="assets/js/login.js"></script>
    <script src="assets/js/search.js"></script>
    <script src="assets/js/cart_counter.js"></script>
</body>
</html>