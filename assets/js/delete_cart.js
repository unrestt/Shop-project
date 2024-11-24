var noItems = document.querySelector(".no-items");
var cartBelow = document.querySelector(".cart-below");
var cartText = document.querySelector(".cart-text");
var cartLine = document.querySelector(".cart-line");

if (noItems) {
    cartBelow.style.display = "none";
    cartText.style.display = "none";
}

document.querySelectorAll('.delete-cart-item').forEach(function(button) {
    button.addEventListener('click', function() {
        var itemId = this.getAttribute('data-item-id');
        var rozmiar = this.getAttribute('data-rozmiar');
        console.log(itemId);
        console.log(rozmiar);

        fetch('remove_cart.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                item_id: itemId,
                rozmiar: rozmiar
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                this.closest('.cart-box').remove(); // Usunięcie elementu koszyka
                
                const carts = document.querySelectorAll('.cart-box'); // Pobierz wszystkie elementy koszyka
                console.log(carts); // Sprawdź, czy w ogóle są elementy koszyka
                let totalPrice = 0;

                carts.forEach(function(e) {
                    const priceText = e.querySelector('.cart-box-prize p').textContent.replace(',',''); // Pobierz tekst ceny
                    console.log("Cena przed konwersją: ", priceText); // Konsoluj cenę przed konwersją
                    const price = parseFloat(priceText.replace('Zl', '').trim()); // Konwertuj tekst ceny na liczbę
                    console.log("Cena po konwersji: ", price); // Konsoluj cenę po konwersji

                    if (!isNaN(price)) { // Sprawdź, czy cena jest liczbą
                        totalPrice += price; // Dodaj do sumy, jeśli to liczba
                    }

                    console.log("Aktualna suma: ", totalPrice); // Konsoluj sumę
                });

                document.getElementById('total-price').innerHTML = "RAZEM: " + totalPrice.toFixed(2) + " ZŁ"; // Ustaw sumę w elemencie HTML
                window.location.reload();
                console.log("dsdad")
            } else {
                alert('Nie udało się usunąć produktu.');
            }
        })
        .catch(error => console.error('Błąd:', error));
    });


});


