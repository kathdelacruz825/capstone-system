<template>
  <div id="app">
    <router-view />
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {};
  },
  methods: {},
  watch: {
    "$route.name": function(name) {
      let adminRoute = ["AdminLogin", "AdminHome"];

      if (adminRoute.includes(name)) {
        localStorage.setItem("userType", "Admin");
      } else {
        localStorage.setItem("userType", "User");
      }
    }
  },
  created() {}
};
</script>

<style lang="scss">
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

#nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}
</style>
