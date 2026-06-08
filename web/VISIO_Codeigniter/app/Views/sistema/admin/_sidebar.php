<aside class="sidebar">
    <div class="logo-area"><h2>VISIO</h2></div>
    <p class="menu-title">Menu principal</p>
    <ul class="menu">
        <li>
            <a href="<?= base_url('/admin/dashboard') ?>" <?= ($ativo ?? '') === 'dashboard' ? 'class="active"' : '' ?>>
                <i class="fa-solid fa-chart-line"></i> Dashboard
            </a>
        </li>
        <li>
            <a href="<?= base_url('/admin/usuarios') ?>" <?= ($ativo ?? '') === 'usuarios' ? 'class="active"' : '' ?>>
                <i class="fa-solid fa-users"></i> Usuários
            </a>
        </li>
        <li>
            <a href="<?= base_url('/admin/perguntas') ?>" <?= ($ativo ?? '') === 'perguntas' ? 'class="active"' : '' ?>>
                <i class="fa-solid fa-clipboard-list"></i> Questões
            </a>
        </li>
        <li>
            <a href="<?= base_url('/admin/sensores') ?>" <?= ($ativo ?? '') === 'sensores' ? 'class="active"' : '' ?>>
                <i class="fa-solid fa-microchip"></i> Sensores
            </a>
        </li>
        
        <li>
            <a href="<?= base_url('/logout') ?>" style="color:#ef4444;">
                <i class="fa-solid fa-right-from-bracket"></i> Sair
            </a>
        </li>
    </ul>
</aside>
