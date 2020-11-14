import axios from "axios";
import { URL_BASE } from '../../../config/config';

const RESOURCE = URL_BASE + 'products';

const CONFIGS = {
    headers : {
        'content-type' : 'multipart/form-data'
    }
}

const actions = {
    loadProducts (context, params) {
        context.commit('CHANGE_PRELOADER', true)
        axios.get(RESOURCE, {params})
            .then(response => context.commit('LOAD_PRODUCTS', response.data))
            .catch(error => console.log(error))
            .finally(() => context.commit('CHANGE_PRELOADER', false))
    },

    getProduct (context, id) {
        context.commit('CHANGE_PRELOADER', true)
        return new Promise((resolve, reject) => {
            axios.get(`${RESOURCE}/${id}`)
                .then(response => resolve(response.data))
                .catch(error => reject())
                .finally(() => context.commit('CHANGE_PRELOADER', false))
        })
    },

    storeProduct (context, formData) {
        context.commit('CHANGE_PRELOADER', true)
        return new Promise((resolve, reject) => {
            axios.post(RESOURCE, formData, CONFIGS)
                .then(response => resolve(response.data))
                .catch(error => reject(error.response.data.errors))
                .finally (() => context.commit('CHANGE_PRELOADER', false))
        })
    },

    updateProduct (context, formData) {
        context.commit('CHANGE_PRELOADER', true)

        formData.append('_method', 'PUT')

        return new Promise((resolve, reject) => {
            axios.post(`${RESOURCE}/${formData.get('id')}`, formData)
                .then(response => resolve(response.data))
                .catch(error => {
                    context.commit('CHANGE_PRELOADER', false)
                    reject(error.response.data.errors)
                })
                .finally (() => context.commit('CHANGE_PRELOADER', false))
        })
    },

    destroyProduct (context, id) {
        context.commit('CHANGE_PRELOADER', true)
        return new Promise((resolve, reject) => {
            axios.delete(`${RESOURCE}/${id}`)
                .then(response => resolve())
                .catch(error => {
                    reject(error.response.data.errors)
                    context.commit('CHANGE_PRELOADER', false)
                })
        })
    }
}

export default actions
