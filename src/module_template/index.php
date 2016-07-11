<?php

use Pagekit\Application as App;

/*
 * This array is the module definition.
 */
return [

    // unique module name
    'name' => '{{ module_name }}',

    'type' => 'extension',

    // main point to register custom services and access existing ones
    'main' => function (App $app) {

    },

    // Autoload namespaces from given paths
    'autoload' => [
        '{{ vendor_name_u }}\\{{ module_name_u }}\\' => 'src'
    ],

    'resources' => [
        '{{ module_name }}:' => ''
    ],

    'routes' => [
        '@{{ module_name }}' => [
            'path' => '/{{ module_name }}',
            'controller' => '{{ vendor_name_u }}\\{{ module_name_u }}\\Controller\\{{ module_name_u }}Controller'
        ]
    ],

    'permissions' => [
//        'your: permission' => [
//            'title' => _('Your Permission')
//        ]
    ],

    'menu' => [
        '{{ module_name }}' => [
            'label'  => '{{ module_name_u }}',
            'icon'   => 'app/system/assets/images/placeholder-icon.svg',
            'url'    => '@{{ module_name }}',
            'priority' => 110
        ]
    ],

    // Default module configuration
    'config' => [
    // 'your' => 'config'
    ],

    'events' => [

    ]
];
