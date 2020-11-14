<template>
    <div>
        <h1>Editar Categoria</h1>

        <form-component :category="category" :updating="true" ></form-component>
    </div>
</template>

<script>
    import FormComponent from "./partials/FormComponent";

    export default {
        props: {
            id: {
                required: true
            }
        },

        created () {
            this.loadCategory()
            //this.category = this.$store.getters.getCategoryById(this.id)
        },

        data () {
            return {
                category: {}

            }
        },

        methods: {
           loadCategory() {
               this.$store.dispatch('loadCategory', this.id)
                   .then(response => this.category = response )
                   .catch(error => {
                       this.$snotify.error('Categoria não encontrada', 'Opss!')
                       this.$router.push({name: 'admin.categories'})
                   })
           }
        },

        components: {
            FormComponent
        }
    }
</script>

<style scoped>

</style>
