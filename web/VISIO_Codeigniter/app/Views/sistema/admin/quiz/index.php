<?= view('sistema/layout/header_adm') ?>

<style>
*{ margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI',sans-serif; }
:root{ --bg:#f1f5f9; --card:#fff; --text:#0f172a; --text2:#64748b; --border:#e2e8f0; --primary:#2563eb; --danger:#ef4444; --sidebar:#0f172a; --sidebar2:#111827; --shadow:0 10px 25px rgba(0,0,0,.08); }
body.dark{ --bg:#0b1120;  --text:#f8fafc; --text2:#94a3b8; --border:#1e293b; --sidebar:#020617; --sidebar2:#0f172a; }
body{ background:var(--bg); color:var(--text); min-height:100vh; transition:.3s; }
.layout{ display:flex; }
.sidebar{ width:280px; height:100vh; background:linear-gradient(180deg,var(--sidebar),var(--sidebar2)); position:fixed; left:0; top:0; padding:25px; overflow-y:auto; z-index:1000; }
.logo-area{ display:flex; align-items:center; gap:15px; margin-bottom:40px; }
.logo-area h2{ color:white; font-size:28px; }
.menu-title{ color:#64748b; text-transform:uppercase; font-size:12px; margin-bottom:15px; letter-spacing:1px; }
.menu{ list-style:none; }
.menu li{ margin-bottom:10px; }
.menu a{ display:flex; align-items:center; gap:14px; padding:15px; border-radius:14px; text-decoration:none; color:#e2e8f0; transition:.3s; font-weight:500; font-size:16px; }

.main{ width:calc(100% - 280px); margin-left:280px; }
header{ height:90px; background:var(--card); border-bottom:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; padding:0 30px; position:sticky; top:0; z-index:999; box-shadow:0 4px 20px rgba(0,0,0,.04); }
.nav-right{ display:flex; align-items:center; gap:20px; }
#theme-toggle{ width:42px; height:42px; border:none; border-radius:12px; background:var(--bg); color:var(--text); cursor:pointer; font-size:16px; }
.profile-btn{ background:#2563eb; color:white; padding:10px 16px; border-radius:10px; text-decoration:none; display:flex; align-items:center; gap:8px; font-weight:600; }
.content{ padding:30px; max-width:1600px; margin:auto; }
.page-title{ font-size:34px; margin-bottom:8px; }
.page-sub{ color:var(--text2); margin-bottom:25px; }
.top-actions{ margin-bottom:25px; }
.btn-add{ background:var(--primary); color:white; padding:14px 20px; border-radius:14px; text-decoration:none; font-weight:600; display:inline-flex; align-items:center; gap:10px; box-shadow:var(--shadow); }
.card{ background:var(--card); border-radius:22px; padding:25px; box-shadow:var(--shadow); overflow-x:auto; }
table{ width:100%; border-collapse:collapse; }



.input-table, select{ width:100%; padding:12px; border-radius:10px; border:1px solid var(--border); background:var(--bg); color:var(--text); outline:none; }
.td-alts{ min-width:350px; }
.alt-edit-row{ display:flex; align-items:center; gap:10px; margin-bottom:10px; }
.alt-label{ font-weight:700; min-width:25px; }
.btn-salvar{ background:#22c55e; color:white; border:none; padding:12px 16px; border-radius:10px; cursor:pointer; font-weight:600; margin-bottom:8px; width:100%; }
.btn-delete{ background:var(--danger); color:white; border:none; padding:12px 16px; border-radius:10px; cursor:pointer; font-weight:600; width:100%; }
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
                    <a href="<?= base_url('/admin/usuarios') ?>">
                        <i class="fa-solid fa-users"></i>
                        Usuários
                    </a>
                </li>

                <li>
                    <a href="<?= base_url('/admin/perguntas') ?>" class="active">
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

    <div class="main">

        <div class="content">

            <h1 class="page-title">Questões cadastradas</h1>
            <p class="page-sub">Gerencie as perguntas do quiz.</p>

            <div class="top-actions">
                <a href="<?= base_url('/admin/pergunta/nova') ?>" class="btn-add">
                    <i class="fa-solid fa-plus"></i> Nova questão
                </a>
            </div>

            <section class="card">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Pergunta</th>
                            <th>Nível</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($perguntas as $p): ?>
                            <tr>
                                <td><?= esc($p['ID_PERGUNTA']) ?></td>
                                <td><?= esc($p['DESCRICAO']) ?></td>
                                <td><?= esc($p['NIVEL_DIFICULDADE'] ?? '—') ?></td>
                                <td>
                                    <a href="<?= base_url('/admin/pergunta/editar/' . $p['ID_PERGUNTA']) ?>"
                                       style="display:block;margin-bottom:8px;background:#f59e0b;color:white;padding:10px;border-radius:10px;text-align:center;text-decoration:none;font-weight:600;">
                                        <i class="fa-solid fa-pen"></i> Editar
                                    </a>
                                    <a href="<?= base_url('/admin/pergunta/excluir/' . $p['ID_PERGUNTA']) ?>"
                                       class="btn-delete"
                                       style="display:block;text-align:center;text-decoration:none;"
                                       onclick="return confirm('Excluir esta questão?')">
                                        <i class="fa-solid fa-trash"></i> Excluir
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </section>

        </div>
    </div>
</div>

<script>
const toggle = document.getElementById('theme-toggle');
const icon   = toggle.querySelector('i');
if (localStorage.getItem('visio_adm_tema') === 'dark') {
    document.body.classList.add('dark');
    icon.className = 'fa-solid fa-sun';
}
toggle.addEventListener('click', () => {
    document.body.classList.toggle('dark');
    const d = document.body.classList.contains('dark');
    localStorage.setItem('visio_adm_tema', d ? 'dark' : 'light');
    icon.className = d ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
});
</script>

<?= view('sistema/layout/footer_adm') ?>
