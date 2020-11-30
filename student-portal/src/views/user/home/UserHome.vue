<template>
  <div class="user-home">
    <Nav :title="pageTitle" :isLeftArrow="false" :isRightText="true" />
    <div class="content">
      content
    </div>
    <Footer :activeItem="0" />
  </div>
</template>

<script>
// @ is an alias to /src
import Nav from "@/components/user/common/Nav.vue";
import Footer from "@/components/user/common/Footer.vue";

export default {
  name: "UserHome",
  components: {
    Nav,
    Footer
  },
  data() {
    return {
      pageTitle: "Home"
    };
  }
};
</script>
