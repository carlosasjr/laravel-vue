<template>
    <div>
        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="#" class="brand-link">
                <img src="#"
                     alt="AdminLTE Logo"
                     class="brand-image img-circle elevation-3"
                     style="opacity: .8">
                <span class="brand-text font-weight-light">AdminLTE 3</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="#" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <router-link class="d-block" :to="{name: 'profile'}">
                            {{ me.name }}
                        </router-link>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                             with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <router-link :to="{name: 'admin.dashboard'}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                Dashboard
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link :to="{name: 'admin.categories'}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                Categorias
                            </router-link>
                        </li>

                        <li class="nav-item">
                            <router-link :to="{name: 'admin.products'}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                Produtos
                            </router-link>
                        </li>

                        <li class="nav-item d-none d-sm-inline-block">
                            <router-link class="nav-link" :to="{name: 'product.report'}">Relatorios</router-link>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>
    </div>
</template>

<script>
    export default {
        computed : {
            me () {
                return this.$store.state.auth.me
            }
        }
    }
</script>

<style scoped>

</style>
