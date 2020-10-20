window.Vue = require('vue');

import router from './routes/routers'
import store from './vuex/store'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

Vue.use(BootstrapVue)

Vue.component('app-component', require('./components/App').default)

const app= new Vue ({
    router,
    store,
    el: '#app',
});
