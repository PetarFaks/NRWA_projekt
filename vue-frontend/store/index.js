import { createStore } from 'vuex';

export default createStore({
  state: {
    auth: {
      isLoggedIn: !!localStorage.getItem('token'),
    },
  },
  mutations: {
    setLoginState(state, isLoggedIn) {
      state.auth.isLoggedIn = isLoggedIn;
    }
  },
  actions: {
    login({ commit }, token) {
      localStorage.setItem('token', token);
      commit('setLoginState', true);
    },
    logout({ commit }) {
      localStorage.removeItem('token');
      commit('setLoginState', false);
    }
  },
  modules: {}
});
