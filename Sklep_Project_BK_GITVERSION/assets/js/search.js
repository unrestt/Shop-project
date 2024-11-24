const searchIcon = document.getElementById('search-icon');
const mobileSearchContainer = document.getElementById('mobile-search-container');
const searchResult = document.getElementById("search-results");

// Funkcja do obsługi kliknięcia tylko przy szerokości ekranu <= 650px
function toggleMobileSearch() {
    if (window.matchMedia("(max-width: 650px)").matches) {
        // Sprawdź, czy kontener jest widoczny
        if (mobileSearchContainer.classList.contains('show')) {
            // Ukryj kontener
            mobileSearchContainer.classList.remove('show');
            setTimeout(() => {
                mobileSearchContainer.style.display = "none"; // Wyłącz całkowicie po animacji
            }, 300); // Czas odpowiadający długości animacji
        } else {
            mobileSearchContainer.style.display = "block";
            setTimeout(() => {
                mobileSearchContainer.classList.add('show');
            }, 10); // Krótkie opóźnienie, aby display zmienił się na block
        }
    }
}

// Nasłuchiwanie kliknięcia na ikonę szukania
searchIcon.addEventListener('click', toggleMobileSearch);

// Funkcja do zamykania kontenera, gdy kliknięcie jest poza nim
document.addEventListener('click', function(event) {
    const isClickInside = searchIcon.contains(event.target) || mobileSearchContainer.contains(event.target);
    
    if (!isClickInside && window.matchMedia("(max-width: 650px)").matches) {
        // Jeśli kliknięcie jest poza wyszukiwaniem, ukryj kontener
        mobileSearchContainer.classList.remove('show');
        setTimeout(() => {
            mobileSearchContainer.style.display = "none"; // Ukryj całkowicie po animacji
        }, 300);
    }
});

// Ukrycie mobileSearchContainer, jeśli szerokość okna przekroczy 650px
window.addEventListener('resize', function() {
    if (window.matchMedia("(min-width: 651px)").matches) {
        // Jeśli szerokość ekranu jest większa niż 650px, ukryj kontener wyszukiwania
        mobileSearchContainer.classList.remove('show');
        mobileSearchContainer.style.display = "none";
        searchResult.style.display = "none";
    }
});





function showResults(query) {
    if (query.length === 0) {
        document.getElementById("search-results").innerHTML = "";
        return;
    }

    const url = "search.php?q=" + encodeURIComponent(query);

    const xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            document.getElementById("search-results").innerHTML = xhr.responseText;
        }
    };
    xhr.send();
    const inputSearchBar = document.getElementById("search-input");
    const searchResult = document.getElementById("search-results");
    searchResult.style.display = 'block';


    document.onclick = function(event) {
        if (!searchResult.contains(event.target)) {
            searchResult.style.display = 'none';
        }
    };
    inputSearchBar.addEventListener("click", ()=>{
        inputSearchBar.innerHTML = "";
    })
}


