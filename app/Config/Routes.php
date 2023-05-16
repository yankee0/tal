<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Authentification');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Authentification::index');
$routes->post('/connexion', 'Authentification::connexion');
$routes->get('/(:any)/deconnexion', 'Authentification::deconnexion');

$routes->group('', ['filter' => 'session-check'], function ($routes) {
    $routes->get('redirection', 'Authentification::redirection');

    //super admin filter
    $routes->group('super-admin', ['filter' => 'super-admin'], function ($routes) {

        $routes->get('/', 'SuperAdmin::index');

        $routes->get('utilisateurs', 'Admin::liste_utilisateurs');
        $routes->post('utilisateurs/nouveau', 'Admin::nouvel_utilisateur');
        $routes->get('utilisateurs/supprimer/(:segment)', 'Admin::supprimer_utilisateur/$1');
        $routes->get('utilisateurs/reset/(:segment)', 'Admin::reset_utilisateur/$1');

        $routes->get('chauffeurs', 'Admin::liste_chauffeurs');
        $routes->post('chauffeurs/nouveau', 'Admin::nouveau_chauffeur');
        $routes->get('chauffeurs/supprimer/(:segment)', 'Admin::supprimer_chauffeur/$1');

        $routes->get('tracteurs', 'Admin::liste_tracteurs');
        $routes->post('tracteurs/nouveau', 'Admin::nouveau_tracteur');
        $routes->get('tracteurs/supprimer/(:segment)', 'Admin::supprimer_tracteur/$1');
        $routes->get('tracteurs/(:segment)','Admin::dossier_tracteur/$1');
        $routes->add('tracteurs/(:segment)/(:segment)','Admin::handle_t_controle/$1/$2');
        $routes->get('modifier/tracteurs/(:segment)','Admin::modifier_tracteur/$1');
        $routes->post('modifier/tracteurs/(:segment)','Admin::save_tracteur/$1');

        $routes->get('remorques', 'Admin::liste_remorques');
        $routes->post('remorques/nouveau', 'Admin::nouveau_remorque');
        $routes->get('remorques/supprimer/(:segment)', 'Admin::supprimer_remorque/$1');
        $routes->get('remorques/(:segment)','Admin::dossier_remorque/$1');
        $routes->add('remorques/(:segment)/(:segment)','Admin::handle_r_controle/$1/$2');
        $routes->get('modifier/remorques/(:segment)','Admin::modifier_remorque/$1');
        $routes->post('modifier/remorques/(:segment)','Admin::save_remorque/$1');

        $routes->get('livraisons','SuperAdmin::livraisons');
        $routes->get('transferts','SuperAdmin::transferts');

        $routes->group('gen', function($routes)
        {
            $routes->get('transfert','Ops::generateMonthlyReportTransfert');
            $routes->get('livraison','Ops::generateMonthlyReportLivraison');
        });

        $routes->group('transfert', function($routes)
        {
            $routes->get('supprimer/(:segment)','Ops::suprimmer_transfert/$1');

        });
        $routes->group('livraisons', function($routes)
        {
            $routes->get('supprimer/(:segment)','Ops::suprimmer_livraison/$1');
        });

    });

    //Admin Filter
    $routes->group('admin', ['filter' => 'admin'], function ($routes) {
        $routes->get('/', 'Admin::index');

        $routes->get('utilisateurs', 'Admin::liste_utilisateurs');
        $routes->post('utilisateurs/nouveau', 'Admin::nouvel_utilisateur');
        $routes->get('utilisateurs/supprimer/(:segment)', 'Admin::supprimer_utilisateur/$1');
        $routes->get('utilisateurs/reset/(:segment)', 'Admin::reset_utilisateur/$1');


        $routes->get('chauffeurs', 'Admin::liste_chauffeurs');
        $routes->post('chauffeurs/nouveau', 'Admin::nouveau_chauffeur');
        $routes->get('chauffeurs/supprimer/(:segment)', 'Admin::supprimer_chauffeur/$1');

        $routes->get('tracteurs', 'Admin::liste_tracteurs');
        $routes->post('tracteurs/nouveau', 'Admin::nouveau_tracteur');
        $routes->get('tracteurs/supprimer/(:segment)', 'Admin::supprimer_tracteur/$1');
        $routes->get('tracteurs/(:segment)','Admin::dossier_tracteur/$1');
        $routes->add('tracteurs/(:segment)/(:segment)','Admin::handle_t_controle/$1/$2');
        $routes->get('modifier/tracteurs/(:segment)','Admin::modifier_tracteur/$1');
        $routes->post('modifier/tracteurs/(:segment)','Admin::save_tracteur/$1');

        $routes->get('remorques', 'Admin::liste_remorques');
        $routes->post('remorques/nouveau', 'Admin::nouveau_remorque');
        $routes->get('remorques/supprimer/(:segment)', 'Admin::supprimer_remorque/$1');
        $routes->get('remorques/(:segment)','Admin::dossier_remorque/$1');
        $routes->add('remorques/(:segment)/(:segment)','Admin::handle_r_controle/$1/$2');
        $routes->get('modifier/remorques/(:segment)','Admin::modifier_remorque/$1');
        $routes->post('modifier/remorques/(:segment)','Admin::save_remorque/$1');

        $routes->get('transferts','SuperAdmin::transferts');
        $routes->get('livraisons','SuperAdmin::livraisons');

        
    });

    //OPS
    $routes->group('ops',['filter' => 'ops'], function($routes)
    {
        $routes->get('/','Ops::index');
        $routes->group('livraisons', function($routes)
        {
            $routes->get('/','Ops::nouvelle_livraison');
            $routes->add('innacheves','Ops::liste_livraison');
            $routes->post('ajout','Ops::save_livraison');
            $routes->post('complement','Ops::complement_livraison');
            $routes->get('supprimer/(:segment)','Ops::suprimmer_livraison/$1');
        });

        $routes->group('transfert', function($routes)
        {
            $routes->get('/','Ops::nouveau_transfert');
            $routes->get('non-eirs','Ops::non_eirs_transfert');
            $routes->post('ajouter','Ops::ajouter_transfert');
            $routes->get('supprimer/(:segment)','Ops::suprimmer_transfert/$1');
            $routes->get('marque/(:segment)','Ops::marquer_transfert/$1');

        });
        $routes->group('gen', function($routes)
        {
            $routes->get('transfert','Ops::generateMonthlyReportTransfert');
            $routes->get('livraison','Ops::generateMonthlyReportLivraison');
        });
    });

    //Facturation
    $routes->get('/(:segment)/rapports','Facturation::index');
    $routes->post('/(:segment)/rapportsclass','Rapports::index');
    $routes->get('/facturation','Facturation::index');
    $routes->post('/(:segment)/rapports','Facturation::generate');
    $routes->post('/facturation','Facturation::generate');

});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
