<template>
    <div>
        <table class="table table-dark">
            <thead>
            <tr>
                <td>Imagem</td>
                <td>Produto</td>
                <td width="200">Ações</td>
            </tr>
            </thead>

            <tbody>
            <tr v-for="product in products.data" :key="product.id">
                <td>
                    <div v-if="product.image">
                        <img :src="[`/storage/products/${product.image}`]" :alt="product.name"  class="img-list">

                    </div>
                </td>
                <td>{{ product.name }}</td>
                <td>
                    <addcart :product="product"></addcart>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>

    import ButtonAddCartComponent from "../../layouts/ButtonAddCartComponent";

    export default {


        computed: {
            products () {
                return this.$store.state.cart.items
            }
        },

        components: {
            addcart : ButtonAddCartComponent
        }
    }
</script>

<style scoped>
    .img-list{max-width: 100px;}
</style>
