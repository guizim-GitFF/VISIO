<?= view('sistema/layout/header_adm') ?>

<style>
*{ margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI',sans-serif; }
:root{ --bg:#f1f5f9; --card:#fff; --text:#0f172a; --text2:#64748b; --border:#e2e8f0; --primary:#2563eb; --sidebar:#0f172a; --sidebar2:#111827; --shadow:0 10px 25px rgba(0,0,0,.08); }
body.dark{ --bg:#0b1120; --card:#111827; --text:#f8fafc; --text2:#94a3b8; --border:#1e293b; --sidebar:#020617; --sidebar2:#0f172a; }
body{ background:var(--bg); color:var(--text); min-height:100vh; transition:.3s; }
.layout{ display:flex; }
.sidebar{ width:280px; height:100vh; background:linear-gradient(180deg,var(--sidebar),var(--sidebar2)); position:fixed; left:0; top:0; padding:25px; overflow-y:auto; z-index:1000; }
.logo-area{ display:flex; align-items:center; gap:15px; margin-bottom:40px; }
.logo-area h2{ color:white; font-size:28px; }
.menu-title{ color:#64748b; text-transform:uppercase; font-size:12px; margin-bottom:15px; letter-spacing:1px; }
.menu{ list-style:none; }
.menu li{ margin-bottom:10px; }
.menu a{ display:flex; align-items:center; gap:14px; padding:15px;  text-decoration:none; color:#e2e8f0; transition:.3s; font-weight:500; font-size:16px; }
.main{ width:calc(100% - 280px); margin-left:280px; }
header{ height:90px; background:var(--card); border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; padding:0 30px; position:sticky; top:0; z-index:999; box-shadow:0 4px 20px rgba(0,0,0,.04); }
.nav-right{ display:flex; align-items:center; gap:20px; }
#theme-toggle{ width:42px; height:42px; border:none; border-radius:12px; background:var(--bg); color:var(--text); cursor:pointer; font-size:16px; }
.profile-btn{ background:#2563eb; color:white; padding:10px 16px; border-radius:10px; text-decoration:none; display:flex; align-items:center; gap:8px; font-weight:600; }
.content{ padding:30px; max-width:1200px; margin:auto; }
.page-title{ font-size:34px; margin-bottom:8px; }
.page-sub{ color:var(--text2); margin-bottom:25px; }
.page-sub a{ color:var(--primary); text-decoration:none; font-weight:600; }
.card{ background:var(--card); border-radius:22px; padding:30px; box-shadow:var(--shadow); }
.form-grid{ display:grid; gap:20px; }
label{ font-weight:600; margin-bottom:8px; display:block; }
textarea, input, select{ width:100%; padding:15px; border-radius:14px; border:1px solid var(--border); background:var(--bg); color:var(--text); outline:none; font-size:15px; }
textarea{ resize:none; }
.form-section{ margin-top:10px; margin-bottom:5px; font-weight:700; font-size:18px; }
.alt-row{ display:flex; align-items:center; gap:12px; }
.alt-row input[type="radio"]{ width:auto; }
.alt-letra{ font-weight:700; min-width:30px; }
.btn-salvar{ background:var(--primary); color:white; border:none; padding:15px; border-radius:14px; font-size:16px; font-weight:600; cursor:pointer; margin-top:10px; width:100%; transition:.3s; }
.btn-salvar:hover{ opacity:.9; transform:translateY(-2px); }
</style>

<div class="layout">

<!-- SIDEBAR -->
<aside class="sidebar">

            <div class="logo-area">
                <h2>VISIO</h2>
            </div>

            <p class="menu-title">Menu principal</p>

            <ul class="menu">

                <li>
                    <a href="<?= base_url('/admin/dashboard') ?>">
                        <i class="fa-solid fa-chart-line"></i>
                        Dashboard
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('/admin/usuarios') ?>" class="active">
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
<!-- MAIN -->
<div class="main">

<div class="content">

<h1 class="page-title">Usuários cadastrados</h1>
<p class="page-sub">Gerencie usuários e cartões IoT vinculados ao sistema.</p>

<table>

<thead>
<tr>
<th>ID</th>
<th>CPF</th>
<th>E-mail</th>
<th>Data Nasc.</th>
<th>Telefone</th>
<th>Cartão IoT</th>
<th>Ações</th>
</tr>
</thead>

<tbody>

<?php foreach($usuarios as $usuario): ?>

<?php
$id = (int)($usuario["id"] ?? 0);
$form = "f".$id;
?>

<tr>

<td><?= $id ?></td>

<td>
<input form="<?= $form ?>" name="cpf"
value="<?= htmlspecialchars($usuario["cpf"] ?? "") ?>"
class="input-table">
</td>

<td>
<input form="<?= $form ?>" name="email"
value="<?= htmlspecialchars($usuario["email"] ?? "") ?>"
class="input-table">
</td>

<td>
<input form="<?= $form ?>" type="date" name="data_nascimento"
value="<?= htmlspecialchars($usuario["data_nascimento"] ?? "") ?>"
class="input-table">
</td>

<td>
<input form="<?= $form ?>" name="telefone"
value="<?= htmlspecialchars($usuario["telefone"] ?? "") ?>"
class="input-table">
</td>

<td>
<input form="<?= $form ?>" name="cartao"
value="<?= htmlspecialchars($usuario["cartao"] ?? "") ?>"
class="input-table">
</td>

<td>

<div class="actions">

<form id="<?= $form ?>" action="api/usuarios.php" method="POST">
<input type="hidden" name="_method" value="PATCH">
<input type="hidden" name="id" value="<?= $id ?>">
<button class="btn-salvar">Salvar</button>
</form>

<form action="api/usuarios.php" method="POST">
<input type="hidden" name="_method" value="DELETE">
<input type="hidden" name="id" value="<?= $id ?>">
<button class="btn-delete">Excluir</button>
</form>

</div>

</td>

</tr>

<?php endforeach; ?>

</tbody>

</table>

</div>

</div>

</div>

<script>
const toggle = document.getElementById("theme-toggle");

toggle.addEventListener("click", () => {
    document.body.classList.toggle("dark");

    const icon = toggle.querySelector("i");

    if(document.body.classList.contains("dark")){
        icon.classList.remove("fa-moon");
        icon.classList.add("fa-sun");
    } else {
        icon.classList.remove("fa-sun");
        icon.classList.add("fa-moon");
    }
});
</script>

</div>
</main>

<?= view('sistema/layout/footer_adm') ?>