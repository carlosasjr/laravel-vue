<template>
    <div>
        <form class="form" @submit.prevent="onSubmit">
            <div :class="['form-group', {'has-error' : errors.image}]">
                <input type="file" class="form-control" @change="onFileChange">
                <div v-if="errors.image">{{ errors.image[0] }}</div>
            </div>


            <div :class="['form-group', {'has-error' : errors.name}]">
                <input v-model="product.name"
                       type="text" class="form-control" placeholder="Nome do Produto">
                <div v-if="errors.name">{{ errors.name[0] }}</div>
            </div>

            <div :class="['form-group', {'has-error' : errors.description}]">
                <textarea v-model="product.description" cols="30" rows="10" class="form-control" placeholder="Descrição do produto"></textarea>
                <div v-if="errors.description">{{ errors.description[0] }}</div>
            </div>

            <div :class="['form-group', {'has-error' : errors.name}]">
                <select v-model="product.category_id" class="form-control">
                    <option value="">Selecione uma categoria</option>
                    <option v-for="category in getCategories" :value="category.id" :key="category.id">
                        {{ category.name }}
                    </option>
                </select>

                <div v-if="errors.category_id">{{ errors.category_id[0] }}</div>
            </div>


            <div class="form-group ">
                <input class="btn btn-success" type="submit" value="Salvar">
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        props: {
          updating: {
              required: false,
              type: Boolean,
              default : false
          },

          product : {
              required: false,
              type: Object | Array,
              default : () => ({
                  id: '',
                  name : '',
                  description: '',
                  category_id: '',
              })
          },

            errorsParent: {}
        },

        data () {
          return {
              errors: {},
              upload: null,
          }
        },

        watch: {
            errorsParent () {
                this.errors = this.errorsParent
            }
        },


        computed: {
            getCategories () {
                return this.$store.state.categories.items.data
            }
        },

        methods: {
            serialize (object) {
                const formData = new FormData();

                Object.entries(object).forEach(([key, value]) => {
                    formData.append(key, value);
                });

                if (this.upload)
                   formData.append('image', this.upload)

                return formData
            },

            onFileChange(e) {
               let files = e.target.files || e.dataTransfer.files

                if (!files.length)
                    return

                this.upload = files[0]
            },


            onSubmit () {
                const action = (this.updating) ? 'updateProduct' : 'storeProduct'

                this.$store.dispatch(action, this.serialize(this.product))
                .then(response => {
                    this.reset()
                    this.$snotify.success('Produto cadastrado/alterado com sucesso!')
                    this.$emit('saved')
                })
                .catch(error => {
                    console.log(error)
                    this.$snotify.error('Falha ao cadastrar', 'Opps!')
                    this.errors = error;
                })
            },

            reset () {
                this.errors = []
            }
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
