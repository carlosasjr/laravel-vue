<template>
    <div>
        <h1>Produtos</h1>

        <search-component @search="search"></search-component>

        <div class="row home">
            <item-component
                v-for="product in products.data" :key="product.id"
                :item="product"
                :path="'products'"
            >
            </item-component>
        </div>

        <pagination-component
        :pagination="products"
        @paginate="loadProducts"
        >
        </pagination-component>
    </div>
</template>

<script>
    import paginationComponent from '../../../layouts/PaginationComponent'
    import ItemComponent from "../../../layouts/ItemComponent";
    import SearchComponent from "../../layouts/SearchComponent";

    export default {
        created () {
          if (this.products.data.length == 0)
              this.loadProducts()
        },

        data () {
          return {
              filter: '',
              category_id: ''
          }
        },

        computed: {
            products () {
                return this.$store.state.products.items
            },

            param () {
                return {
                    filter: this.filter,
                    category_id: this.category_id,
                    page: this.products.current_page
                }
            }
        },

        methods: {
            loadProducts (page = 1) {
                this.$store.dispatch('loadProducts', {...this.param, page})
            },

            search(params) {
                this.filter = params.filter
                this.category_id = params.category_id

                this.loadProducts()
            }
        },

        components: {
            paginationComponent,
            ItemComponent,
            SearchComponent
        }


    }
</script>

<style scoped>
    .home {
        margin-top: 5px
    }
</style>
