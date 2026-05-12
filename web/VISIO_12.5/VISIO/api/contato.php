<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../contato.html");
    exit;
}

$nome = trim($_POST["nome"] ?? "");
$email = trim($_POST["email"] ?? "");
$mensagem = trim($_POST["mensagem"] ?? "");

if ($nome === "|| $email === "|| $mensagem === "") {
    header("Location: ../contato.html?erro=campos");
    exit;
}

$arquivo = __DIR__ . "/../dados/mensagens.json";
$lista = [];
if (file_exists($arquivo)) {
    $lista = json_decode(file_get_contents($arquivo), true);
}
if (!is_array($lista)) {
    $lista = [];
}

$lista[] = [
    "data" => date("c"),
    "nome" => $nome,
    "email" => $email,
    "mensagem" => $mensagem,
];

file_put_contents($arquivo, json_encode($lista, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

header("Location: ../contato.html?enviado=1");
exit;
