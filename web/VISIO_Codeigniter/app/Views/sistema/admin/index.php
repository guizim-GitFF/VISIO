<?= view('sistema/layout/header_adm') ?>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', sans-serif;
        }

        :root {

            --bg: #f1f5f9;
            --card: #ffffff;
            --text: #0f172a;
            --text2: #64748b;
            --border: #e2e8f0;

            --primary: #2563eb;
            --success: #22c55e;
            --danger: #ef4444;
            --warning: #f59e0b;

            --sidebar: #0f172a;
            --sidebar2: #111827;

            --shadow: 0 10px 25px rgba(0,0,0,0.08);
        }

        body.dark {

            --bg: #0b1120;
            --card: #111827;
            --text: #f8fafc;
            --text2: #94a3b8;
            --border: #1e293b;

            --sidebar: #020617;
            --sidebar2: #0f172a;

            --shadow: 0 10px 25px rgba(0,0,0,0.3);
        }

        body {
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            transition: 0.3s;
        }

        .layout {
            display: flex;
        }

        /* SIDEBAR */

        .sidebar {
            width: 280px;
            height: 100vh;
            background: linear-gradient(180deg, var(--sidebar), var(--sidebar2));
            position: fixed;
            left: 0;
            top: 0;
            padding: 25px;
            overflow-y: auto;
            z-index: 1000;
        }

        .logo-area {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 40px;
        }

        .logo-area img {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            object-fit: cover;
        }

        .logo-area h2 {
            color: white;
            font-size: 28px;
        }

        .menu-title {
            color: #64748b;
            text-transform: uppercase;
            font-size: 12px;
            margin-bottom: 15px;
            letter-spacing: 1px;
        }

        .menu {
            list-style: none;
        }

        .menu li {
            margin-bottom: 10px;
        }

        .menu a {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 15px;
            border-radius: 14px;
            text-decoration: none;
            color: #e2e8f0;
            transition: 0.3s;
            font-weight: 500;
        }

        /* MAIN */

        .main {
            width: calc(100% - 280px);
            margin-left: 280px;
        }

        /* HEADER */

        header {
            height: 90px;
            background: var(--card);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 999;
            box-shadow: 0 4px 20px rgba(0,0,0,0.04);
        }

        .top-nav {
            width: 100%;
            max-width: 1600px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .nav-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .nav-left h1 {
            font-size: 24px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 20px;
            list-style: none;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text);
            font-weight: 600;
            transition: 0.3s;
            
        }

        .nav-links a:hover {
            color: var(--primary);
        }

        #theme-toggle {
            width: 42px;
            height: 42px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            transition: 0.3s;
            font-size: 16px;
        }

        #theme-toggle:hover {
            transform: scale(1.05);
        }

        /* CONTENT */

        .content {
            padding: 30px;
            max-width: 1600px;
            margin: auto;
        }

        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 20px;
        }

        .topbar h1 {
            font-size: 34px;
            margin-bottom: 8px;
        }

        .topbar p {
            color: var(--text2);
        }

        .profile-box {
            display: flex;
            align-items: center;
            gap: 15px;
            background: var(--card);
            padding: 12px 18px;
            border-radius: 18px;
            box-shadow: var(--shadow);
        }

        .profile-box img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }

        /* CARDS */

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background: var(--card);
            border-radius: 22px;
            padding: 24px;
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
        }

        .primary::before {
            background: var(--primary);
        }

        .success::before {
            background: var(--success);
        }

        .warning::before {
            background: var(--warning);
        }

        .danger::before {
            background: var(--danger);
        }

        .card-primary {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        

        .card-top i {
            width: 55px;
            height: 55px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
         
            font-size: 22px;
        }

        .primary i {
            background: var(--primary);
        }

        .success i {
            background: var(--success);
        }

        .warning i {
            background: var(--warning);
        }

        .danger i {
            background: var(--danger);
        }

        .card h3 {
            font-size: 14px;
            color: var(--text2);
            margin-bottom: 10px;
        }

        .card h2 {
            font-size: 35px;
            margin-bottom: 8px;
        }

        .trend {
            font-size: 14px;
            font-weight: 600;
        }

        .up {
            color: var(--success);
        }

        .down {
            color: var(--danger);
        }

        /* CHARTS */

        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }

        .chart-card {
            background: var(--card);
            border-radius: 22px;
            padding: 25px;
            box-shadow: var(--shadow);
        }

        .chart-header {
            margin-bottom: 20px;
        }

        .chart-header h3 {
            margin-bottom: 5px;
        }

        .chart-header span {
            color: var(--text2);
        }

        canvas {
            width: 100% !important;
        }

        /* TABLE */

        .bottom-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr;
            gap: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            text-align: left;
            padding-bottom: 18px;
            color: var(--text2);
        }

        table td {
            padding: 15px 0;
            border-top: 1px solid var(--border);
        }

        .student {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .student img {
            width: 42px;
            height: 42px;
            border-radius: 50%;
        }

        .badge {
            padding: 7px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
        }

        .gold {
            background: rgba(245, 158, 11, 0.2);
            color: #f59e0b;
        }

        .silver {
            background: rgba(148, 163, 184, 0.2);
            color: #94a3b8;
        }

        .bronze {
            background: rgba(180, 83, 9, 0.2);
            color: #b45309;
        }

        /* RESPONSIVO */

        @media(max-width: 1200px) {

            .charts-grid,
            .bottom-grid {
                grid-template-columns: 1fr;
            }
        }

        @media(max-width: 900px) {

            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }

            .main {
                width: 100%;
                margin-left: 0;
            }

            .layout {
                flex-direction: column;
            }

            .top-nav {
                flex-direction: column;
                gap: 20px;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }

            .content {
                padding: 20px;
            }
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

        <!-- MAIN -->
        <div class="main">

            <!-- CONTENT -->
            <div class="content">
                <div class="topbar">
                    <div>
                        <h1>Dashboard Educacional</h1>
                        <p>Monitoramento completo da plataforma em tempo real.</p>
                    </div>
                    
                    <br><br><Br>
                    <div class="profile-box">
                        <img src="https://i.pravatar.cc/100" alt="">
                        <div>
                            <h4>Administrador VISIO</h4>
                            <span>Gestão educacional</span>
                        </div>
                    </div>

                </div>

                <!-- CARDS -->

                <section class="stats-grid">

                    <div class="card primary">

                        <div class="card-top">

                            <div>
                                <h3>Total de alunos</h3>
                                <h2>2.845</h2>
                                
                                <span class="trend up">+12% este mês</span>
                                <br>
                            </div>

                            <i class="fa-solid fa-user-graduate"></i>

                        </div>

                    </div>

                    <div class="card success">

                        <div class="card-top">

                            <div>
                                <h3>Questões respondidas</h3>
                                <h2>18.920</h2>
                                <span class="trend up">+18% esta semana</span>
                                <br>
                            </div>

                            <i class="fa-solid fa-circle-check"></i>

                        </div>

                    </div>

                    <div class="card warning">

                        <div class="card-top">

                            <div>
                                <h3>Taxa média de acertos</h3>
                                <h2>78%</h2>
                                <span class="trend up">+5% evolução</span>
                                
                            </div>

                            <i class="fa-solid fa-chart-pie"></i>

                        </div>

                    </div>

                    <div class="card danger">

                        <div class="card-top">

                            <div>
                                <h3>Questões difíceis</h3>
                                <h2>32</h2>
                                <span class="trend down">Necessitam revisão</span>
                            </div>

                            <i class="fa-solid fa-triangle-exclamation"></i>

                        </div>

                    </div>

                </section>

                <!-- CHARTS -->

                <section class="charts-grid">

                    <div class="chart-card">

                        <div class="chart-header">
                            <h3>Desempenho dos alunos</h3>
                            <span>Evolução semanal</span>
                        </div>

                        <canvas id="performanceChart"></canvas>

                    </div>

                    <div class="chart-card">

                        <div class="chart-header">
                            <h3>Acertos x Erros</h3>
                            <span>Questões respondidas</span>
                        </div>

                        <canvas id="questionsChart"></canvas>

                    </div>

                    

                </section>

                <!-- ADICIONE ISSO ABAIXO DA PRIMEIRA SECTION charts-grid -->

<section class="charts-grid">

    <!-- QUESTÕES MAIS ACERTADAS -->

    <div class="chart-card">

        <div class="chart-header">
            <h3>Questões mais acertadas</h3>
            <span>Conteúdos com melhor desempenho</span>
        </div>

        <canvas id="correctChart"></canvas>

    </div>

    <!-- QUESTÕES MAIS ERRADAS -->

    <div class="chart-card">

        <div class="chart-header">
            <h3>Questões mais erradas</h3>
            <span>Conteúdos com maior dificuldade</span>
        </div>

        <canvas id="wrongChart"></canvas>

    </div>

</section>

<!-- RANKING + ATIVIDADES -->

<section class="bottom-grid">

    <!-- RANKING -->

    <div class="chart-card">

        <div class="chart-header">
            <h3>Alunos destaque</h3>
            <span>Ranking de desempenho</span>
        </div>

        <table>

            <thead>

                <tr>
                    <th>Aluno</th>
                    <th>Curso</th>
                    <th>Média</th>
                    <th>Status</th>
                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>

                        <div class="student">

                            <img src="https://i.pravatar.cc/100?img=5">

                            Fernanda Silva

                        </div>

                    </td>

                    <td>IoT</td>

                    <td>98%</td>

                    <td>
                        <span class="badge gold">
                            1º Lugar
                        </span>
                    </td>

                </tr>

                <tr>

                    <td>

                        <div class="student">

                            <img src="https://i.pravatar.cc/100?img=15">

                            Lucas Andrade

                        </div>

                    </td>

                    <td>Programação</td>

                    <td>95%</td>

                    <td>
                        <span class="badge silver">
                            2º Lugar
                        </span>
                    </td>

                </tr>

                <tr>

                    <td>

                        <div class="student">

                            <img src="https://i.pravatar.cc/100?img=20">

                            Ana Carolina

                        </div>

                    </td>

                    <td>Robótica</td>

                    <td>92%</td>

                    <td>
                        <span class="badge bronze">
                            3º Lugar
                        </span>
                    </td>

                </tr>

            </tbody>

        </table>

    </div>

    <!-- ATIVIDADES -->

    <div class="chart-card">

        <div class="chart-header">
            <h3>Atividades recentes</h3>
            <span>Últimas ações</span>
        </div>

        <div class="activities">

            <div class="activity">

                <i class="fa-solid fa-user-plus"></i>

                <div>

                    <h4>Novo aluno cadastrado</h4>

                    <p>João Pedro entrou no curso de Programação Web.</p>

                    <span>Há 5 minutos</span>

                </div>

            </div>

            <div class="activity">

                <i class="fa-solid fa-book-open"></i>

                <div>

                    <h4>Nova atividade criada</h4>

                    <p>Quiz de sensores IoT foi publicado.</p>

                    <span>Há 20 minutos</span>

                </div>

            </div>

            <div class="activity">

                <i class="fa-solid fa-award"></i>

                <div>

                    <h4>Aluno bateu recorde</h4>

                    <p>Fernanda Silva alcançou 98% de aproveitamento.</p>

                    <span>Há 1 hora</span>

                </div>

            </div>

            <div class="activity">

                <i class="fa-solid fa-server"></i>

                <div>

                    <h4>Sistema atualizado</h4>

                    <p>Novos gráficos adicionados ao dashboard.</p>

                    <span>Hoje</span>

                </div>

            </div>

        </div>

    </div>

</section>

            </div>

        </div>

    </div>

    

    <script>

        /* DARK MODE */

        const toggle = document.getElementById("theme-toggle");

        toggle.addEventListener("click", () => {

            document.body.classList.toggle("dark");

            const icon = toggle.querySelector("i");

            if(document.body.classList.contains("dark")){
                icon.classList.remove("fa-moon");
                icon.classList.add("fa-sun");
            }else{
                icon.classList.remove("fa-sun");
                icon.classList.add("fa-moon");
            }

        });

        /* CHART */

        new Chart(document.getElementById('performanceChart'), {

            type: 'line',

            data: {

                labels: ['Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],

                datasets: [{

                    label: 'Acertos',

                    data: [65, 72, 78, 75, 85, 88, 92],

                    borderColor: '#2563eb',

                    backgroundColor: 'rgba(37,99,235,0.1)',

                    fill: true,

                    tension: 0.4

                }]
            },

            options: {

                responsive: true,

                plugins: {

                    legend: {

                        display: false

                    }

                }

            }

        });

        new Chart(document.getElementById('questionsChart'), {

            type: 'doughnut',

            data: {

                labels: ['Acertos', 'Erros'],

                datasets: [{

                    data: [78, 22],

                    backgroundColor: ['#22c55e', '#ef4444']

                }]
            }

        });

        /* QUESTÕES MAIS ACERTADAS */

new Chart(document.getElementById('correctChart'), {

    type: 'bar',

    data: {

        labels: [
            'HTML',
            'CSS',
            'IoT',
            'Banco de Dados',
            'JavaScript'
        ],

        datasets: [{

            label: 'Acertos',

            data: [95, 91, 88, 85, 82],

            backgroundColor: '#2563eb',

            borderRadius: 8

        }]
    },

    options: {

        responsive: true,

        plugins: {

            legend: {

                display: false

            }

        }

    }

});

/* QUESTÕES MAIS ERRADAS */

new Chart(document.getElementById('wrongChart'), {

    type: 'bar',

    data: {

        labels: [
            'Algoritmos',
            'Física',
            'Redes',
            'Matemática',
            'Lógica'
        ],

        datasets: [{

            label: 'Erros',

            data: [60, 55, 48, 44, 39],

            backgroundColor: '#ef4444',

            borderRadius: 8

        }]
    },
    options: {
        responsive: true,
        plugins: {

            legend: {
                display: false
            }
        }
    }

});
    </script>
</body>
</html>

<?= view('sistema/layout/footer_adm') ?>