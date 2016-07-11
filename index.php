<?php

use Pagekit\Application as App;

return [

  'name' => 'template-generator',

  'type' => 'console',

  'require' => 'application',

  'main' => function (App $app) {
  },

  'autoload' => [
    'KungFu\\Boil\\' => 'src'
  ],

  'config' => [

    // name => path to render to
    'templates' => [
      'index.php',
      'README.md',
      '.gitignore',
      'scripts.php',
      'package.json',
      'composer.json',
      'webpack.config.js',
      'views/index.php',
      'app/assets/styles/index.css',
      'app/components/my-component/index.js',
      'app/components/my-component/index.vue',
      'app/mixins/mixins.js'
    ],

    'structure' => [
      'views',
      'src/Controller',
      'app/components/',
      'app/components/my-component',
      'app/mixins/',
      'app/assets/styles',
    ]
  ],

  'events' => [

    'console.init' => function ($event, $console) {

      $namespace = 'KungFu\\Boil\\Commands\\';

      foreach (glob(__DIR__ . '/src/Commands/*Command.php') as $file) {
        $class = $namespace . basename($file, '.php');
        $console->add(new $class);
      }
    }
  ]
];
