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
    <div id="slider">
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
              <div class="swiper-slide">
                <div class="swipers">
                  <div class="swiper-left">
                    <div class="title" data-swiper-parallax="-200">Nike Air Force 1</div>
                    <div class="text" data-swiper-parallax="-100">
                      <p>Nike Air Force 1 to ikoniczne buty, które łączą sportową funkcjonalność z miejskim stylem. Wyposażone w amortyzację Air, zapewniają komfort i wsparcie na co dzień. Klasyczny design i uniwersalny wygląd sprawiają, że są idealnym wyborem zarówno do sportu, jak i casualowych stylizacji.</p>
                    </div>
                  </div>
                  <div class="swiper-right">
                    <img src="assets/images/slider_images/1.png" alt="but" data-swiper-parallax="-300" class="image-swiper">
                  </div>
                </div>
               

              </div>
              <div class="swiper-slide">
                <div class="swipers">
                  <div class="swiper-left">
                    <div class="title" data-swiper-parallax="-200">Nike Air Jordan 4</div>
                    <div class="text" data-swiper-parallax="-100">
                      <p>Air Jordan 4 to ikoniczny model, łączący sportowy styl z ponadczasowym designem. Wykonane z najwyższej jakości materiałów, zapewniające maksymalną wygodę. Ich dynamiczny wygląd i kultowy status sprawiają, że są idealnym wyborem zarówno na boisko, jak i do codziennych stylizacji.</p>
                    </div>
                 
                  </div>
                  <div class="swiper-right">

                    <img src="assets/images/slider_images/2.png" alt="but" data-swiper-parallax="-300" class="image-swiper">
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="swipers">
                  <div class="swiper-left">
                    <div class="title" data-swiper-parallax="-200">Adidas Campus 00s</div>
                    <div class="text" data-swiper-parallax="-100">
                    <p>To klasyczne sneakersy o standardowym kroju, łączące ponadczasowy design z nowoczesnym komfortem. Sznurowany model z wysokiej jakości skóry zapewnia elegancki wygląd, a gumowa podeszwa gwarantuje doskonałą przyczepność, czyniąc je idealnymi do codziennych stylizacji.</p>
                    </div>
                  </div>
                  <div class="swiper-right">
                    <img src="assets/images/slider_images/3.png" alt="but" data-swiper-parallax="-300" class="image-swiper">
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="swipers">
                  <div class="swiper-left">
                    <div class="title" data-swiper-parallax="-200">Nike Dunk</div>
                    <div class="text" data-swiper-parallax="-100">
                      <p>Nike Dunk stworzone w latach 80. z myślą o koszykówce model, który potem zawładnął ulicami, powraca w wersji z efektowną cholewką w nowych połączeniach kolorystycznych. Klasyczny krój inspirowany koszykówką oraz wyściełany, niski kołnierz zapewniają wygodę i stylowy wygląd w każdej sytuacji.</p>
                    </div>
                  </div>
                  <div class="swiper-right">
                    <img src="assets/images/slider_images/4.png" alt="but" data-swiper-parallax="-300" class="image-swiper">
                  </div>
                </div>
              </div>
              <div class="swiper-slide">
                <div class="swipers">
                  <div class="swiper-left">
                    <div class="title" data-swiper-parallax="-200">Nike Air Max<br> Up Tempo</div>
                    <div class="text" data-swiper-parallax="-100">
                      <p>Nike Air Max Up Tempo to buty w stylu koszykarskim inspirowane kultowymi trendami lat 90-tych. Idealne do noszenia na co dzień.</p>
                    </div>
                  </div>
                  <div class="swiper-right">
                    <img src="assets/images/slider_images/5.png" alt="but" data-swiper-parallax="-300" class="image-swiper">
                  </div>
                </div>
              </div>

          
            </div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-pagination"></div>
          </div>
    </div>
    <main>
      <section class="products">
        <div class="top-text">
          <p><b>POLECANE</b> PRODUKTY</p>
        </div>
        <div class="containers">
        <?php
$conn = new mysqli("localhost", "root", "", "kutnik_store");

if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

$query = $conn->prepare("SELECT id, firma, model, nazwa, cena, image_url_1 FROM items WHERE rekomendacja = 1");
$query->execute();

$result = $query->get_result();

while ($row = $result->fetch_assoc()) {
    $id = $row['id'];
    $firma = htmlspecialchars($row['firma']);
    $model = htmlspecialchars($row['model']);
    $nazwa = htmlspecialchars($row['nazwa']);
    $cena = number_format($row['cena'], 2, ',', ' ');
    $image_url = htmlspecialchars($row['image_url_1']);

    echo '
    <div class="container-box">
        <div class="container-box-image">
            <a href="produkt.php?id=' . $id . '"><img src="' . $image_url . '" alt="' . $nazwa . '"></a>
        </div>
        <p class="container-box-title"><b>' . $firma . ' ' . $model . '</b></p>
        <p class="container-box-price">' . $cena . ' zł</p>
    </div>';
}

$conn->close();
?>



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
    <script src="assets/js/search.js"></script>
    <script src="assets/js/slider.js"></script>
    <script src="assets/js/cart_counter.js"></script>
</body>
</html>