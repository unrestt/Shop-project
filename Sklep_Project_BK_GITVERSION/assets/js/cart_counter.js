document.addEventListener('DOMContentLoaded', function() {
    function updateCartCircle() {
        fetch('get_cart_count.php') // Ścieżka do skryptu PHP
            .then(response => response.text())
            .then(cartCount => {
                cartCount = parseInt(cartCount); // Zamienia wynik na liczbę
                const circleCart = document.getElementById('circle-cart');
                const circleNumber = document.getElementById('circle-number');

                if (cartCount > 0) {
                    circleCart.style.display = 'block'; // Pokaż element
                    circleNumber.textContent = cartCount; // Ustaw liczbę przedmiotów
                } else {
                    circleCart.style.display = 'none'; // Ukryj element, jeśli brak przedmiotów
                }
            })
            .catch(error => {
                console.error('Błąd podczas pobierania liczby przedmiotów w koszyku:', error);
            });
    }

    // Wywołaj funkcję przy ładowaniu strony
    updateCartCircle();

    // Możesz wywoływać tę funkcję również po aktualizacjach koszyka
});
