
<?php $view->script('index', '{{ module_name }}:app/bundle/index.bundle.js', ['vue']); ?>
<?php $view->style('analyze-css', '{{ module_name }}:app/assets/styles/index.css'); ?>

<div id="{{ module_name }}">
  <div class="uk-panel">
    Your module has been created. Run <code>npm install</code> then <code>webpack</code> in the package directory to compile the javascript.
  </div>
  <{{ module_name }}-component></{{ module_name }}-component>
</div>