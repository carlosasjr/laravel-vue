<template>
    <div>
        <a href="#" @click.prevent="confirmDestroy(item)" class="btn btn-danger">Excluir</a>
    </div>
</template>

<script>
    export default {
        props: {
          item: {
              required: true,
              type: Object
          }
        },


        methods: {
            confirmDestroy(item) {
                this.$snotify.error(`Deseja realmente deletar o registro`,
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
                                    this.$emit('destroy', item.id),
                                    this.$snotify.remove(value.id)
                                }
                            }
                        ]
                    })
            },
        }
    }
</script>

<style scoped>

</style>
