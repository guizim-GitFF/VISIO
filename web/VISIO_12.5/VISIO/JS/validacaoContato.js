const form = document.getElementById("form");
const inputNome = document.getElementById("nome");
const inputEmail = document.getElementById("email");
const inputMensagem = document.getElementById("mensagem");
const erroNome = document.getElementById("erroNome");
const erroEmail = document.getElementById("erroEmail");
const erroMensagem = document.getElementById("erroMensagem");

form.addEventListener("submit", function (event) {
    event.preventDefault();
    let formValido = true;

    if (inputNome.value.trim() === "") {
        erroNome.innerText = "O nome é obrigatório";
        inputNome.classList.add("input-error"); inputNome.classList.remove("input-valid");
        formValido = false;
    } else if (inputNome.value.trim().length < 3) {
        erroNome.innerText = "O nome deve ter pelo menos 3 caracteres";
        inputNome.classList.add("input-error"); inputNome.classList.remove("input-valid");
        formValido = false;
    } else {
        erroNome.innerText = "";
        inputNome.classList.remove("input-error"); inputNome.classList.add("input-valid");
    }

    const regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (inputEmail.value.trim() === "") {
        erroEmail.innerText = "O email é obrigatório";
        inputEmail.classList.add("input-error"); inputEmail.classList.remove("input-valid");
        formValido = false;
    } else if (!regexEmail.test(inputEmail.value)) {
        erroEmail.innerText = "Digite um email válido";
        inputEmail.classList.add("input-error"); inputEmail.classList.remove("input-valid");
        formValido = false;
    } else {
        erroEmail.innerText = "";
        inputEmail.classList.remove("input-error"); inputEmail.classList.add("input-valid");
    }

    if (inputMensagem.value.trim() === "") {
        erroMensagem.innerText = "A mensagem é obrigatória";
        inputMensagem.classList.add("input-error"); inputMensagem.classList.remove("input-valid");
        formValido = false;
    } else if (inputMensagem.value.trim().length < 10) {
        erroMensagem.innerText = "A mensagem deve ter pelo menos 10 caracteres";
        inputMensagem.classList.add("input-error"); inputMensagem.classList.remove("input-valid");
        formValido = false;
    } else {
        erroMensagem.innerText = "";
        inputMensagem.classList.remove("input-error"); inputMensagem.classList.add("input-valid");
    }

    if (!formValido) {
        alert("Por favor, corrija os erros antes de enviar.");
        return;
    }

    form.submit();
});
