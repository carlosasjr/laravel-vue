<template>
    <div class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <a href="#"><b>Registrar-se</b></a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <form @submit.prevent="register">
                        <form-component :user="formData" :errors="errors"></form-component>
                    </form>
                    <p class="mb-0">
                        <router-link class="text-center" :to="{name: 'login'}">Login</router-link>
                    </p>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>
</template>

<script>
    import FormComponent from './partials/FormComponent'
    export default {
        data () {
            return  {
                formData: {
                    name: '',
                    email: '',
                    password: ''
                },

                errors: []
            }
        },

        methods: {
            register () {
                this.$store.dispatch('register', this.formData)
                    .then(() => {
                        this.$router.push({name: 'admin.dashboard'})
                    })
                    .catch(error => {
                        this.errors = error
                        this.$snotify.error('Falha ao registrar-se!', 'Opss!!')
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
