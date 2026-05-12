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

$arquivo = __DIR__ . "/../dados/usuarios.json";
if (!file_exists($arquivo)) {
    http_response_code(401);
    echo json_encode(["ok" => false, "mensagem" => "Credenciais inválidas"]);
    exit;
}

$usuarios = json_decode(file_get_contents($arquivo), true);
if (!is_array($usuarios)) {
    $usuarios = [];
}

foreach ($usuarios as $u) {
    if (isset($u["email"]) && strcasecmp($u["email"], $email) === 0) {
        $hash = $u["senha"] ?? "";
        if ($hash !== "" && password_verify($senha, $hash)) {
            $_SESSION["usuario_id"] = $u["id"] ?? null;
            $_SESSION["usuario_email"] = $u["email"];
            $_SESSION["usuario_cpf"] = $u["cpf"] ?? null;
            if (!empty($_POST["redirect_html"])) {
                header("Location: ../index.html?login=ok");
                exit;
            }
            echo json_encode(["ok" => true, "mensagem" => "Login realizado"]);
            exit;
        }
        break;
    }
}

http_response_code(401);
echo json_encode(["ok" => false, "mensagem" => "E-mail ou senha incorretos"]);
