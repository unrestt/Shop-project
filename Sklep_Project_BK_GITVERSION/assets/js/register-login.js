var PasswordVisionChange = document.getElementById("password_view_change");
var passwordInput = document.getElementById("password_input");

// Listener na kliknięcie ikony
PasswordVisionChange.addEventListener("click", () => {
  // Sprawdzenie aktualnego typu inputa
  if (passwordInput.type === "password") {
    passwordInput.type = "text"; // Zmieniamy na widoczne hasło
    PasswordVisionChange.classList.remove("fa-eye-slash"); // Zmieniamy ikonę na zamknięte oko
    PasswordVisionChange.classList.add("fa-eye");
  } else {
    passwordInput.type = "password"; // Zmieniamy na gwiazdkowane hasło
    PasswordVisionChange.classList.remove("fa-eye"); // Zmieniamy ikonę na otwarte oko
    PasswordVisionChange.classList.add("fa-eye-slash");
  }
});