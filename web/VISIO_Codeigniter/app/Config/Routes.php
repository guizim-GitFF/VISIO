<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// ----------------------------------------------------
// PÁGINAS PÚBLICAS / INSTITUCIONAIS
// ----------------------------------------------------
$routes->get('/',            'InicioController::index');
$routes->get('/sobre',       'SobreController::index');
$routes->get('/identificador','IdentificadorController::index');

// Catálogo de Sensores (público — apenas leitura)
$routes->get('/sensor',        'SensorController::index');
$routes->get('/sensor/(:num)', 'SensorController::detalhe/$1');

// ----------------------------------------------------
// AUTENTICAÇÃO (LOGIN / LOGOUT / CADASTRO)
// ----------------------------------------------------
$routes->get('/login',        'AuthController::index');
$routes->post('/login',       'AuthController::loginUsuario');
$routes->get('/login/admin',  'AuthController::loginAdminForm');
$routes->post('/login/admin', 'AuthController::loginAdmin');
$routes->get('/logout',       'AuthController::logout');

$routes->get('/usuario/cadastro',  'UsuarioController::cadastroForm');
$routes->get('/usuario/esqueceu_senha',  'UsuarioController::esqueceu_senha');

$routes->post('/usuario/cadastro', 'UsuarioController::cadastrar');

// ----------------------------------------------------
// ÁREA RESTRITA: USUÁRIO LOGADO
// Filtro 'userAuth' protege todas as rotas deste grupo
// ----------------------------------------------------
$routes->group('', ['filter' => 'userAuth'], function ($routes) {

    // Área inicial do usuário
    $routes->get('inicio', 'UsuarioController::inicio');

    // Perfil
    $routes->get('perfil',  'UsuarioController::perfil');
    $routes->post('perfil', 'UsuarioController::atualizarPerfil');

    // Histórico de respostas (rota única — duplicata removida)
    $routes->get('historico', 'RespostaController::historico');
    $routes->get('resposta/excluir/(:num)', 'RespostaController::excluir/$1');

    // Quiz
    $routes->get('quiz',           'QuizController::index');
    $routes->get('quiz/pergunta',  'QuizController::pergunta');
    $routes->post('quiz/responder','QuizController::responder');
    $routes->get('quiz/resultado', 'QuizController::resultado');
});

// ----------------------------------------------------
// ÁREA RESTRITA: PAINEL ADMINISTRATIVO
// Filtro 'adminAuth' garante acesso apenas a administradores
// ----------------------------------------------------
$routes->group('admin', ['filter' => 'adminAuth'], function ($routes) {

    // Dashboard
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('perfil',    'AdminController::perfil');

    // Gestão de Usuários 
    $routes->get('usuarios',                    'AdminController::usuarios');
    $routes->get('usuario/excluir/(:any)',       'AdminController::excluirUsuario/$1');

    // Gestão de Sensores
    $routes->get('sensores',                    'AdminController::sensores');
    $routes->get('sensor/novo',                 'AdminController::novoSensorForm');
    $routes->post('sensor/inserir',             'AdminController::inserirSensor');
    $routes->get('sensor/editar/(:num)',         'AdminController::editarSensorForm/$1');
    $routes->post('sensor/atualizar/(:num)',     'AdminController::atualizarSensor/$1');
    $routes->get('sensor/excluir/(:num)',        'AdminController::excluirSensor/$1');

    // Gestão de Perguntas e Alternativas
    $routes->get('perguntas',                   'AdminController::perguntas');
    $routes->get('pergunta/nova',               'AdminController::novaPerguntaForm');
    $routes->post('pergunta/inserir',           'AdminController::inserirPergunta');
    $routes->get('pergunta/editar/(:num)',       'AdminController::editarPerguntaForm/$1');
    $routes->post('pergunta/atualizar/(:num)',   'AdminController::atualizarPergunta/$1');
    $routes->get('pergunta/excluir/(:num)',      'AdminController::excluirPergunta/$1');

    // Histórico Geral de Respostas
    $routes->get('respostas',                   'AdminController::respostas');
});
