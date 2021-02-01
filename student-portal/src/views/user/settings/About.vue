<template>
  <div class="about">
    <Nav :title="'About'" :isLeftArrow="true" :isRightText="false" />
    <h1>This is an about page</h1>
  </div>
</template>

<script>
// @ is an alias to /src
import Nav from "@/components/user/common/Nav.vue";
// import Footer from "@/components/user/common/Footer.vue";

export default {
  name: "About",
  components: {
    Nav
    // Footer
  },
  data() {
    return {};
  },
  methods: {},
  computed: {},
  created() {
    this.userDetails = JSON.parse(localStorage.getItem("user"));
  }
};
</script>
