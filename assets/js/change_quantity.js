document.addEventListener('DOMContentLoaded', function() {
    // Obsługuje kliknięcia na przycisk minus
    document.querySelectorAll('.cart-char-minus').forEach(function(button) {
        button.addEventListener('click', function() {
            const cartBox = button.closest('.cart-box');
            const itemId = cartBox.dataset.itemId;
            const rozmiar = cartBox.dataset.rozmiar;
            let quantity = parseInt(cartBox.querySelector('.cart-quantity').textContent);

            if (quantity > 1) {
                quantity--;
                cartBox.querySelector('.cart-quantity').textContent = quantity;
                updateCart(itemId, rozmiar, quantity);
            }
        });
    });

    // Obsługuje kliknięcia na przycisk plus
    document.querySelectorAll('.cart-char-plus').forEach(function(button) {
        button.addEventListener('click', function() {
            const cartBox = button.closest('.cart-box');
            const itemId = cartBox.dataset.itemId;
            const rozmiar = cartBox.dataset.rozmiar;
            let quantity = parseInt(cartBox.querySelector('.cart-quantity').textContent);

            quantity++;
            cartBox.querySelector('.cart-quantity').textContent = quantity;
            updateCart(itemId, rozmiar, quantity);
        });
    });

    function updateCart(itemId, rozmiar, newQuantity) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'quantity_cart.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log('Koszyk zaktualizowany:', xhr.responseText);
                    location.reload(); // Odświeża stronę po aktualizacji koszyka
                } else {
                    console.error('Błąd podczas aktualizacji koszyka:', xhr.statusText);
                }
            }
        };
        xhr.send(`itemId=${encodeURIComponent(itemId)}&rozmiar=${encodeURIComponent(rozmiar)}&newQuantity=${encodeURIComponent(newQuantity)}`);
    }
});
