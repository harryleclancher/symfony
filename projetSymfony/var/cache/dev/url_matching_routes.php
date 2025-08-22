<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/_profiler' => [[['_route' => '_profiler_home', '_controller' => 'web_profiler.controller.profiler::homeAction'], null, null, null, true, false, null]],
        '/_profiler/search' => [[['_route' => '_profiler_search', '_controller' => 'web_profiler.controller.profiler::searchAction'], null, null, null, false, false, null]],
        '/_profiler/search_bar' => [[['_route' => '_profiler_search_bar', '_controller' => 'web_profiler.controller.profiler::searchBarAction'], null, null, null, false, false, null]],
        '/_profiler/phpinfo' => [[['_route' => '_profiler_phpinfo', '_controller' => 'web_profiler.controller.profiler::phpinfoAction'], null, null, null, false, false, null]],
        '/_profiler/xdebug' => [[['_route' => '_profiler_xdebug', '_controller' => 'web_profiler.controller.profiler::xdebugAction'], null, null, null, false, false, null]],
        '/_profiler/open' => [[['_route' => '_profiler_open_file', '_controller' => 'web_profiler.controller.profiler::openAction'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'app_accueil', '_controller' => 'App\\Controller\\AccueilController::index'], null, null, null, false, false, null]],
        '/magasin/listProd' => [[['_route' => 'app_magasin_list', '_controller' => 'App\\Controller\\MagasinController::index'], null, null, null, false, false, null]],
        '/magasin/add' => [[['_route' => 'app_magasin_add', '_controller' => 'App\\Controller\\MagasinController::addLivre'], null, null, null, false, false, null]],
        '/profil/list' => [[['_route' => 'app_profil_list', '_controller' => 'App\\Controller\\ProfilController::index'], null, null, null, false, false, null]],
        '/profil/add' => [[['_route' => 'app_profil_add', '_controller' => 'App\\Controller\\ProfilController::addProfil'], null, null, null, false, false, null]],
        '/security/login' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\SecurityController::login'], null, null, null, false, false, null]],
        '/security/addusertest' => [[['_route' => 'app_add_user', '_controller' => 'App\\Controller\\SecurityController::AddUserTest'], null, null, null, false, false, null]],
        '/logout' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\SecurityController::logout'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_(?'
                    .'|error/(\\d+)(?:\\.([^/]++))?(*:38)'
                    .'|wdt/([^/]++)(*:57)'
                    .'|profiler/([^/]++)(?'
                        .'|/(?'
                            .'|search/results(*:102)'
                            .'|router(*:116)'
                            .'|exception(?'
                                .'|(*:136)'
                                .'|\\.css(*:149)'
                            .')'
                        .')'
                        .'|(*:159)'
                    .')'
                .')'
                .'|/magasin/(?'
                    .'|viewProd/([1-9]\\d*)(*:200)'
                    .'|delete/([1-9]\\d*)(*:225)'
                    .'|edit/([1-9]\\d*)(*:248)'
                .')'
                .'|/profil/(?'
                    .'|view/([1-9]\\d*)(*:283)'
                    .'|delete/([1-9]\\d*)(*:308)'
                    .'|edit/([1-9]\\d*)(*:331)'
                .')'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        38 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        57 => [[['_route' => '_wdt', '_controller' => 'web_profiler.controller.profiler::toolbarAction'], ['token'], null, null, false, true, null]],
        102 => [[['_route' => '_profiler_search_results', '_controller' => 'web_profiler.controller.profiler::searchResultsAction'], ['token'], null, null, false, false, null]],
        116 => [[['_route' => '_profiler_router', '_controller' => 'web_profiler.controller.router::panelAction'], ['token'], null, null, false, false, null]],
        136 => [[['_route' => '_profiler_exception', '_controller' => 'web_profiler.controller.exception_panel::body'], ['token'], null, null, false, false, null]],
        149 => [[['_route' => '_profiler_exception_css', '_controller' => 'web_profiler.controller.exception_panel::stylesheet'], ['token'], null, null, false, false, null]],
        159 => [[['_route' => '_profiler', '_controller' => 'web_profiler.controller.profiler::panelAction'], ['token'], null, null, false, true, null]],
        200 => [[['_route' => 'app_magasin_view', '_controller' => 'App\\Controller\\MagasinController::viewLivre'], ['id'], null, null, false, true, null]],
        225 => [[['_route' => 'app_magasin_delete', '_controller' => 'App\\Controller\\MagasinController::deleteAction'], ['id'], null, null, false, true, null]],
        248 => [[['_route' => 'app_magasin_edit', '_controller' => 'App\\Controller\\MagasinController::EditAction'], ['id'], null, null, false, true, null]],
        283 => [[['_route' => 'app_profil_view', '_controller' => 'App\\Controller\\ProfilController::viewProfil'], ['id'], null, null, false, true, null]],
        308 => [[['_route' => 'app_profil_delete', '_controller' => 'App\\Controller\\ProfilController::deleteAction'], ['id'], null, null, false, true, null]],
        331 => [
            [['_route' => 'app_profil_edit', '_controller' => 'App\\Controller\\ProfilController::EditAction'], ['id'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
