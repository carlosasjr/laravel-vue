import RegisterComponent from "../components/admin/pages/user/RegisterComponent";
import SiteComponent from "../components/site/SiteComponent";
import HomeComponent from "../components/site/pages/home/HomeComponent";
import CartComponent from "../components/site/pages/cart/CartComponent";
import ProductDetailComponent from "../components/site/pages/product/ProductDetailComponent";
import LoginComponent from "../components/admin/login/LoginComponent";
import ContactComponent from "../components/site/pages/contact/ContactComponent";
import AdminComponent from "../components/admin/AdminComponent";
import DashboardComponent from "../components/admin/pages/dashboard/DashboardComponent";
import ProfileComponent from "../components/admin/pages/user/ProfileComponent";
import CategoriesComponent from "../components/admin/pages/category/CategoriesComponent";
import AddCategoryComponent from "../components/admin/pages/category/AddCategoryComponent";
import EditCategoryComponent from "../components/admin/pages/category/EditCategoryComponent";
import ProductsComponent from "../components/admin/pages/product/ProductsComponent";
import ProductReportComponent from "../components/site/pages/reports/ProductReportComponent";
import Error404Component from "../components/layouts/Error404Component";

const routes = [
    {path: '/register', component: RegisterComponent, name: 'register', meta: {auth: false}},

    {
        path: '/',
        component: SiteComponent,
        children: [
            {path: '', component: HomeComponent, name: 'home'},
            {path: 'cart', component: CartComponent, name: 'cart'},
            {path: 'product/:id', component: ProductDetailComponent, name: 'product.detail', props: true},
            {path: 'login', component: LoginComponent, name: 'login', meta: {auth: false}},
            {path: 'contact', component: ContactComponent, name: 'contact'}
        ]
    },


    {   path: '/admin',
        component: AdminComponent,
        meta: {auth: true},
        children: [
            {path: '', component: DashboardComponent, name: 'admin.dashboard'},

            {path: 'update-profile', component: ProfileComponent, name: 'profile'},
            {path: 'categories', component: CategoriesComponent, name: 'admin.categories'},
            {path: 'categories/create', component: AddCategoryComponent, name: 'admin.categories.create'},
            {path: 'categories/:id/edit', component: EditCategoryComponent, name: 'admin.categories.edit', props: true},
            {path: 'products', component: ProductsComponent, name: 'admin.products'},
            {path: 'product-report', component: ProductReportComponent, name: 'product.report'},
        ]
    },

    {path: '*', component: Error404Component}
]

export default routes
