import Vue from "vue";
import Vuex from "vuex";

Vue.use(Vuex);

export default new Vuex.Store({
  state: {
    userType: "Student",
    userDetails: {
      username: "",
      userID: "12345",
      password: ""
    }
  },
  mutations: {
    setUserType(state, status) {
      state.userType = status;
    },
    setUserDetails(state, status) {
      console.log(status);
      state.userDetails.username = status.username;
      // state.userDetails.userID = status.username;
      state.userDetails.password = status.password;
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
