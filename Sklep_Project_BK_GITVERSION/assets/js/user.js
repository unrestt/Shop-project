const userButtons = document.querySelectorAll(".user-single-option");
const mojeKonto = document.querySelector(".user-profile-mojeKonto");
const daneKontaktowe = document.querySelector(".user-profile-daneKontaktowe");
const zamowienia = document.querySelector(".user-profile-zamowienia");
const zmienHaslo = document.querySelector(".user-profile-zmienHaslo");
const userInfChange = document.querySelector(".change-button");

const hideAllSections = () => {
    mojeKonto.style.display = "none";
    daneKontaktowe.style.display = "none";
    zamowienia.style.display = "none";
    zmienHaslo.style.display = "none";
};

hideAllSections();
mojeKonto.style.display = "block";

userButtons[0].addEventListener("click", () => {
    hideAllSections();
    mojeKonto.style.display = "block";
});
userButtons[1].addEventListener("click", () => {
    hideAllSections();
    daneKontaktowe.style.display = "block";
});
userButtons[2].addEventListener("click", () => {
    hideAllSections();
    zamowienia.style.display = "block";
});
userButtons[3].addEventListener("click", () => {
    hideAllSections();
    zmienHaslo.style.display = "block";
});

userInfChange.addEventListener("click", ()=>{
    hideAllSections();
    daneKontaktowe.style.display = "block";
});

var formPassword = document.getElementById("password-form");
var passwordButton = document.getElementById("password_button");
var passwordInfo = document.querySelector('#password_validation');

const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;


const validatePasswords = () => {
    const actualPassword = document.querySelector('input[name="actual_password"]').value;
    const newPassword1 = document.querySelector('input[name="new_password_1"]').value;
    const newPassword2 = document.querySelector('input[name="new_password_2"]').value;
    

    passwordInfo.textContent = "";

    let errors = [];

    if (newPassword1.length < 8) {
        errors.push("Hasło musi zawierać min. 8 znaków.");
    }
    

    if (!/[A-Z]/.test(newPassword1)) {
        errors.push("Hasło musi zawierać dużą literę.");
    }
    

    if (!/\d/.test(newPassword1)) {
        errors.push("Hasło musi zawierać cyfrę.");
    }


    if (!/[@$!%*?&]/.test(newPassword1)) {
        errors.push("Hasło musi zawierać znak specjalny.");
    }


    if (newPassword1 !== newPassword2) {
        errors.push("Nowe hasła nie są takie same.");
    }


    if (errors.length > 0) {
        passwordInfo.innerHTML = errors.join("<br>");
        return false;
    }
    


    return true;
};



document.querySelector('input[name="new_password_1"]').addEventListener('input', validatePasswords);
document.querySelector('input[name="new_password_2"]').addEventListener('input', validatePasswords);


passwordButton.addEventListener('click', function(event) {
    console.log("Zapisz kliknięty");
    event.preventDefault();
    if (validatePasswords()) {
        formPassword.submit();
    }
});


var nieMaszZamowien = document.getElementById("nie-masz-zamowien");
var zamowienie = document.querySelector(".zamowienie");

if (nieMaszZamowien && !zamowienie) {
    nieMaszZamowien.style.borderRight = "none";
    nieMaszZamowien.style.borderTop = "none";
    nieMaszZamowien.style.borderLeft = "none";
    nieMaszZamowien.style.paddingLeft = "0";
}



