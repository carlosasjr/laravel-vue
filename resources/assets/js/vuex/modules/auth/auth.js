import {NAME_TOKEN} from "../../../config/config";

export default {
    state: {
        me: {},
        authenticated: false,
        url_back: 'admin.dashboard'
    },

    mutations: {
        AUTH_USER_OK (state, user) {
            state.authenticated = true
            state.me = user
        },

        AUTH_USER_LOGOUT(state) {
          state.authenticated = false,
          state.me = {},
          state.url_back = 'admin.dashboard'
        },

        CHANGE_URL_BACK (state, url) {
            state.url_back = url
        }
    },

    actions: {
        login (context, params) {
            context.commit('CHANGE_PRELOADER', true)
            return axios.post('/api/login', params)
                .then(response => {
                    context.commit('AUTH_USER_OK', response.data.user)

                    const token = response.data.token
                    window.axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
                    localStorage.setItem(NAME_TOKEN, token)
                })
                .finally(() => context.commit('CHANGE_PRELOADER', false))
        },

        checkLogin(context) {
               return new Promise((resolve, reject) => {
                const token = localStorage.getItem(NAME_TOKEN)

                if (!token) {
                    return reject()
                }

                context.commit('CHANGE_PRELOADER', true)
                axios.get('/api/me')
                    .then(response => {
                        context.commit('AUTH_USER_OK', response.data.user)
                        resolve()
                    })

                    .catch(() => {
                        localStorage.removeItem(NAME_TOKEN)
                        reject()
                    })
                    .finally(() => context.commit('CHANGE_PRELOADER', false))
            })
        },

        logout (context) {
            context.commit('CHANGE_PRELOADER', true)
            localStorage.removeItem(NAME_TOKEN);
            context.commit('AUTH_USER_LOGOUT')
            context.commit('CHANGE_PRELOADER', false)
        }
    }
}
