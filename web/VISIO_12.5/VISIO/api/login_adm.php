<?php
session_start();
header("Content-Type: application/json; charset=utf-8");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["ok" => false, "mensagem" => "Use POST"]);
    exit;
}

$email = trim($_POST["email"] ?? "");
$senha = $_POST["senha"] ?? "";

if ($email === ""|| $senha === "") {
    http_response_code(400);
    echo json_encode(["ok" => false, "mensagem" => "E-mail e senha são obrigatórios"]);
    exit;
}

$arquivo = __DIR__ . "/../dados/admins.json";
if (!file_exists($arquivo)) {
    http_response_code(500);
    echo json_encode(["ok" => false, "mensagem" => "Configuração de administradores ausente"]);
    exit;
}

$admins = json_decode(file_get_contents($arquivo), true);
if (!is_array($admins)) {
    $admins = [];
}

foreach ($admins as $a) {
    if (!isset($a["email"])) {
        continue;
    }
    if (strcasecmp($a["email"], $email) !== 0) {
        continue;
    }
    $armazenada = $a["senha"] ?? "";
    if ($armazenada === "") {
        break;
    }
    $ok = false;
    if (strpos($armazenada, "$2y$") === 0) {
        $ok = password_verify($senha, $armazenada);
    } else {
        $ok = hash_equals($armazenada, $senha);
    }
    if ($ok) {
        $_SESSION["admin_email"] = $a["email"];
        $_SESSION["admin_cnpj"] = $a["cnpj"] ?? null;
        if (!empty($_POST["redirect_html"])) {
            header("Location: ../inicio_adm.html");
            exit;
        }
        echo json_encode(["ok" => true, "mensagem" => "Login administrativo OK"]);
        exit;
    }
    break;
}

http_response_code(401);
echo json_encode(["ok" => false, "mensagem" => "Credenciais de administrador inválidas"]);
