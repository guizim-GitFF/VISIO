<?= view('sistema/layout/header_adm') ?>

<style>

/* ===== RESET ===== */
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
}

/* ===== VARIÁVEIS IGUAL DASHBOARD ===== */
:root{
    --bg:#f1f5f9;
    --card:#ffffff;
    --text:#0f172a;
    --text2:#64748b;
    --border:#e2e8f0;
    --primary:#2563eb;
    --sidebar:#0f172a;
    --sidebar2:#111827;
    --shadow:0 10px 25px rgba(0,0,0,0.08);
}

/* DARK MODE */
body.dark{
    --bg:#0b1120;
    --card:#111827;
    --text:#f8fafc;
    --text2:#94a3b8;
    --border:#1e293b;
    --sidebar:#020617;
    --sidebar2:#0f172a;
}

body{
    background:var(--bg);
    color:var(--text);
}

/* ===== LAYOUT ===== */
.layout{
    display:flex;
}

/* ===== SIDEBAR IGUAL DASHBOARD ORIGINAL ===== */
.sidebar{
    width:280px;
    height:100vh;
    position:fixed;
    left:0;
    top:0;
    padding:25px;
    background:linear-gradient(180deg,var(--sidebar),var(--sidebar2));
}

/* LOGO IGUAL DASHBOARD */
.logo-area{
    display:flex;
    align-items:center;
    gap:15px;
    margin-bottom:40px;
}

.logo-area h2{
    color:white;
    font-size:28px;
    font-weight:700;
}

/* MENU PRINCIPAL IGUAL ORIGINAL */
.menu-title{
    color:#64748b;
    text-transform:uppercase;
    font-size:12px;
    margin-bottom:15px;
    letter-spacing:1px;
}

.menu a{
    display:flex;
    align-items:center;
    gap:14px;
    padding:15px;
    border-radius:14px;
    text-decoration:none;
    color:#e2e8f0;
    font-weight:500;
    margin-bottom:10px;
}


/* ===== MAIN ===== */
.main{
    width:calc(100% - 280px);
    margin-left:280px;
}

/* ===== HEADER IGUAL DASHBOARD (IMPORTANTE) ===== */
header{
    height:90px;
    background:var(--card);
    border-bottom:1px solid var(--border);
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 30px;
    position:sticky;
    top:0;
    z-index:999;
    box-shadow:var(--shadow);
}

.header-right{
    display:flex;
    align-items:center;
    gap:15px;
}

/* PERFIL BTN IGUAL DASHBOARD */
.profile-btn{
    background:var(--primary);
    color:white;
    padding:10px 15px;
    border-radius:10px;
    text-decoration:none;
    display:flex;
    align-items:center;
    gap:8px;
}

/* THEME BTN */
#theme-toggle{
    width:42px;
    height:42px;
    border:none;
    border-radius:12px;
    background:var(--bg);
    cursor:pointer;
}

/* ===== CONTENT ===== */
.content{
    padding:30px;
}

.page-title{
    font-size:30px;
    margin-bottom:20px;
}

/* PERFIL */
.container{
    display:flex;
    gap:40px;
    flex-wrap:wrap;
}

/* FOTO */
.foto{
    display:flex;
    flex-direction:column;
    align-items:center;
    gap:15px;
}

.foto img{
    width:160px;
    height:160px;
    border-radius:50%;
    object-fit:cover;
    box-shadow:var(--shadow);
}

.btn-foto{
    background:var(--primary);
    color:white;
    padding:8px 14px;
    border-radius:8px;
    cursor:pointer;
}

/* FORM */
.card{
    flex:1;
    background:var(--card);
    padding:25px;
    border-radius:20px;
    box-shadow:var(--shadow);
}

input{
    padding:10px;
    border:1px solid var(--border);
    border-radius:8px;
    margin-bottom:10px;
    width:100%;
}

.btn-salvar{
    background:var(--primary);
    color:white;
    padding:10px;
    border:none;
    border-radius:10px;
    cursor:pointer;
}
.perfil-header{
    margin-bottom:30px;
}

.perfil-sub{
    color:var(--text2);
    margin-top:8px;
}

.container{
    display:flex;
    gap:30px;
    flex-wrap:wrap;
    align-items:flex-start;
}

.perfil-lateral{
    width:300px;
    background:var(--card);
    border-radius:24px;
    padding:30px;
    box-shadow:var(--shadow);
    border:1px solid var(--border);
    display:flex;
    flex-direction:column;
    align-items:center;
    text-align:center;
}

.perfil-lateral img{
    width:180px;
    height:180px;
    border-radius:50%;
    object-fit:cover;
    border:5px solid #2563eb;
    box-shadow:0 15px 35px rgba(37,99,235,.20);
    margin-bottom:15px;
}

.perfil-lateral h3{
    margin-bottom:5px;
}

