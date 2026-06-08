<?= view('sistema/layout/header_adm') ?>

<div class="layout">
    <?= view('sistema/admin/_sidebar', ['ativo' => 'sensores']) ?>

    <div class="main">
        <div class="content">

            <div class="topbar">
                <h1>Cadastrar Novo Sensor</h1>
                <p><a href="<?= base_url('/admin/sensores') ?>" style="color:var(--primary);">
                    <i class="fa-solid fa-arrow-left"></i> Voltar à lista
                </a></p>
            </div>

            <?= view('sistema/layout/_flash') ?>

            <section class="card">
                <form action="<?= base_url('/admin/sensor/inserir') ?>" method="post" enctype="multipart/form-data" class="form-grid">
                    <?= csrf_field() ?>

                    <div>
                        <label>Nome do sensor</label>
                        <input type="text" name="nome" placeholder="Ex.: Sensor de Temperatura" required>
                    </div>

                    <div>
                        <label>Descrição</label>
                        <input type="text" name="descricao" placeholder="Descrição técnica do sensor" required>
                    </div>

                    <div>
                        <label>Circuito / Montagem</label>
                        <textarea name="circuito" rows="4" placeholder="Ex.: Arduino + LM35 + resistor 10k"></textarea>
                    </div>

                    <div>
                        <label>Foto do sensor (opcional)</label>
                        <input type="file" name="foto" accept="image/*">
                    </div>

                    <div>
                        <button type="submit" class="btn-primary">
                            <i class="fa-solid fa-plus"></i> Cadastrar sensor
                        </button>
                    </div>
                </form>
            </section>

        </div>
    </div>
</div>

<?= view('sistema/layout/footer_adm') ?>
