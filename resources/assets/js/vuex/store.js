import Vue from 'vue'
import Vuex from 'vuex'
import preloader from './modules/preloader/index'

import categories from './modules/categories/index'
import products from "./modules/products";
import auth from "./modules/auth/auth";
import profile from "./modules/users/profile"
import cart from './modules/cart/index'
import chartProducts from './modules/charts/chatsProducts'


Vue.use(Vuex)

export default  new Vuex.Store({
    modules: {
        auth,
        categories,
        products,
        profile,
        cart,
        chartProducts,
        preloader
    }
})
