<?= view('sistema/layout/header') ?>

<main class="sensores-page-main">
    <div style="max-width:800px;margin:2rem auto;padding:0 1rem;">

        <?php if (!$sensor): ?>
            <p style="color:#ef4444;">Sensor não encontrado. <a href="<?= base_url('/sensor') ?>">← Voltar</a></p>
        <?php else: ?>

            <a href="<?= base_url('/sensor') ?>" style="color:var(--color-accent,#3a86ff);font-weight:600;display:inline-flex;align-items:center;gap:6px;margin-bottom:1.5rem;">
                <i class="fa-solid fa-arrow-left"></i> Voltar ao catálogo
            </a>

            <h1 class="sensores-page-title" style="margin-bottom:0.5rem;"><?= esc($sensor['NOME']) ?></h1>

            <?php if (!empty($sensor['FOTO'])): ?>
                <img src="<?= base_url($sensor['FOTO']) ?>"
                     alt="<?= esc($sensor['NOME']) ?>"
                     style="max-width:100%;max-height:300px;object-fit:contain;border-radius:12px;margin:1rem 0;box-shadow:0 4px 15px rgba(0,0,0,.1);"
                     onerror="this.style.display='none'">
            <?php endif; ?>

            <section style="background:var(--color-bg-card,#fff);border-radius:16px;padding:1.5rem;box-shadow:0 4px 15px rgba(0,0,0,.06);margin-top:1rem;">
                <h2 style="margin-bottom:1rem;">Descrição técnica</h2>
                <p style="line-height:1.7;"><?= esc($sensor['DESCRICAO']) ?></p>

                <?php if (!empty($sensor['CIRCUITO'])): ?>
                    <h2 style="margin:1.5rem 0 0.75rem;">Circuito / Montagem</h2>
                    <div style="background:var(--color-bg,#f8fafc);border-radius:10px;padding:1rem;font-family:monospace;line-height:1.6;">
                        <?= nl2br(esc($sensor['CIRCUITO'])) ?>
                    </div>
                <?php endif; ?>
            </section>

            <div style="margin-top:2rem;display:flex;gap:1rem;flex-wrap:wrap;">
                <a href="<?= base_url('/sensor') ?>" class="animated-button">
                    ← Ver todos os sensores
                </a>
                <?php if (session()->get('usuario_logado')): ?>
                    <a href="<?= base_url('/quiz') ?>" class="animated-button azul">
                        Praticar no Quiz →
                    </a>
                <?php endif; ?>
            </div>

        <?php endif; ?>
    </div>
</main>

<?= view('sistema/layout/footer') ?>
