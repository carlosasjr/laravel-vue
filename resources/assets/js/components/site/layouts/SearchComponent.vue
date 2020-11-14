<template>
    <div>
        <form class="form form-inline">
            <div class="form-group">
                <select class="form-control" v-model="category_id" @change="onFilter">
                    <option value="">Selecione uma Categoria</option>
                    <option v-for="categorie in categories.data" :value="categorie.id">{{ categorie.name }}</option>
                </select>
                <input @keyup="onFilter" v-model="filter" type="text" class="form-control mr-sm-2">
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                filter: '',
                category_id: ''
            }
        },

        computed: {
            categories() {
                return this.$store.state.categories.items
            }
        },

        methods: {
            onFilter() {
                this.$emit('search', {
                    filter: this.filter,
                    category_id: this.category_id
                })
            }
        }
    }
</script>

<style scoped>

</style>
