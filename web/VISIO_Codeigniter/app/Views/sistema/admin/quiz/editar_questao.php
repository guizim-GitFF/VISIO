<?= view('sistema/layout/header_adm') ?>

<div class="layout">
    <?= view('sistema/admin/_sidebar', ['ativo' => 'perguntas']) ?>

    <div class="main">
        <div class="content">

            <div class="topbar">
                <h1>Editar Questão</h1>
                <p><a href="<?= base_url('/admin/perguntas') ?>" style="color:var(--primary);">
                    <i class="fa-solid fa-arrow-left"></i> Voltar à lista
                </a></p>
            </div>

            <?= view('sistema/layout/_flash') ?>

            <?php if (!$pergunta): ?>
                <div style="background:#fee2e2;padding:14px 18px;border-radius:12px;color:#991b1b;">
                    Questão não encontrada.
                </div>
            <?php else: ?>
            <section class="card">
                <form action="<?= base_url('/admin/pergunta/atualizar/' . $pergunta['ID_PERGUNTA']) ?>" method="post" class="form-grid">
                    <?= csrf_field() ?>

                    <div>
                        <label>Enunciado da pergunta</label>
                        <textarea name="descricao" rows="4" required><?= esc($pergunta['DESCRICAO']) ?></textarea>
                    </div>

                    <div>
                        <label>Nível de dificuldade</label>
                        <select name="nivel_dificuldade">
                            <option value="Fácil"   <?= $pergunta['NIVEL_DIFICULDADE'] === 'Fácil'   ? 'selected' : '' ?>>Fácil</option>
                            <option value="Médio"   <?= $pergunta['NIVEL_DIFICULDADE'] === 'Médio'   ? 'selected' : '' ?>>Médio</option>
                            <option value="Difícil" <?= $pergunta['NIVEL_DIFICULDADE'] === 'Difícil' ? 'selected' : '' ?>>Difícil</option>
                        </select>
                    </div>

                    <p style="font-weight:700;font-size:17px;margin-top:10px;">Alternativas</p>
                    <p style="color:var(--text2);font-size:13px;">Marque o radio ao lado da alternativa correta.</p>

                    <?php
                    $letras = ['A', 'B', 'C', 'D'];
                    foreach ($pergunta['alternativas'] as $i => $alt):
                    ?>
                    <div style="display:flex;align-items:center;gap:12px;">
                        <input type="radio"
                               name="correta"
                               value="<?= esc($alt['ID_ALTERNATIVA']) ?>"
                               <?= $alt['IS_CORRETA'] ? 'checked' : '' ?>
                               required>
                        <input type="hidden" name="id_alternativa[]" value="<?= esc($alt['ID_ALTERNATIVA']) ?>">
                        <span style="font-weight:700;min-width:25px;"><?= $letras[$i] ?? ($i+1) ?>)</span>
                        <input type="text"
                               name="alternativa[]"
                               value="<?= esc($alt['DESCRICAO']) ?>"
                               placeholder="Alternativa <?= $letras[$i] ?? ($i+1) ?>"
                               required
                               style="flex:1;">
                    </div>
                    <?php endforeach; ?>

                    <div>
                        <button type="submit" class="btn-primary">
                            <i class="fa-solid fa-floppy-disk"></i> Salvar alterações
                        </button>
                    </div>
                </form>
            </section>
            <?php endif; ?>

        </div>
    </div>
</div>

<?= view('sistema/layout/footer_adm') ?>
