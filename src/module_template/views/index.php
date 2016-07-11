
<?php $view->script('index', '{{ module_name }}:app/bundle/index.bundle.js', ['vue']); ?>
<?php $view->style('analyze-css', '{{ module_name }}:app/assets/styles/index.css'); ?>

<div id="{{ module_name }}">
  <{{ module_name }}-component></{{ module_name }}-component>
</div>