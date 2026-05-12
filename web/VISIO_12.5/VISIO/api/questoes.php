<?php
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: GET, POST, DELETE, UPDATE, PATCH");

$metodo = $_SERVER["REQUEST_METHOD"];

// Verifica se é um UPDATE disfarçado de POST (usado no JavaScript)
if ($metodo === "POST" && isset($_POST["_method"])) {
    $metodo = strtoupper($_POST["_method"]);
} elseif ($metodo === "POST" && isset($_POST["id"]) && !empty($_POST["id"])) {
    // Se enviou um ID por POST, assumimos automaticamente que é uma edição (UPDATE)
    $metodo = "UPDATE";
}

$arquivo = __DIR__ . "/../dados/questoes.json";

// Cria a pasta se não existir
if (!is_dir(__DIR__ . "/../dados")) {
    mkdir(__DIR__ . "/../dados", 0777, true);
}

// Cria o ficheiro JSON se não existir
if (!file_exists($arquivo)) {
    file_put_contents($arquivo, json_encode([]));
}

$questoes = json_decode(file_get_contents($arquivo), true);
if (!is_array($questoes)) {
    $questoes = [];
}

// LER (GET)
if ($metodo == "GET") {
    http_response_code(200);
    echo json_encode(array_values($questoes), JSON_UNESCAPED_UNICODE);
    exit;
}

// CRIAR NOVA QUESTÃO (POST)
if ($metodo == "POST") {
    $nova = [
        "id" => time() . rand(100, 999), // Gera ID único
        "descricao" => trim($_POST["descricao"] ?? ""),
        "nivel" => trim($_POST["nivel"] ?? "Fácil"),
        "alternativas" => [
            ["texto" => trim($_POST["alt_a"] ?? ""), "correta" => (strtolower(trim($_POST["correta"] ?? "a")) === "a")],
            ["texto" => trim($_POST["alt_b"] ?? ""), "correta" => (strtolower(trim($_POST["correta"] ?? "a")) === "b")],
            ["texto" => trim($_POST["alt_c"] ?? ""), "correta" => (strtolower(trim($_POST["correta"] ?? "a")) === "c")],
            ["texto" => trim($_POST["alt_d"] ?? ""), "correta" => (strtolower(trim($_POST["correta"] ?? "a")) === "d")]
        ]
    ];
    $questoes[] = $nova;
    file_put_contents($arquivo, json_encode(array_values($questoes), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    http_response_code(201);
    echo json_encode($nova);
    exit;
}

// EDITAR QUESTÃO (UPDATE)
if ($metodo == "UPDATE" || $metodo == "PATCH") {
    $id = trim($_POST["id"] ?? "");
    $atualizou = false;

    foreach ($questoes as $i => $q) {
        if ((string) $q["id"] === (string) $id) {
            if (isset($_POST["descricao"]))
                $questoes[$i]["descricao"] = trim($_POST["descricao"]);
            if (isset($_POST["nivel"]))
                $questoes[$i]["nivel"] = trim($_POST["nivel"]);

            $correta = strtolower(trim($_POST["correta"] ?? "a"));

            if (isset($_POST["alt_a"]))
                $questoes[$i]["alternativas"][0]["texto"] = trim($_POST["alt_a"]);
            if (isset($_POST["alt_b"]))
                $questoes[$i]["alternativas"][1]["texto"] = trim($_POST["alt_b"]);
            if (isset($_POST["alt_c"]))
                $questoes[$i]["alternativas"][2]["texto"] = trim($_POST["alt_c"]);
            if (isset($_POST["alt_d"]))
                $questoes[$i]["alternativas"][3]["texto"] = trim($_POST["alt_d"]);

            $questoes[$i]["alternativas"][0]["correta"] = ($correta === "a");
            $questoes[$i]["alternativas"][1]["correta"] = ($correta === "b");
            $questoes[$i]["alternativas"][2]["correta"] = ($correta === "c");
            $questoes[$i]["alternativas"][3]["correta"] = ($correta === "d");

            $atualizou = true;
            $retorno = $questoes[$i];
            break;
        }
    }

    if ($atualizou) {
        file_put_contents($arquivo, json_encode(array_values($questoes), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        http_response_code(200);
        echo json_encode($retorno);
    } else {
        http_response_code(404);
        echo json_encode(["mensagem" => "Questão não encontrada para edição."]);
    }
    exit;
}

// APAGAR QUESTÃO (DELETE)
if ($metodo == "DELETE") {
    $id = trim($_POST["id"] ?? "");
    $removido = false;

    foreach ($questoes as $i => $q) {
        if ((string) $q["id"] === (string) $id) {
            unset($questoes[$i]);
            $removido = true;
            break;
        }
    }

    if ($removido) {
        file_put_contents($arquivo, json_encode(array_values($questoes), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        http_response_code(200);
        echo json_encode(["mensagem" => "Questão apagada com sucesso."]);
    } else {
        http_response_code(404);
        echo json_encode(["mensagem" => "Questão não encontrada."]);
    }
    exit;
}

http_response_code(405);
exit;