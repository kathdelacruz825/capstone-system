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
      if (name == "UserLogin") {
        localStorage.setItem("userType", "User");
      } else if (name == "AdminLogin") {
        localStorage.setItem("userType", "Admin");
      }
    }
  }
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
