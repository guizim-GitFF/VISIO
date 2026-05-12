<?php
$arquivo = __DIR__ . "/dados/mensagens.json";
$mensagens = [];

if (file_exists($arquivo)) {
    $mensagens = json_decode(file_get_contents($arquivo), true);
}

if (!is_array($mensagens)) {
    $mensagens = [];
}

// Ordena da mais recente para a mais antiga
usort($mensagens, function ($a, $b) {
    return strtotime($b["data"] ?? "") - strtotime($a["data"] ?? "");
});

// Função de segurança
function e($valor) {
    return htmlspecialchars((string)$valor, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Mensagens — VISIO ADM</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body>
    <header>
        <nav>
            <img src="assets/Marca/Logo/LogoDark.jpg"class="logo" alt="Logo VISIO" id="logo">
            <ul class="nav-links">
                <li><a href="inicio_adm.html"><i class="fa-solid fa-house"></i> Início</a></li>
                <li><a href="perfil_adm.html"><i class="fa-solid fa-user"></i> Perfil</a></li>
                <li><a href="index.html"><i class="fa-solid fa-right-from-bracket"></i> Sair</a></li>
                <button id="theme-toggle">
                    <i id="icon-sun" class="fa-solid fa-sun"></i>
                    <i id="icon-moon" class="fa-solid fa-moon"></i>
                </button>
            </ul>
        </nav>
    </header>
    <div class="app-container">
        <aside class="sidebar">
            <nav class="menu">
                <ul>
                    <li><a href="inicio_adm.html"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                    <li><a href="lista.php"><i class="fa-solid fa-users"></i> Usuários</a></li>
                    <li><a href="cadastrar_questoes_adm.html"><i class="fa-solid fa-clipboard-list"></i> Questões</a>
                    </li>
                    <li><a href="cadastrar_sensor_ADM.html"><i class="fa-solid fa-microchip"></i> Sensores</a></li>
                    <li><a href="mensagem_adm.php" class="active"><i class="fa-solid fa-message"></i>Mensagem</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">

            <h1>Mensagens recebidas</h1>

            <?php if (empty($mensagens)): ?>
            <p>Nenhuma mensagem encontrada.</p>
            <?php else: ?>

            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Mensagem</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($mensagens as $msg): ?>
                        <tr>
                            <td>
                                <?= e(date("d/m/Y H:i", strtotime($msg["data"] ?? ""))) ?>
                            </td>
                            <td>
                                <?= e($msg["nome"] ?? "") ?>
                            </td>
                            <td>
                                <?= e($msg["email"] ?? "") ?>
                            </td>
                            <td class="mensagem-cell">
                                <?= nl2br(e($msg["mensagem"] ?? "")) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php endif; ?>

        </main>

    </div>

    <footer>
        &copy; 2026 VISIO – Plataforma Inteligente para Sensores IoT.
    </footer>

    <script src="JS/theme.js"></script>
</body>

</html>