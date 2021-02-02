<template>
  <div class="parent-info-view">
    <Nav :title="'View Record'" :isLeftArrow="true" :isRightText="false" />
    <div style="margin-top: 10px">
      <van-cell-group>
        <van-cell
          v-for="(item, index) in schoolYearData"
          :key="index"
          :title="item.SchooYear"
          is-link
        />
      </van-cell-group>
    </div>
  </div>
</template>

<script>
import Nav from "@/components/user/common/Nav.vue";

export default {
  name: "ViewRecords",
  components: {
    Nav
    // Footer
  },
  data() {
    return {
      schoolYearData: [],
      userDetails: {}
    };
  },
  methods: {
    async getSchoolYear() {
      let params = {
        request: 1,
        data: {}
      };
      await this.http
        .post(this.api.SchoolYearService, params)
        .then(response => {
          this.schoolYearData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  computed: {},
  created() {
    this.userDetails = JSON.parse(localStorage.getItem("user"));
  },
  mounted() {
    this.getSchoolYear();
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
