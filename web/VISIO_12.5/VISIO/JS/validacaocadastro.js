const form = document.getElementById("form");

const cpf = document.getElementById("cpf");
const email = document.getElementById("email");
const data = document.getElementById("data_nascimento");
const telefone = document.getElementById("telefone");
const senha = document.getElementById("senha");

const erroCpf = document.getElementById("erroCpf");
const erroEmail = document.getElementById("erroEmail");
const erroData = document.getElementById("erroDataNascimento");
const erroTelefone = document.getElementById("erroTelefone");
const erroSenha = document.getElementById("erroSenha");


// VALIDAÇÃO
form.addEventListener("submit", function (e) {

    let valido = true;

    // CPF
    if (cpf.value.trim() === "") {
        erroCpf.innerText = "CPF obrigatório";
        cpf.classList.add("input-error"); cpf.classList.remove("input-valid");
        valido = false;
    } else {
        erroCpf.innerText = "";
        cpf.classList.remove("input-error"); cpf.classList.add("input-valid");
    }

    // EMAIL
    if (email.value.trim() === "") {
        erroEmail.innerText = "Email obrigatório";
        email.classList.add("input-error"); email.classList.remove("input-valid");
        valido = false;
    } else {
        erroEmail.innerText = "";
        email.classList.remove("input-error"); email.classList.add("input-valid");
    }

    // DATA
    if (data.value.trim() === "") {
        erroData.innerText = "Data obrigatória";
        data.classList.add("input-error"); data.classList.remove("input-valid");
        valido = false;
    } else {
        erroData.innerText = "";
        data.classList.remove("input-error"); data.classList.add("input-valid");
    }

    // TELEFONE
    if (telefone.value.trim() === "") {
        erroTelefone.innerText = "Telefone obrigatório";
        telefone.classList.add("input-error"); telefone.classList.remove("input-valid");
        valido = false;
    } else {
        erroTelefone.innerText = "";
        telefone.classList.remove("input-error"); telefone.classList.add("input-valid");
    }

    // SENHA
    if (senha.value.trim() === "") {
        erroSenha.innerText = "Senha obrigatória";
        senha.classList.add("input-error"); senha.classList.remove("input-valid");
        valido = false;
    } else {
        erroSenha.innerText = "";
        senha.classList.remove("input-error"); senha.classList.add("input-valid");
    }

    if (!valido) {
        e.preventDefault();
    }

});
/* CPF */
cpf.addEventListener("input", function () {
    let valor = cpf.value;
    valor = valor.replace(/\D/g, "");
    if (valor.length > 11) {
        valor = valor.slice(0, 11);
    }

    if (valor.length > 9) {
        valor = valor.slice(0, 3) + "." + valor.slice(3, 6) + "." + valor.slice(6, 9) + "-" + valor.slice(9);
    }
    else if (valor.length > 6) {
        valor = valor.slice(0, 3) + "." + valor.slice(3, 6) + "." + valor.slice(6);
    }
    else if (valor.length > 3) {
        valor = valor.slice(0, 3) + "." + valor.slice(3);
    }

    cpf.value = valor;

});

/* TELEFONE */
telefone.addEventListener("input", function () {
    let valor = telefone.value;
    valor = valor.replace(/\D/g, "");
    if (valor.length > 11) {
        valor = valor.slice(0, 11);
    }
    if (valor.length > 10) {
        valor = "(" + valor.slice(0, 2) + ") " + valor.slice(2, 7) + "-" + valor.slice(7);
    }
    else if (valor.length > 6) {
        valor = "(" + valor.slice(0, 2) + ") " + valor.slice(2, 6) + "-" + valor.slice(6);
    }
    else if (valor.length > 2) {
        valor = "(" + valor.slice(0, 2) + ") " + valor.slice(2);
    }
    else if (valor.length > 0) {
        valor = "(" + valor;
    }
    telefone.value = valor;
});

/* DATA DE NASCIMENTO */
data.addEventListener("input", function () {
    let valor = data.value;
    valor = valor.replace(/\D/g, "");
    if (valor.length > 8) {
        valor = valor.slice(0, 8);
    }
    if (valor.length > 4) {
        valor = valor.slice(0, 2) + "/" + valor.slice(2, 4) + "/" + valor.slice(4);
    }
    else if (valor.length > 2) {
        valor = valor.slice(0, 2) + "/" + valor.slice(2);
    }
    data.value = valor;
});