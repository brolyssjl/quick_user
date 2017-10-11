
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
require('./init');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('alert', require('./components/Alert.vue'));

const app = new Vue({
  el: '#app',
  methods: {
    deleteUser: function(event){
      const option = confirm('Está seguro de borrarlo?');
      if(option){
        $(event.currentTarget).find('form').submit();
      }
    },
    disabledInput: function(event){
      const $input = $('input#password')
      const $inputConfirm = $('input#confirm-password')
      if($(event.currentTarget).is(':checked')){
        $input.prop('disabled', true)
        $inputConfirm.prop('disabled', true)
      } else {
        $input.prop('disabled', false)
        $inputConfirm.prop('disabled', false)
      }
    }
  }
});
