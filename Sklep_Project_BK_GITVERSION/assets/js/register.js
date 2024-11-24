var formPassword_register = document.getElementById("register_form");
var passwordButton_register = document.getElementById("button_register");
var passwordInfo_register = document.getElementById('register-message');

const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

const validatePasswords = () => {
    const Register_Password = document.querySelector('input[name="password"]').value;
    
    passwordInfo_register.textContent = ""; // Wyczyść poprzednie błędy

    let errors_register = [];

    // Sprawdzenie długości hasła
    if (Register_Password.length < 8) {
        errors_register.push("Hasło musi zawierać min. 8 znaków.");
    }
    
    // Sprawdzenie dużej litery
    if (!/[A-Z]/.test(Register_Password)) {
        errors_register.push("Hasło musi zawierać dużą literę.");
    }
    
    // Sprawdzenie cyfry
    if (!/\d/.test(Register_Password)) {
        errors_register.push("Hasło musi zawierać cyfrę.");
    }

    // Sprawdzenie znaku specjalnego
    if (!/[@$!%*?&]/.test(Register_Password)) {
        errors_register.push("Hasło musi zawierać znak specjalny.");
    }

    // Wyświetlenie błędów
    if (errors_register.length > 0) {
        // Dla każdego błędu generujemy nowy element <p>
        errors_register.forEach(error => {
            const errorParagraph = document.createElement('p'); // Tworzymy element <p>
            errorParagraph.textContent = error; // Ustawiamy tekst błędu
            passwordInfo_register.appendChild(errorParagraph); // Dodajemy element <p> do kontenera
        });

        // Dodajemy animację z opóźnieniem
        setTimeout(() => {
            passwordInfo_register.classList.add('show');
        }, 10); 
        
        return false;
    }
    
    return true;
};

// Nasłuchiwanie na zdarzenia 'input' dla pól hasła
document.querySelector('input[name="password"]').addEventListener('input', validatePasswords);

// Nasłuchiwanie na kliknięcie przycisku 'Zapisz'
passwordButton_register.addEventListener('click', function(event) {
    console.log("Zapisz kliknięty");
    event.preventDefault(); // Zatrzymanie domyślnego wysyłania formularza

    if (validatePasswords()) { // Sprawdź, czy wszystkie hasła są poprawne
        formPassword_register.submit(); // Jeśli nie ma błędów, wyślij formularz
    }
});
