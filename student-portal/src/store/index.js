import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    userType: "Student"
  },
  mutations: {
    setUserType(state, status) {
      state.userType = status;
    }
  },
  actions: {
    setUserType({ commit }, payload) {
      commit("setUserType", payload);
    }
  },
  modules: {}
});
