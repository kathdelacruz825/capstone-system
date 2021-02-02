<template>
  <div class="parent-info-view">
    <Nav
      :title="'Child Information'"
      :isLeftArrow="true"
      :isRightText="false"
    />
    <div style="margin-top: 10px">
      <div class="user-icon">
        <van-image
          width="100"
          height="100"
          fit="contain"
          :src="childData.Icon"
        />
      </div>
      <van-cell-group>
        <van-cell title="Last Name:" :value="childData.LastName" />
        <van-cell title="First Name:" :value="childData.FirstName" />
        <van-cell title="Middle Name:" :value="childData.MiddleName" />
        <van-cell title="Phone Number:" :value="childData.PhoneNumber" />
        <van-cell title="Email:" :value="childData.Email" />
        <van-cell title="Course:" :value="childData.Course" />
        <van-cell title="Year Level:" :value="childData.YearLevel" />
      </van-cell-group>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Nav from "@/components/user/common/Nav.vue";
// import Footer from "@/components/user/common/Footer.vue";
import { Toast } from "vant";

export default {
  name: "ParentInfoView",
  components: {
    Nav
    // Footer
  },
  data() {
    return {
      childData: {},
      userDetails: {}
    };
  },
  methods: {
    async getStudent() {
      let params = {
        request: 10,
        data: {
          ID: this.userDetails.StudentID
        }
      };
      await this.http
        .post(this.api.StudentService, params)
        .then(response => {
          this.childData = response.data[0];
        })
        .catch(error => {
          Toast("Connection Error");
          console.log(error);
        });
    }
  },
  computed: {},
  created() {
    this.userDetails = JSON.parse(localStorage.getItem("user"));
  },
  mounted() {
    this.getStudent();
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
