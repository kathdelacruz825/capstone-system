<template>
  <div class="examinations">
    <Nav :title="pageTitle" :isLeftArrow="true" :isRightText="false" />
    <div class="examinations-content">
      <div class="examinations-list">
        <van-cell-group>
          <van-cell
            class="examinations-item"
            v-for="(examItem, examKey) in examinationsItem"
            :key="examKey"
            :title="examItem.Title"
            is-link
            @click="goPage(examItem.Title, examItem.ID)"
          >
            <template #title>
              <van-tag
                class="tag"
                :color="
                  colors[
                    Number(examItem.ID) > 0
                      ? Number(examItem.ID)
                      : Number(examItem.ID) - 1
                  ]
                "
                type="danger"
              ></van-tag>
              <span class="custom-title">{{
                examItem.Title + " Quarter"
              }}</span>
            </template>
          </van-cell>
        </van-cell-group>
      </div>
    </div>
    <Footer :activeItem="1" />
  </div>
</template>

<script>
import Nav from "@/components/user/common/Nav.vue";
import Footer from "@/components/user/common/Footer.vue";

export default {
  name: "Examinations",
  components: {
    Nav,
    Footer
  },
  data() {
    return {
      pageTitle: "Examinations",
      examinationsItem: [],
      colors: [
        "#8B00FF",
        "#2E2B5F",
        "#0000FF",
        "#00FF00",
        "#FFFF00",
        "#FF7F00",
        "#FF0000"
      ]
    };
  },
  methods: {
    goPage(period, periodid) {
      this.$router.push({
        name: "ExamView",
        params: { period: period, periodid: periodid }
      });
    },
    getAllGradingPeriod() {
      let params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.GradingPeriodService, params)
        .then(response => {
          this.examinationsItem = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  created() {
    this.getAllGradingPeriod();
  }
};
</script>
<style lang="scss">
.examinations {
  .examinations-content {
    height: calc(100vh - 96px);
    overflow: hidden;
    // padding: 50px 10px 10px;
    padding: 10px;
    overflow-y: auto;

    // .quiz-list {
    //   border: 1px solid #ccc;
    //   padding: 10px;
    //   .van-cell-group::after {
    //     display: none;
    //   }
    // }

    .examinations-item {
      height: 50px;
      line-height: 50px;
      width: 100%;
      text-align: center;
      font-weight: 600;
      text-align: left;
      display: flex;
      align-items: center;

      .van-cell__title {
        display: flex;
        align-items: center;
        .tag {
          height: 20px;
          width: 20px;
          margin-right: 10px;
        }
      }
    }

    .examinations-item:not(:last-child) {
      margin-bottom: 10px;
    }
  }
}
</style>
