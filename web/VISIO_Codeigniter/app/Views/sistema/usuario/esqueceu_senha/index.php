<?= view('sistema/layout/header') ?>

<!-- PAGINA DA EMILY -->

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha — VISIO</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="assets/Marca/Simbolo/SimboloDark.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
</head>

<body>
    <main class="forgot-page">
        <p id="senha-feedback" class="contato-feedback" hidden></p>
        <div class="forgot-container">
            <section class="forgot-form">
                <h1>Recuperar Senha</h1>
                <p>Digite seu e-mail. O pedido será registrado (demonstração — sem envio real de link).</p>
                <form action="api/recuperar_senha.php" method="post" id="form">
                    <input type="email" name="email" id="email" placeholder="Seu e-mail">
                    <span class="erro" id="erroEmail"></span>
                    <button type="button" onclick="mostrarAlerta()">
                        <i class="fa-solid fa-envelope"></i> Registrar pedido
                    </button>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <script>
                    function mostrarAlerta() {
                        Swal.fire({
                            title: "Pedido registrado!",
                            icon: "success",
                            draggable: true
                        });
                    }
                    </script>
                </form>
            </section>
            <div class="login-image">
            <img class="theme-img" src="<?= base_url('assets/images/logos/Logo/LogoDark.png') ?>"
                data-light="<?= base_url('assets/images/logos/Logo/LogoDark.png') ?>"
                data-dark="<?= base_url('assets/images/logos/Logo/LogoDark.png') ?>" alt="Logo"
                style="width: 100%;  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);">
            </div>
        </div>
    </main>

    <script>
    </script>
    <script src="JS/validacaorecuperar.js"></script>
    <script src="JS/theme.js"></script>
</body>
</html>

<?= view('sistema/layout/footer_adm') ?>