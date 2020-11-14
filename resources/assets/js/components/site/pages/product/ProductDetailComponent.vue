<template>
    <div>
        <h1>{{ product.name }}</h1>
        <div v-if="product.image">
            <img class="img-list" :src="[`/storage/products/${product.image}`]" :alt="product.name">
        </div>
        <div v-else>
            <img class="img-list" src="/images/no-image.png" :alt="product.name">
        </div>
        <hr>
        <h2>{{ product.description }}</h2>
    </div>
</template>

<script>
    export default {
        props: ['id'],

        created() {
            this.loadProduct()
        },

        data () {
          return {
              product: {}
          }
        },

        methods: {
            loadProduct () {
                this.$store.dispatch('getProduct', this.id)
                    .then(response => this.product = response)
            }
        }
    }
</script>

<style scoped>
    .img-list {
        max-width: 200px
    }
</style>
