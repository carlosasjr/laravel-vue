<template>
    <div>
        <div v-if="notCart">
            <button class="btn btn-info" @click.prevent="addCart">
                Adicionar ao Carrinho
            </button>
        </div>

        <div v-else>
            <button class="btn btn-danger" @click.prevent="removeCart">
                Remover do Carrinho
            </button>
        </div>

    </div>
</template>

<script>
    export default {
        props: ['product'],

        computed: {
          notCart () {
              return this.$store.state.cart.items.data.indexOf(this.product) === -1
          }
        },

        methods: {
            addCart() {
                this.$store.commit("ADD_ITEM_CART", this.product)
            },

            removeCart () {
                this.$store.commit("REMOVE_ITEM_CART", this.product)
            }
        }
    }
</script>

<style scoped>

</style>
