const form = document.getElementById("formAdm");
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
    fetch("api/login_adm.php", {
        method: "POST",
        body: fd,
        credentials: "same-origin"
    })
        .then(function (r) {
            return r.json();
        })
        .then(function (data) {
            if (data.ok) {
                window.location.href = "inicio_adm.html";
            } else {
                alert(data.mensagem || "Credenciais inválidas.");
            }
        })
        .catch(function () {
            alert("Erro de rede. Verifique se o servidor PHP está ativo.");
        });
});
