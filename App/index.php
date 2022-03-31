<?php

use System\Application;

    $app = Application::getInstance();
    $app->share('blogLayout', function ($app) {
        return $app->load->controller('Blog/Common/Layout');
    });
    $app->share('settings', function ($app) {
        $settingsModel = $app->load->model('Settings');
        $settingsModel->loadAll();
        return $settingsModel;
    });



// Blog Routes
$app->route->add('/', 'Blog/Home');
$app->route->add('/register', 'Blog/Register');
$app->route->add('/register/submit', 'Blog/Register@submit', 'POST');
$app->route->add('/login', 'Blog/Login');
$app->route->add('/login/submit', 'Blog/Login@submit', 'POST');
$app->route->add('/logout', 'Blog/Logout');


// Not Found Routes
$app->route->add('/404', 'NotFound');
$app->route->notFound('/404');