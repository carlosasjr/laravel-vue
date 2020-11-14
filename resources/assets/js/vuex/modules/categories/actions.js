import axios from "axios";

const actions = {
    loadCategories (context, params) {
        context.commit('CHANGE_PRELOADER', true)

        axios.get('/api/v1/categories', {params})
            .then(response => {
                context.commit('LOAD_CATEGORIES', response)
            })

            .catch(error => {
                console.log(error)
            })

            .finally (() => {
                context.commit('CHANGE_PRELOADER', false)
            })
    },

    loadCategory (context, id) {
        context.commit('CHANGE_PRELOADER', true)
        return new Promise((resolve, reject) => {
            axios.get(`/api/v1/categories/${id}`)
                .then(response => {
                    resolve(response.data)
                })
                .catch(error => reject(error) )
                .finally (() => context.commit('CHANGE_PRELOADER', false))
        })
    },


    storeCategory (context, category) {
        context.commit('CHANGE_PRELOADER', true)
        return new Promise((resolve, reject) => {
            axios.post('/api/v1/categories', category)
                .then(response => {
                    resolve()
                })
                .catch(error => reject(error.response.data.errors) )
                .finally (() => context.commit('CHANGE_PRELOADER', false))
        })
    },


    updateCategory (context, category) {
        context.commit('CHANGE_PRELOADER', true)
        return new Promise((resolve, reject) => {
            axios.put(`/api/v1/categories/${category.id}`, category)
                .then(response => {
                    resolve()
                })
                .catch(error => reject(error.response.data.errors) )
                .finally (() => context.commit('CHANGE_PRELOADER', false))
        })
    },

    destroyCategory (context, category) {
        context.commit('CHANGE_PRELOADER', true)
        return new Promise((resolve, reject) => {
            axios.delete(`/api/v1/categories/${category.id}`)
                .then(response => {
                    resolve()
                })
                .catch(error => reject(error.response.data.errors) )

        })
    }
}

export default actions
