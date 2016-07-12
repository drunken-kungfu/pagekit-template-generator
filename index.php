<?php

use Pagekit\Application as App;

return [

  'name' => 'template-generator',

  'type' => 'console',

  'require' => 'application',

  'main' => function (App $app) {
  },

  'autoload' => [
    'KungFu\\Generate\\' => 'src'
  ],

  'config' => [

    'templates' => [

      'extension' => [
          'index.php',
          'README.md',
          '.gitignore',
          'scripts.php',
          'package.json',
          'composer.json',
          'views/index.php',
          'webpack.config.js',
          'app/mixins/mixins.js',
          'views/admin/index.php',
          'views/admin/settings.php',
          'app/assets/styles/index.css',
          'app/components/my-component/index.js',
          'app/components/my-component/index.vue'
      ]
    ],

    'structure' => [
        'views',
        'views/admin/',
        'app/mixins/',
        'src/Controller/',
        'app/components/',
        'app/assets/styles/',
        'app/components/my-component/'
    ]
  ],

  'events' => [

    'console.init' => function ($event, $console) {

      $namespace = 'KungFu\\Generate\\Commands\\';

      foreach (glob(__DIR__ . '/src/Commands/*Command.php') as $file) {
        $class = $namespace . basename($file, '.php');
        $console->add(new $class);
      }
    }
  ]
];
