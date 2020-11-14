export default  {
    actions: {
        productsCreateMonth (context, year) {
            context.commit('CHANGE_PRELOADER', true)
            return new Promise( (resolve, reject) => {
                axios.get(`/api/v1/reports-products/${year}`)
                    .then(response => resolve(response.data))
                    .catch(error => reject(error.response.data.errors))
                    .finally(() =>  context.commit('CHANGE_PRELOADER', false))
            })
        }
    }
}
