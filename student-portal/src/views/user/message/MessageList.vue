<template>
  <div class="message-list">
    <Nav :title="pageTitle" :isLeftArrow="false" :isRightText="false" />
    <div class="message-list-content">
      message-list
    </div>
    <Footer :activeItem="2" />
  </div>
</template>

<script>
// @ is an alias to /src
import Nav from "@/components/user/common/Nav.vue";
import Footer from "@/components/user/common/Footer.vue";

export default {
  name: "Message",
  components: {
    Nav,
    Footer
  },
  data() {
    return {
      pageTitle: "Message"
    };
  },
  methods: {}
};
</script>