.perfil-lateral span{
    color:var(--text2);
    font-size:14px;
    margin-bottom:20px;
}

.btn-foto{
    background:#2563eb;
    color:white;
    padding:12px 18px;
    border-radius:12px;
    font-weight:600;
    cursor:pointer;
    width:100%;
    text-align:center;
}

.card{
    flex:1;
    min-width:450px;
    background:var(--card);
    padding:35px;
    border-radius:24px;
    box-shadow:var(--shadow);
    border:1px solid var(--border);
}

.titulo-card{
    margin-bottom:25px;
}

.campo{
    margin-bottom:18px;
}

.campo label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
}

input{
    width:100%;
    height:55px;
    padding:0 18px;
    border:2px solid var(--border);
    border-radius:14px;
    background:var(--bg);
    color:var(--text);
    font-size:15px;
}

input:focus{
    border-color:#2563eb;
    outline:none;
}

.btn-salvar{
    width:100%;
    height:55px;
    border:none;
    border-radius:14px;
    background:#2563eb;
    color:white;
    font-size:15px;
    font-weight:600;
    cursor:pointer;
    margin-top:10px;
}

</style>

</head>

<body>

<div class="layout">

<!-- SIDEBAR -->
<aside class="sidebar">

            <div class="logo-area">
                <h2>VISIO</h2>
            </div>

            <p class="menu-title">Menu principal</p>

            <ul class="menu">

                <li>
                    <a href="<?= base_url('/admin/dashboard') ?>" class="active">
                        <i class="fa-solid fa-chart-line"></i>
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('/admin/usuarios') ?>">
                        <i class="fa-solid fa-users"></i>
                        Usuários
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('/admin/perguntas') ?>">
                        <i class="fa-solid fa-clipboard-list"></i>
                        Questões
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('/admin/sensores') ?>">
                        <i class="fa-solid fa-microchip"></i>
                        Sensores
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('/logout') ?>" style="color:#ef4444;">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Sair
                    </a>
                </li>

            </ul>

        </aside>

<div class="content">

    <div class="perfil-header">
        <div>
            <h1 class="page-title">
                <i class="fa-solid fa-user-shield"></i>
                Perfil do Administrador
            </h1>
            <p class="perfil-sub">
                Gerencie suas informações pessoais e configurações da conta.
            </p>
        </div>
    </div>

    <div class="container">

        <!-- FOTO -->
        <div class="perfil-lateral">

            <img id="preview" src="images/foto_adm_perfil.jpeg">

            <h3>Administrador</h3>

            <span>Conta principal do sistema VISIO</span>

            <input type="file" id="file" hidden>

            <label for="file" class="btn-foto">
                <i class="fa-solid fa-camera"></i>
                Alterar Foto
            </label>

        </div>

        <!-- FORM -->
        <div class="card">

            <h2 class="titulo-card">
                Informações pessoais
            </h2>

            <div class="campo">
                <label>Nome completo</label>
                <input id="nome" placeholder="Digite seu nome completo">
            </div>

            <div class="campo">
                <label>CPF</label>
                <input id="cpf" placeholder="000.000.000-00">
            </div>

            <div class="campo">
                <label>Telefone</label>
                <input id="telefone" placeholder="(19) 99999-9999">
            </div>

            <div class="campo">
                <label>Data de nascimento</label>
                <input id="data" type="date">
            </div>

            <div class="campo">
                <label>E-mail</label>
                <input id="email" placeholder="email@visio.com">
            </div>

            <div class="campo">
                <label>Cartão IoT</label>
                <input id="cartao" placeholder="Código do cartão">
            </div>

            <div class="campo">
                <label>Senha</label>
                <input id="senha" type="password" placeholder="Digite sua senha">
            </div>

            <button class="btn-salvar" id="salvar">
                <i class="fa-solid fa-floppy-disk"></i>
                Salvar Alterações
            </button>

        </div>

    </div>

</div>

<script>

/* THEME */
document.getElementById("theme-toggle").onclick = () => {
    document.body.classList.toggle("dark");
};

/* FOTO */
const file = document.getElementById("file");
const preview = document.getElementById("preview");

file.onchange = e => {
    const reader = new FileReader();
    reader.onload = () => {
        preview.src = reader.result;
        localStorage.setItem("foto", reader.result);
    };
    reader.readAsDataURL(e.target.files[0]);
};

if(localStorage.getItem("foto")){
    preview.src = localStorage.getItem("foto");
}

/* SALVAR */
document.getElementById("salvar").onclick = () => {

    ["nome","cpf","telefone","data","email","cartao","senha"].forEach(id=>{
        localStorage.setItem(id, document.getElementById(id).value);
    });

    alert("Dados salvos!");
};

</script>
</div>

</main>

<?= view('sistema/layout/footer_adm') ?>