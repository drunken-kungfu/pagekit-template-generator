
window.Index = {
  // Do the Vue

  el: '#{{ module_name }}',

  components: {
    '{{ module_name }}-component': require('./index.vue')
  }
};
Vue.ready(window.Index);
