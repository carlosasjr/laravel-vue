<template>
    <div>
        <form class="form">
            <input @keyup="onFilter" v-model="filter" type="text" class="form-group mr-sm-2">
        </form>
        <div v-if="filter">
            <span>Resultado(s) para: {{ filter }}</span>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                filter: ''
            }
        },

        methods: {
            onFilter () {
                this.$emit('search', this.filter)
            }
        }
    }
</script>

<style scoped>

</style>
