<?php

use Pagekit\Application as App;

return [

    'install' => function($app) {

        $util = $app['db']->getUtility();

    },

    'enable' => function($app) {

    },

    'updates' => [

    ],

    'disable' => function ($app) {

    },

    'uninstall' => function ($app) {

    }
];