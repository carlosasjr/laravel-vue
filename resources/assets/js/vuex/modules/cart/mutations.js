const mutations = {
    ADD_ITEM_CART (state, product) {
        state.items.data.push(product)
    },

    REMOVE_ITEM_CART (state, product) {
        let index = state.items.data.findIndex(prod => {
            return prod.id === product.id
        })

        state.items.data.splice(index, 1)
    }
}

export default mutations
