const form = document.getElementById("form");
const inputEmail = document.getElementById("email");
const inputSenha = document.getElementById("senha");
const erroEmail = document.getElementById("erroEmail");
const erroSenha = document.getElementById("erroSenha");

form.addEventListener("submit", function (event) {
    event.preventDefault();
    let formValido = true;

    if (inputEmail.value.trim() === "") {
        erroEmail.innerText = "O email é obrigatório";
        inputEmail.classList.add("input-error"); inputEmail.classList.remove("input-valid");
        formValido = false;
    } else {
        erroEmail.innerText = "";
        inputEmail.classList.remove("input-error"); inputEmail.classList.add("input-valid");
    }

    if (inputSenha.value.trim() === "") {
        erroSenha.innerText = "A senha é obrigatória";
        inputSenha.classList.add("input-error"); inputSenha.classList.remove("input-valid");
        formValido = false;
    } else {
        erroSenha.innerText = "";
        inputSenha.classList.remove("input-error"); inputSenha.classList.add("input-valid");
    }

    if (!formValido) {
        alert("Por favor, corrija os erros no formulário antes de enviar.");
        return;
    }

    const fd = new FormData(form);
    fetch("api/login.php", {
        method: "POST",
        body: fd,
        credentials: "same-origin"
    })
        .then(function (r) {
            return r.json();
        })
        .then(function (data) {
            if (data.ok) {
                window.location.href = "index.html?login=ok";
            } else {
                alert(data.mensagem || "Não foi possível entrar.");
            }
        })
        .catch(function () {
            alert("Erro de rede. Verifique se o servidor PHP está ativo.");
        });
});
