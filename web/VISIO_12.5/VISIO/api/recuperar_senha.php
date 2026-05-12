<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../senha.html");
    exit;
}

$email = trim($_POST["email"] ?? "");
if ($email === "") {
    header("Location: ../senha.html?erro=1");
    exit;
}

$arquivo = __DIR__ . "/../dados/recuperacoes_senha.json";
$lista = [];
if (file_exists($arquivo)) {
    $lista = json_decode(file_get_contents($arquivo), true);
}
if (!is_array($lista)) {
    $lista = [];
}

$lista[] = [
    "data" => date("c"),
    "email" => $email,
    "observacao" => "Pedido registrado (demonstração — sem envio real de e-mail).",
];

file_put_contents($arquivo, json_encode($lista, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

header("Location: ../senha.html?enviado=1");
exit;
