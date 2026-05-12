<?php
$arquivo = __DIR__ . "/dados/usuarios.json";
$usuarios = [];
if (file_exists($arquivo)) {
    $usuarios = json_decode(file_get_contents($arquivo), true);
}
if (!is_array($usuarios)) {
    $usuarios = [];
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários — VISIO</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body>
    <header>
        <nav>
            <img src="assets/Marca/Logo/LogoDark.jpg" class="logo" alt="Logo VISIO" id="logo">
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
                    <li><a href="lista.php" class="active"><i class="fa-solid fa-users"></i> Usuários</a></li>
                    <li><a href="cadastrar_questoes_adm.html"><i class="fa-solid fa-clipboard-list"></i> Questões</a>
                    </li>
                    <li><a href="cadastrar_sensor_ADM.html"><i class="fa-solid fa-microchip"></i> Sensores</a></li>
                </ul>
            </nav>
        </aside>
        <main class="lista adm-main-area">
            <h1>Usuários cadastrados</h1>
            <?php if (!empty($_GET["atualizado"])): ?>
                <p class="lista-feedback ok">Dados atualizados com sucesso.</p>
            <?php elseif (!empty($_GET["removido"])): ?>
                <p class="lista-feedback ok">Usuário removido.</p>
            <?php endif; ?>
            <p class="lista-sub">Cartão IoT vinculado ao usuário. Edite os campos e clique em <strong>Salvar
                    alterações</strong>.</p>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th style="color: #fff;">ID</th>
                            <th style="color: #fff;">CPF</th>
                            <th style="color: #fff;">E-mail</th>
                            <th style="color: #fff;">Data de nascimento</th>
                            <th style="color: #fff;">Telefone</th>
                            <th style="color: #fff;">Cartão IoT</th>
                            <th style="color: #fff;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($usuarios) > 0): ?>
                            <?php foreach ($usuarios as $usuario): ?>
                                <?php
                                $uid = (int) ($usuario["id"] ?? 0);
                                $fid = "salvar-usuario-" . $uid;
                                $idEsc = htmlspecialchars((string) $uid, ENT_QUOTES, "UTF-8");
                                $cartaoVal = htmlspecialchars((string) ($usuario["cartao"] ?? ""), ENT_QUOTES, "UTF-8");
                                $emailVal = htmlspecialchars((string) ($usuario["email"] ?? ""), ENT_QUOTES, "UTF-8");
                                $telVal = htmlspecialchars((string) ($usuario["telefone"] ?? ""), ENT_QUOTES, "UTF-8");
                                ?>
                                <tr>
                                    <td><?= $idEsc ?></td>
                                    <td>
                                        <input form="<?= htmlspecialchars($fid, ENT_QUOTES, "UTF-8") ?>" type="text" name="cpf"
                                            value="<?= htmlspecialchars((string) ($usuario["cpf"] ?? ""), ENT_QUOTES, "UTF-8") ?>"
                                            class="input-table">
                                    </td>
                                    <td>
                                        <input form="<?= htmlspecialchars($fid, ENT_QUOTES, "UTF-8") ?>" type="email"
                                            name="email" value="<?= $emailVal ?>" class="input-table">
                                    </td>
                                    <td>
                                        <input form="<?= htmlspecialchars($fid, ENT_QUOTES, "UTF-8") ?>" type="date"
                                            name="data_nascimento"
                                            value="<?= htmlspecialchars((string) ($usuario["data_nascimento"] ?? ""), ENT_QUOTES, "UTF-8") ?>"
                                            class="input-table">
                                    </td>
                                    </td>
                                    <td>
                                        <input form="<?= htmlspecialchars($fid, ENT_QUOTES, "UTF-8") ?>" type="tel"
                                            name="telefone" value="<?= $telVal ?>" class="input-table">
                                    </td>
                                    <td>
                                        <input form="<?= htmlspecialchars($fid, ENT_QUOTES, "UTF-8") ?>" type="text"
                                            name="cartao" value="<?= $cartaoVal ?>" class="input-table" placeholder="Cartão IoT"
                                            maxlength="25">
                                    </td>

                                    <td class="coluna-acao">
                                        <form id="<?= htmlspecialchars($fid, ENT_QUOTES, "UTF-8") ?>" action="api/usuarios.php"
                                            method="POST" class="form-acoes-linha">
                                            <input type="hidden" name="_method" value="PATCH">
                                            <input type="hidden" name="redirect_html" value="1">
                                            <input type="hidden" name="id" value="<?= $idEsc ?>">
                                            <button type="submit" class="btn-salvar" style="color: #fff;">Salvar alterações</button>
                                        </form>
                                        <form action="api/usuarios.php" method="POST" class="form-delete-row">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="redirect_html" value="1">
                                            <input type="hidden" name="id" value="<?= $idEsc ?>">
                                            <button type="submit" class="btn-delete">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7">Nenhum usuário cadastrado</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <a href="cadastro.html" class="lista-btn-novo" style="color: #fff;"><i class="fa-solid fa-user-plus"></i>
                Novo cadastro</a>
        </main>
    </div>
    <footer>
        &copy; 2026 VISIO – Visão Inteligente para Sensores IoT.
    </footer>
    <script src="JS/theme.js"></script>
</body>

</html>