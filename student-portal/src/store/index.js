import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    userType: "Student",
    userDetails: {}
  },
  mutations: {
    setUserType(state, status) {
      state.userType = status;
    },
    setUserDetails(state, status) {
      state.userDetails = status;
    }
  },
  actions: {
    setUserType({ commit }, payload) {
      commit("setUserType", payload);
    },
    setUserDetails({ commit }, payload) {
      commit("setUserDetails", payload);
    }
  },
  modules: {}
});
