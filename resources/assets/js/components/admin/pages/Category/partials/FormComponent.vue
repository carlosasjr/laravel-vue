<template>
    <div>
        <form class="form" @submit.prevent="onSubmit">
            <div :class="['form-group', {'has-error' : errors.name}]">
                <input v-model="category.name"
                       type="text" class="form-control" placeholder="Nome da Categoria">
                <div v-if="errors.name">{{ errors.name[0] }}</div>
            </div>

            <div class="form-group ">
                <input class="btn btn-success" type="submit" value="Salvar">
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props : {
          category : {
              required: false,
              type: Object | Array,
              default: () => ({
                  name : ''
              })
          },

          updating: {
              required: false,
              type: Boolean,
              default : false
          }
        },

        data () {
            return {
                errors: []
            }
        },


        methods: {
            onSubmit() {
                const action = this.updating ? 'updateCategory' : 'storeCategory'

                this.$store.dispatch(action, this.category)
                    .then(response => {
                        this.$snotify.success('Sucesso ao cadastrar')
                        this.$router.push({name: 'admin.categories'})
                    })
                    .catch(error => {
                        this.$snotify.error('Falha ao cadastrar', 'Opps!')
                        this.errors = error
                    })
            },
        }
    }
</script>

<style scoped>
    .has-error {
        color: red
    }

    .has-error input {
        border: 1px solid red;
    }
</style>
