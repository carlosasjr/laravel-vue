<template>
    <div>
        <!-- Navbar -->
        <nav class="navbar navbar-expand navbar-white navbar-light justify-content-between">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <router-link class="nav-link" :to="{name: 'home'}">Home</router-link>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <router-link class="nav-link" :to="{name: 'contact'}">Contato</router-link>
                </li>
            </ul>

            <ul class="navbar-nav">
                <li class="nav-item d-none d-sm-inline-block">
                    <router-link class="nav-link" :to="{name: 'cart'}">
                        <i class="fas fa-shopping-cart"></i>
                        <small>{{ cart.length }}</small>
                    </router-link>
                </li>

                <li class="nav-item d-none d-sm-inline-block">
                    <div v-if="user.name">
                        <router-link class="nav-link" :to="{name: 'admin.dashboard'}">Olá, {{ user.name }}</router-link>
                    </div>

                    <div v-else>
                        <router-link class="nav-link" :to="{name: 'login'}">Login</router-link>
                    </div>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->
    </div>
</template>

<script>
export default {
    computed: {
        cart() {
            return this.$store.state.cart.items.data
        },

        user() {
            return this.$store.state.auth.me
        }
    }
}
</script>

<style scoped>

</style>
