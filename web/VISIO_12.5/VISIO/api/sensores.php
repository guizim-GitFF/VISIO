<?php
header("Access-Control-Allow-Methods: GET, POST, PATCH, DELETE");

$metodo = $_SERVER["REQUEST_METHOD"];

// Verifica se existe um método alternativo passado por POST ou GET
if ($metodo == "POST" && isset($_POST["_method"])) {
    $metodo = strtoupper($_POST["_method"]);
} elseif ($metodo == "POST" && isset($_GET["action"]) && $_GET["action"] == "update") {
    $metodo = "UPDATE";
}

$arquivo = "../dados/sensores.json";
$pasta_imagens = "../assets/images/Sensores/";

// Cria o ficheiro JSON se não existir
if (!file_exists($arquivo)) {
    if (!is_dir("../dados"))
        mkdir("../dados", 0777, true);
    file_put_contents($arquivo, json_encode([]));
}

// Cria a pasta de imagens se não existir
if (!is_dir($pasta_imagens)) {
    mkdir($pasta_imagens, 0777, true);
}

$sensores = json_decode(file_get_contents($arquivo), true);
if (!is_array($sensores)) {
    $sensores = [];
}

// --- FUNÇÃO PARA PROCESSAR O UPLOAD DA FOTO ---
function processarUploadFoto($ficheiro_upload)
{
    global $pasta_imagens;
    if (isset($ficheiro_upload) && $ficheiro_upload['error'] === UPLOAD_ERR_OK) {
        $extensao = pathinfo($ficheiro_upload['name'], PATHINFO_EXTENSION);
        $nome_novo = uniqid('sensor_') . '.' . $extensao;
        $caminho_destino = $pasta_imagens . $nome_novo;

        if (move_uploaded_file($ficheiro_upload['tmp_name'], $caminho_destino)) {
            return 'assets/images/Sensores/' . $nome_novo;
        }
    }
    return null;
}

// --- LER SENSORES (GET) ---
if ($metodo == "GET") {
    http_response_code(200);
    echo json_encode($sensores);
    exit;
}

// --- CADASTRAR NOVO SENSOR (POST) ---
if ($metodo == "POST") {
    $novo_sensor = [
        "id" => uniqid(),
        "nome" => trim($_POST["nome"] ?? ""),
        "descricao" => trim($_POST["descricao"] ?? ""),
        "circuito" => trim($_POST["circuito"] ?? "")
    ];

    $caminho_foto = processarUploadFoto($_FILES['foto'] ?? null);
    $novo_sensor["foto_url"] = $caminho_foto ? $caminho_foto : "";

    $sensores[] = $novo_sensor;
    file_put_contents($arquivo, json_encode(array_values($sensores), JSON_PRETTY_PRINT));

    http_response_code(201);
    echo json_encode($novo_sensor);
    exit;
}

// --- ATUALIZAR SENSOR (UPDATE) ---
if ($metodo == "UPDATE" || $metodo == "PATCH") {
    $id = trim($_POST["id"] ?? "");
    $atualizado = false;

    foreach ($sensores as $indice => $sensor) {
        // CORREÇÃO AQUI: Mudado de === para == (Ignora se é texto ou número)
        if ($sensor["id"] == $id) {
            if (isset($_POST["nome"]))
                $sensores[$indice]["nome"] = trim($_POST["nome"]);
            if (isset($_POST["descricao"]))
                $sensores[$indice]["descricao"] = trim($_POST["descricao"]);
            if (isset($_POST["circuito"]))
                $sensores[$indice]["circuito"] = trim($_POST["circuito"]);

            $nova_foto = processarUploadFoto($_FILES['foto'] ?? null);
            if ($nova_foto) {
                // Remove a foto antiga para não ocupar espaço
                if (!empty($sensor["foto_url"]) && file_exists("../" . $sensor["foto_url"])) {
                    @unlink("../" . $sensor["foto_url"]);
                }
                $sensores[$indice]["foto_url"] = $nova_foto;
            }

            $atualizado = true;
            $sensor_retorno = $sensores[$indice];
            break;
        }
    }

    if ($atualizado) {
        file_put_contents($arquivo, json_encode(array_values($sensores), JSON_PRETTY_PRINT));
        http_response_code(200);
        echo json_encode($sensor_retorno);
    } else {
        http_response_code(404);
        echo json_encode(["mensagem" => "Sensor não encontrado para edição."]);
    }
    exit;
}

// --- APAGAR SENSOR (DELETE) ---
if ($metodo == "DELETE") {
    $id = trim($_POST["id"] ?? "");
    $removido = false;

    foreach ($sensores as $indice => $sensor) {
        // CORREÇÃO AQUI: Mudado de === para ==
        if ($sensor["id"] == $id) {
            // Apaga a imagem fisicamente do servidor (limpeza)
            if (!empty($sensor["foto_url"]) && file_exists("../" . $sensor["foto_url"])) {
                @unlink("../" . $sensor["foto_url"]); // O @ evita erros se o ficheiro já não existir
            }

            unset($sensores[$indice]);
            $removido = true;
            break;
        }
    }

    if ($removido) {
        file_put_contents($arquivo, json_encode(array_values($sensores), JSON_PRETTY_PRINT));
        http_response_code(200);
        echo json_encode(["mensagem" => "Sensor apagado com sucesso."]);
    } else {
        http_response_code(400);
        echo json_encode(["mensagem" => "Erro ao apagar ou sensor não encontrado."]);
    }
    exit;
}

http_response_code(405);
exit;
?>