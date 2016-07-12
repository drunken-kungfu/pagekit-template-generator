<?php

use Pagekit\Application as App;

/*
 * This array is the module definition.
 * It's used by Pagekit to load your extension and register all things
 * that your extension provides (routes, menu items, php classes etc)
 */
return [

    /*
     * Unique extension name
     */
    'name' => '{{ module_name }}',

    /*
     * Define the type of this module.
     * Has to be 'extension' here. Can be 'theme' for a theme.
     */
    'type' => 'extension',

    /*
     * Main entry point. Called when your extension is both installed and activated.
     * Either assign an closure or a string that points to a PHP class.
     * Example: 'main' => '{{ vendor_name_u }}\\{{ module_name_u }}\\HelloWorldExtension'
     */
    'main' => function (App $app) {

    },

    /*
     * Register all namespaces to be loaded.
     * Map from namespace to folder where the classes are located.
     * Remember to escape backslashes with a second backslash.
     */
    'autoload' => [
        '{{ vendor_name_u }}\\{{ module_name_u }}\\' => 'src'
    ],

    /*
     * Define nodes. A node is similar to a route with the difference
     * that it can be placed anywhere in the menu structure. The
     * resulting route is therefore determined on runtime.
     */
    'nodes' => [

        '{{ module_name }}' => [

            // The name of the node route
            'name' => '@{{ module_name }}',

            // Label to display in the backend
            'label' => '{{ module_name_u }}',

            // The controller for this node. Each controller action will be mounted
            'controller' => '{{ vendor_name_u }}\\{{ module_name_u }}\\Controller\\{{ module_name_u }}Controller',

            // Optional: Prevent node from being removed. Will end up in "not linked" menu instead
            'protected' => true,

            'fontpage' => true
        ]

    ],

    /*
     * Define resources.
     * Register prefixes to be used as shorter versions when working with paths.
     */
    'resources' => [
        '{{ module_name }}:' => ''
    ],

    /*
     * Define routes.
     */
    'routes' => [
        '@{{ module_name }}' => [
            'path' => '/{{ module_name }}',
            'controller' => '{{ vendor_name_u }}\\{{ module_name_u }}\\Controller\\{{ module_name_u }}Controller'
        ]
    ],

    /*
     * Define permissions.
     * Will be listed in backend and can then be assigned to certain roles.
     */
    'permissions' => [
        // Unique name.
        // Convention: extension name and speaking name of this permission (spaces allowed)
        '{{ module_name }}: manage settings' => [
            'title' => 'Manage settings'
        ],
    ],

    /*
     * Define menu items for the backend.
     */
    'menu' => [

        // name, can be used for menu hierarchy
        '{{ module_name }}' => [

            // Label to display
            'label'  => '{{ module_name_u }}',

            // Icon to display
            'icon'   => 'app/system/assets/images/placeholder-icon.svg',

            // URL this menu item links to
            'url'    => '@{{ module_name }}/admin',

            // Set the order this item is placed in the menu
            'priority' => 110

            // Optional: Expression to check if menu item is active on current url
            // 'active' => '@{{ module_name }}*'

            // Optional: Limit access to roles which have specific permission assigned
            // 'access' => '{{ module_name }}: manage index'
        ],

        '{{ module_name }}: panel' => [

            // Parent menu item, makes this appear on 2nd level
            'parent' => '{{ module_name }}',

            // See above
            'label' => '{{ module_name_u }}',
            'url' => '@{{ module_name }}/admin'
            // 'access' => '{{ name }}: manage hellos'
        ],

        '{{ module_name }}: settings' => [
            'parent' => '{{ module_name }}',
            'label' => '{{ module_name_u }} Settings',
            'url' => '@{{ module_name }}/settings',
            'access' => 'system: manage settings'
        ]
    ],

    /*
     * Link to a settings screen from the extensions listing.
     */
    'settings' => '@{{ name }}/admin/settings',

    /*
     * Default module configuration.
     * Can be overwritten by changed config during runtime.
     */
    'config' => [
        'default' => [
            'Hello',
            'world!'
        ],
        'foo' => 'bar'
    ],

    /*
     * Listen to events.
     * https://pagekit.com/docs/developer/events
     */
    'events' => [
        'boot' => function($event, $app) {
            // The boot phase of the Pagekit application has started.
        }
    ]
];
