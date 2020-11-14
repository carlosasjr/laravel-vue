<template>
    <div>
        <nav-bar-component></nav-bar-component>

        <section class="container">
            <router-view></router-view>
        </section>

        <footer-component></footer-component>
    </div>
</template>

<script>
    import NavBarComponent from "./layouts/NavBarComponent"
    import FooterComponent from "./layouts/FooterComponent";

    export default {
        components: {
            NavBarComponent,
            FooterComponent
        }
    }
</script>

<style scoped>

</style>
