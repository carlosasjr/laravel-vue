const getters =  {
    getCategoryById: (state) => (id) => {
        return state.items.data.find(category => category.id === id)
    }
}

export default getters
