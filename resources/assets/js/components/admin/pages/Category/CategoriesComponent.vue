<template>
    <div>
        <h1>Página de Categoria</h1>

        <div class="row">
            <div class="col">
                <router-link class="btn btn-primary" :to="{name: 'admin.categories.create'}">Adicionar</router-link>
            </div>

            <div class="col d-flex align-items-end flex-column bd-highlight mb-3">
                <filter-component @search="search"></filter-component>
            </div>
        </div>


        <table class="table table-dark">
            <thead>
            <tr>
                <th>#ID</th>
                <th>Categoria</th>
                <th width="220">Ações</th>
            </tr>
            </thead>

            <tbody>
            <tr v-for="(category, index) in getCategories" :key="index">
                <td>{{ category.id }}</td>
                <td>{{ category.name }}</td>
                <td>
                    <router-link
                        :to="{name: 'admin.categories.edit',
                            params: {id: category.id }}"
                        class="btn btn-info">
                        Editar
                    </router-link>

                    <a href="#"
                       class="btn btn-danger"
                       @click.prevent="confirmDestroy(category)">Remover</a>


                </td>
            </tr>
            </tbody>

        </table>
    </div>
</template>

<script>
    import FilterComponent from "../../layouts/SearchComponent";
    export default {
        created() {
            //   if (this.countCategories == 0)
            this.loadCategories()
        },

        data () {
            return {
                name : ''
            }
        },

        computed: {
            getCategories() {
                return this.$store.state.categories.items.data
            },

            countCategories() {
                return this.$store.state.categories.items.data.length
            }
        },

        methods: {
            loadCategories() {
                this.$store.dispatch('loadCategories', {name: this.name})
            },

            confirmDestroy(category) {
                this.$snotify.error(`Deseja realmente deletar a categoria ${category.name}`,
                    'Deletar?', {
                        timeout: 10000,
                        showProgressBar: true,
                        pauseOnHover: true,
                        position: "centerCenter",
                        closeOnClick: true,
                        buttons: [
                            {
                                text: 'Não', action: null
                            },
                            {
                                text: 'Sim', action: (value) => {
                                    this.destroy(category), this.$snotify.remove(value.id)
                                }
                            }
                        ]
                    })
            },

            destroy(category) {
                this.$store.dispatch('destroyCategory', category)
                    .then(response => {
                        this.$snotify.success(`Sucesso ao deletar a categoria ${category.name}`)
                        this.loadCategories()
                    })
                    .catch(error => {
                        this.$snotify.error('Falha ao deletar', 'Oppss!')
                    })
            },

            search(filter) {
                this.name = filter
                this.loadCategories()
            }

        },

        components: {
            FilterComponent
        }


    }
</script>

<style scoped>

</style>
