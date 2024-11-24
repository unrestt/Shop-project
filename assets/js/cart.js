const cartline = document.querySelector(".cart-line");
const cartlineNoItems = document.querySelector(".cart-line-no-items");

// Sprawdzanie obecności ciupaga w cartline
const boxesCartline = cartline.querySelectorAll("cart-box");
if (ciupagaInCartline) {
    console.log("Element ciupaga znajduje się w cartline.");
} else {
    console.log("Element ciupaga nie znajduje się w cartline.");
}

// Sprawdzanie obecności ciupaga w cartlineNoItems
const ciupagaInCartlineNoItems = cartlineNoItems.querySelector(".ciupaga");
if (ciupagaInCartlineNoItems) {
    console.log("Element ciupaga znajduje się w cartlineNoItems.");
} else {
    console.log("Element ciupaga nie znajduje się w cartlineNoItems.");
}
