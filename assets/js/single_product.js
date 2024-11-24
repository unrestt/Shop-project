

const sizes = document.querySelectorAll('.single-size');

sizes.forEach(size => {
    size.addEventListener('click', () => {
        sizes.forEach(s => s.classList.remove('selected'));

        size.classList.add('selected');

    });
});


let selectedSizeInput = document.getElementById('selected-size');
sizes.forEach(size => {
    size.addEventListener('click', function() {
        // Ustaw wybrany rozmiar w ukrytym input
        selectedSizeInput.value = this.getAttribute('data-size');
        
        // Zaznacz wybrany rozmiar, usuwając klasę active z innych
        sizes.forEach(s => s.classList.remove('active'));
        this.classList.add('active');
    });
});
function showPopup(id) {
    const popup = document.getElementById(id);
    const message = popup.getAttribute("data-message"); // Pobierz wiadomość z atrybutu
    if (message) {
        popup.querySelector('p').textContent = message; // Ustaw treść pop-up
        popup.classList.remove("hidden");
        setTimeout(() => {
            popup.classList.add("visible");
        }, 10);

        setTimeout(() => {
            popup.classList.add("fade-out");
            setTimeout(() => {
                popup.classList.remove("visible", "fade-out");
                popup.classList.add("hidden");
            }, 500);
        }, 3000);
    }
}

const form = document.getElementById('produkt_form');

form.addEventListener('submit', function(event) {
    if (!selectedSizeInput.value) {
        event.preventDefault();
        showPopup("popup_size");
    }
});



const bigImage = document.getElementById('bigImage');
const smallImages = document.querySelectorAll('.small-image');

smallImages.forEach(smallImage => {
    smallImage.addEventListener('click', () => {

        bigImage.src = smallImage.src;

        smallImages.forEach(img => img.style.border = 'none');

        smallImage.style.border = '1px solid #000';
    });
});



const colorImages = document.querySelectorAll('.color-image');
colorImages.forEach(smallImage => {
    smallImage.addEventListener('click', () => {

        colorImages.forEach(img => img.style.border = 'none');

        smallImage.style.border = '1px solid #000';
    });
});


const tabela = document.getElementById("tabela");
const modal = document.getElementById("modal");

const closeButton = document.querySelector(".close-button");

// Pokazuje modal po kliknięciu na tabelę
tabela.addEventListener("click", () => {
    modal.style.display = "flex";
});

// Zamykamy modal po kliknięciu w przycisk zamknięcia
closeButton.addEventListener("click", () => {
    modal.style.display = "none";
});

// Opcjonalnie zamykamy modal, klikając poza jego zawartością
window.addEventListener("click", (event) => {
    if (event.target === modal) {
        modal.style.display = "none";
    }
});



// Ustawienie początkowej wartości licznika
let quantity = 1;
const quantityDisplay = document.getElementById("licznik");
const hiddenQuantityInput = document.getElementById("hidden-quantity");

// Funkcje do zwiększania i zmniejszania ilości
document.getElementById("dec").addEventListener("click", function () {
    if (quantity > 1) {
        quantity--;
        updateQuantity();
    }
});

document.getElementById("inc").addEventListener("click", function () {
    quantity++;
    updateQuantity();
});

// Funkcja aktualizująca wyświetlaną ilość i ukryte pole
function updateQuantity() {
    quantityDisplay.innerText = quantity;
    hiddenQuantityInput.value = quantity;
}


window.onload = function() {
    setTimeout(function() {
        document.getElementById("popup-message").style.display = "none";
    }, 3000); // Zniknie po 3 sekundach
};



// Funkcja do pokazywania show boxa
function showCartBox() {
    const showBox = document.getElementById('show_box_cart');
    showBox.classList.remove('hidden');
}

// Funkcja do ukrywania show boxa
function hideCartBox() {
    const showBox = document.getElementById('show_box_cart');
    showBox.classList.add('hidden');
}

// Ustawienie obsługi przycisków
document.getElementById('continue_shopping').addEventListener('click', function() {
    hideCartBox();
});

document.getElementById('checkout').addEventListener('click', function() {
    window.location.href = 'koszyk.php'; // Przejdź do koszyk.php
});

// Zakładając, że dodawanie do koszyka odbywa się za pomocą formularza
document.getElementById('produkt_form').addEventListener('submit', function(event) {
    const rozmiarSelect = document.getElementById('rozmiar'); // Zmiana w zależności od identyfikatora
    if (!rozmiarSelect.value) {
        event.preventDefault(); // Zatrzymaj wysyłanie formularza
        return;
    }
    showCartBox(); // Pokaż show box po dodaniu do koszyka
});

// Sprawdzenie, czy komunikat o dodaniu do koszyka został ustawiony










