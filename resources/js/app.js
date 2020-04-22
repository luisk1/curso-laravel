require('./bootstrap');


window.Vue = require('vue');
import BootstrapVue from "bootstrap-vue";
import "bootstrap-vue/dist/bootstrap-vue.css";
Vue.use(BootstrapVue);
import swal from 'sweetalert';
import { ValidationProvider } from 'vee-validate';
import { extend } from 'vee-validate';
import { required, email, alpha, alpha_dash, numeric, alpha_spaces } from 'vee-validate/dist/rules';
extend('email', {
   ...email,
      message: 'favor introduzca un correo valido'
});
extend('required', {
  ...required,
  message: 'este campo es requerido'
});
extend('alpha', {
   ...alpha,
      message: 'favor solo introducir letras'
});
extend('alpha_dash', {
   ...alpha_dash,
      message: 'No estan permitidos caracteres especiales solo letras y numeros'
});
extend('numeric', {
   ...numeric,
      message: 'favor solo introducir numeros'
});
extend('alpha_spaces', {
   ...alpha_spaces,
      message: 'solo se aceptan letras y espacios'
});
Vue.component('ValidationProvider',ValidationProvider);
Vue.component('crearusu',require('./components/crearusuarioComponent.vue').default);
Vue.component('login',require('./components/crearusuarioComponent.vue').default);
Vue.component('prueba',require('./components/pruebaComponent.vue').default);
Vue.component('crear',require('./components/LoginComponent.vue').default);
Vue.component('ordencompra',require('./components/gestionarorden.vue').default);
Vue.component('modal',{template:'#modal-template'});
Vue.component('cita',require('./components/gestionarcita.vue').default);
Vue.component('ordencita',require('./components/ordenxcita.vue').default);
Vue.component('crearusu',require('./components/gestionarusuario.vue').default);
Vue.component('usuario',require('./components/crearusuarioComponent.vue').default);
Vue.component('atendercita',require('./components/atendercita.vue').default);
Vue.component('reportes',require('./components/reportes.vue').default);

Vue.config.devtools = false
Vue.config.productionTip = false
 new Vue({
    el: '#app',
    
    });
    Vue.config.devtools = true;