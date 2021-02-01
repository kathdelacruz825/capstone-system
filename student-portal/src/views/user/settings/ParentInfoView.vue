<template>
  <div class="parent-info-view">
    <Nav
      :title="'Parent Information'"
      :isLeftArrow="true"
      :isRightText="false"
    />
    <div style="margin-top: 10px">
      <div class="user-icon">
        <van-image
          width="100"
          height="100"
          fit="contain"
          :src="parentData.Icon"
        />
      </div>
      <van-cell-group>
        <van-cell title="Last Name:" :value="parentData.LastName" />
        <van-cell title="First Name:" :value="parentData.FirstName" />
        <van-cell title="Middle Name:" :value="parentData.MiddleName" />
        <van-cell title="Phone Number:" :value="parentData.PhoneNumber" />
        <van-cell title="Email:" :value="parentData.Email" />
      </van-cell-group>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Nav from "@/components/user/common/Nav.vue";
// import Footer from "@/components/user/common/Footer.vue";

export default {
  name: "ParentInfoView",
  components: {
    Nav
    // Footer
  },
  data() {
    return {
      parentData: []
    };
  },
  methods: {},
  computed: {},
  created() {},
  mounted() {
    this.parentData = this.$route.params.item;
  }
};
</script>

<style lang="scss">
.parent-info-view {
  .van-cell__title {
    text-align: left;
    color: #969799;
  }

  .van-cell__value {
    color: #000;
  }
}
</style>
