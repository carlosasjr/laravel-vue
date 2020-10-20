import Vue from 'vue'
import VueRouter from 'vue-router'
import CategoriesComponent from "../components/admin/pages/Category/CategoriesComponent";

Vue.use(VueRouter)

const routes = [
    {path: '/categories', component: CategoriesComponent, name: 'categories'}
]

export default new VueRouter({
    mode: 'history',
    routes
})

