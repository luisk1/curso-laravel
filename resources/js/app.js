require('./bootstrap');


window.Vue = require('vue');
import swal from 'sweetalert';
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

Vue.config.devtools = false
Vue.config.productionTip = false
 new Vue({
    el: '#app',
    
    });
    Vue.config.devtools = true;