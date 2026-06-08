 <?php if (!$sensor): ?>

                <div style="
                    background:#fee2e2;
                    padding:16px;
                    border-radius:12px;
                    color:#991b1b;
                ">
                    Sensor não encontrado.
                </div>

            <?php else: ?>

                <section class="card sensor-card">

                    <form
                        action="<?= base_url('/admin/sensor/atualizar/' . $sensor['ID_SENSOR']) ?>"
                        method="post"
                        enctype="multipart/form-data"
                        class="form-grid"
                    >

                        <?= csrf_field() ?>

                        <div class="form-group">
                            <label>Nome do sensor</label>
                            <input
                                type="text"
                                name="nome"
                                value="<?= esc($sensor['NOME']) ?>"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label>Descrição</label>
                            <input
                                type="text"
                                name="descricao"
                                value="<?= esc($sensor['DESCRICAO']) ?>"
                                required
                            >
                        </div>

                        <div class="form-group">
                            <label>Circuito / Montagem</label>

                            <textarea
                                name="circuito"
                                rows="6"
                            ><?= esc($sensor['CIRCUITO'] ?? '') ?></textarea>
                        </div>

                        <?php if (!empty($sensor['FOTO'])): ?>

                            <div class="form-group">
                                <label>Foto atual</label>

                                <img
                                    src="<?= base_url($sensor['FOTO']) ?>"
                                    alt="Foto do sensor"
                                    class="sensor-img"
                                >
                            </div>

                        <?php endif; ?>

                        <div class="form-group">
                            <label>Nova foto (opcional)</label>

                            <input
                                type="file"
                                name="foto"
                                accept="image/*"
                            >
                        </div>

                        <div class="form-group">
                            <button
                                type="submit"
                                class="btn-primary"
                            >
                                <i class="fa-solid fa-floppy-disk"></i>
                                Salvar alterações
                            </button>
                        </div>

                    </form>

                </section>

            <?php endif; ?>

        </div>

    </main>

</div>

<style>
.sensor-card{
    width:100%;
    max-width:1100px;
    margin:20px auto;
    padding:35px;
    border-radius:18px;
}

.form-grid{
    display:flex;
    flex-direction:column;
    gap:22px;
}

.form-group{
    width:100%;
}

.form-group label{
    display:block;
    margin-bottom:8px;
    font-weight:600;
    color:#0f172a;
}

.form-group input[type="text"],
.form-group input[type="file"],
.form-group textarea{
    width:100%;
    padding:14px 16px;
    border:1px solid #dbe2ea;
    border-radius:12px;
    font-size:15px;
}

.form-group textarea{
    min-height:180px;
    resize:vertical;
}

.sensor-img{
    max-width:300px;
    width:100%;
    border-radius:12px;
    display:block;
    margin-top:10px;
}

.btn-primary{
    padding:14px 24px;
    border:none;
    border-radius:12px;
    background:#2957A4;
    color:white;
    font-size:15px;
    font-weight:600;
    cursor:pointer;
}

.btn-primary:hover{
    opacity:.9;
}
</style>