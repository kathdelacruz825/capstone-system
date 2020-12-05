<template>
  <div class="attendance">
    <Nav :title="pageTitle" :isLeftArrow="true" :isRightText="false" />
    <div class="attendance-content">
      attendance
    </div>
    <Footer :activeItem="1" />
  </div>
</template>

<script>
import Nav from "@/components/user/common/Nav.vue";
import Footer from "@/components/user/common/Footer.vue";

export default {
  name: "Attendance",
  components: {
    Nav,
    Footer
  },
  data() {
    return {
      pageTitle: "Attendance"
    };
  },
  methods: {}
};
</script>
<style lang="scss">
.attendance {
  .attendance-content {
    height: calc(100vh - 96px);
    padding: 10px;
    overflow: hidden;
  }
}
</style>
