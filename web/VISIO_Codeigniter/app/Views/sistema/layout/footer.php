<footer class="footer">
    <div class="footer-container">
        <div class="footer-left">
            <img class="logo" src="<?= base_url('assets/images/logos/Icone/IconeDark2.png') ?>"
                data-light="<?= base_url('assets/images/logos/Icone/IconeDark2.png') ?>"
                data-dark="<?= base_url('assets/images/logos/Icone/IconeDark2.png') ?>" alt="Logo">
            <div class="linha-vertical"></div>
            <div class="brand-text">
                <h2>VISIO</h2>
                <p>Plataforma educacional focada em tecnologia, sensores e aprendizado interativo.</p>
            </div>
        </div>
        <div class="footer-right">
            <div class="footer-links">
                <h3>Plataforma</h3>
                <a href="<?= base_url('/') ?>">Início</a>
                <a href="<?= base_url('/sobre') ?>">Sobre</a>
                <a href="<?= base_url('/sensor') ?>">Sensores</a>
                <a href="<?= base_url('/quiz') ?>">Questões</a>
                <a href="<?= base_url('/login/admin') ?>">Login ADM</a>
            </div>
            <div class="footer-contact">
                <h3>Contato</h3>

                <p><i class="fa-solid fa-phone"></i> (19) 99890-8934</p>

                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=visio.suporte@gmail.com" target="_blank"
                    rel="noopener" style="text-decoration:none;">
                    <i class="fa-solid fa-envelope"></i>visio.suporte@gmail.com
                </a>

                <p><i class="fa-solid fa-location-dot"></i> Tambaú - SP</p>

                <div class="social">
                    <a href="https://www.instagram.com/_plataformavisio/" target="_blank" rel="noopener">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="https://github.com/2IDS-A-TAMB-2026/VISIO" target="_blank" rel="noopener">
                        <i class="fa-brands fa-github"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        © 2026 VISIO • Todos os direitos reservados
    </div>
</footer>
<script src="<?= base_url('assets/js/theme.js') ?>"></script>
<script src="<?= base_url('assets/js/validacaocadastro.js') ?>"></script>
<script src="<?= base_url('assets/js/validacaologin.js') ?>"></script>
<script src="<?= base_url('assets/js/validacaoAdm.js') ?>"></script>

</body>

</html>