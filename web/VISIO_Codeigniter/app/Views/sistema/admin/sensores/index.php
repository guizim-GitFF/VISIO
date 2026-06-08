<?= view('sistema/layout/header_adm') ?>

<div class="layout">
    <?= view('sistema/admin/_sidebar', ['ativo' => 'sensores']) ?>

    <div class="main">
        <div class="content">

            <div class="topbar">
                <h1>Sensores</h1>
                <p>Gerencie os sensores cadastrados no sistema.</p>
            </div>

            <?= view('sistema/layout/_flash') ?>

            <div class="top-actions">
                <a href="<?= base_url('/admin/sensor/novo') ?>" class="btn-add">
                    <i class="fa-solid fa-plus"></i> Novo sensor
                </a>
            </div>

            <section class="card" style="overflow-x:auto;">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Foto</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Circuito</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($sensores)): ?>
                            <tr>
                                <td colspan="6" style="text-align:center;padding:25px;color:var(--text2);">
                                    Nenhum sensor cadastrado. <a href="<?= base_url('/admin/sensor/novo') ?>">Cadastre o primeiro!</a>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($sensores as $s): ?>
                                <tr>
                                    <td><?= esc($s['ID_SENSOR']) ?></td>
                                    <td>
                                        <?php if (!empty($s['FOTO'])): ?>
                                            <img src="<?= base_url($s['FOTO']) ?>" alt="Foto"
                                                 class="sensor-img"
                                                 onerror="this.src='<?= base_url('assets/images/placeholder.png') ?>'">
                                        <?php else: ?>
                                            <span style="color:var(--text2);">—</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><strong><?= esc($s['NOME']) ?></strong></td>
                                    <td><?= esc($s['DESCRICAO']) ?></td>
                                    <td><?= esc($s['CIRCUITO'] ?: '—') ?></td>
                                    <td>
                                        <a href="<?= base_url('/admin/sensor/editar/' . $s['ID_SENSOR']) ?>"
                                           class="btn-edit"
                                           style="display:inline-flex;align-items:center;gap:6px;margin-bottom:6px;padding:9px 14px;border-radius:10px;text-decoration:none;font-weight:600;background:#f59e0b;color:white;">
                                            <i class="fa-solid fa-pen"></i> Editar
                                        </a>
                                        <a href="<?= base_url('/admin/sensor/excluir/' . $s['ID_SENSOR']) ?>"
                                           style="display:inline-flex;align-items:center;gap:6px;padding:9px 14px;border-radius:10px;text-decoration:none;font-weight:600;background:#ef4444;color:white;"
                                           onclick="return confirm('Excluir o sensor <?= esc($s['NOME']) ?>?')">
                                            <i class="fa-solid fa-trash"></i> Excluir
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>

        </div>
    </div>
</div>

<script>
const toggle = document.getElementById('theme-toggle');
if (toggle) {
    const icon = toggle.querySelector('i');
    if (localStorage.getItem('visio_adm_tema') === 'dark') {
        document.body.classList.add('dark');
        if (icon) icon.className = 'fa-solid fa-sun';
    }
    toggle.addEventListener('click', () => {
        document.body.classList.toggle('dark');
        const d = document.body.classList.contains('dark');
        localStorage.setItem('visio_adm_tema', d ? 'dark' : 'light');
        if (icon) icon.className = d ? 'fa-solid fa-sun' : 'fa-solid fa-moon';
    });
}
</script>

<?= view('sistema/layout/footer_adm') ?>
