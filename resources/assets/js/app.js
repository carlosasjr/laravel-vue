require('./bootstrap');

window.Vue = require('vue');

import router from './routes/routers'
import store from './vuex/store'
import BootstrapVue from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import Snotify from 'vue-snotify'


Vue.use(BootstrapVue)
Vue.use(Snotify, {toast: {showProgressBar: false}});

Vue.component('admin-component', require('./components/admin/AdminComponent').default)
Vue.component('preloader-component', require('./components/layouts/PrealoaderComponent').default)



const app= new Vue ({
    router,
    store,
    el: '#app',
});

store.dispatch('loadCategories')
store.dispatch('checkLogin')
     .then(response => router.push({name: store.state.auth.url_back}))
     .catch(() => {})
