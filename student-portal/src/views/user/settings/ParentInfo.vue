<template>
  <div class="parent-info">
    <Nav :title="'Parent List'" :isLeftArrow="true" :isRightText="false" />
    <div style="margin-top: 10px">
      <van-cell-group v-if="parentData.length > 0">
        <van-cell
          v-for="(item, index) in parentData"
          :key="index"
          icon="manager-o"
          :title="item.FirstName + ' ' + item.LastName"
          is-link
          :to="{ name: 'ParentInfoView', params: { item } }"
        />
      </van-cell-group>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Nav from "@/components/user/common/Nav.vue";
// import Footer from "@/components/user/common/Footer.vue";

export default {
  name: "ParentInfo",
  components: {
    Nav
    // Footer
  },
  data() {
    return {
      parentData: []
    };
  },
  methods: {
    getStudentData() {
      var params = {
        request: 12,
        data: {
          AccountStatus: 1,
          AccountPending: 1,
          StudentID: this.userDetails.AccountID
        }
      };
      this.http
        .post(this.api.ParentService, params)
        .then(response => {
          this.parentData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  computed: {},
  created() {
    this.userDetails = JSON.parse(localStorage.getItem("user"));
    this.getStudentData();
  }
};
</script>

<style lang="scss">
.parent-info {
  .van-cell__title {
    text-align: left;
    padding-left: 5px;
  }
}
</style>
