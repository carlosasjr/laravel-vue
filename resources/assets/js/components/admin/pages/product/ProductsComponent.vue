<template>
    <div>
        <h1>Lista de Produtos</h1>

        <div class="row">
            <div class="col">
                <button class="btn btn-primary" @click.prevent="create">
                    Adicionar
                </button>

                <vodal :show="showModal"
                       animation="zoom"
                       @hide="hideModal"
                       :width="600"
                       :height="500">
                    <form-component
                        @saved="success"
                        :updating="updating"
                        :product="product"
                        :errorsParent="errorsParent"
                    >

                    </form-component>
                </vodal>
            </div>

            <div class="col d-flex align-items-end flex-column bd-highlight mb-3">
                <search-component @search="searchForm"></search-component>
            </div>
        </div>

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
                        <a href="#" @click.prevent="edit(product.id)" class="btn btn-info">Editar</a>
                        <btndestroy
                            :item="product"
                            @destroy="destroy"
                        >
                        </btndestroy>
                    </td>
                </tr>
            </tbody>
        </table>

        <paginationComponent
            :pagination="products"
            :offset="10"
            @paginate="loadProducts">
        </paginationComponent>

    </div>
</template>

<script>
    import paginationComponent from "../../../layouts/PaginationComponent";
    import SearchComponent from "../../layouts/SearchComponent";
    import Vodal from 'vodal';
    import FormComponent from "./partials/FormComponent";
    import ButttonDestroyComponent from "../../layouts/ButttonDestroyComponent";

    export default {
        created() {
            this.loadProducts(1)
        },

        data () {
          return {
              search: '',
              showModal : false,
              product: {},
              updating: false,
              errorsParent : {}
          }
        },

        computed: {
          products () {
              return this.$store.state.products.items
          },

          params () {
              return {
                page: 1,
                filter: this.search
              }
          }
        },

        methods: {
            loadProducts(page) {
                this.$store.dispatch('loadProducts', {...this.params, page})
            },

            create () {
              this.reset()
              this.updating = false
              this.showModal = true
            },

            edit(id) {
              this.reset()

              this.$store.dispatch('getProduct', id)
                .then(response => {
                    this.product = response
                    this.updating = true
                    this.showModal = true
                })
                .catch(error => {
                    this.$snotify.error('Falha ao carregar o produto')
                })
            },

            destroy (id) {
                this.$store.dispatch('destroyProduct', id)
                .then(response => {
                    this.$snotify.success('Registro deletado com sucesso!')
                    this.loadProducts(1)
                })
                .catch(error => {
                    this.$snotify.error('Falhar ao deletar o registro')
                })
            },

            searchForm (filter) {
                this.search = filter
                this.loadProducts(1)
            },

            hideModal () {
                this.showModal = false
            },

            success () {
             this.hideModal()
             this.loadProducts(1)
            },

            reset () {
                this.product = {}
                this.errorsParent = {}
            }
        },

        components: {
            paginationComponent,
            SearchComponent,
            Vodal,
            FormComponent,
            btndestroy: ButttonDestroyComponent
        }

    }
</script>

<style scoped>
    .img-list{max-width: 100px;}
</style>
