<template>
  <div class="exam-view">
    <Nav :title="pageTitle" :isLeftArrow="true" :isRightText="false" />
    <div class="exam-view-content">
      <div class="exam-list">
        <div
          class="exam-item"
          v-for="(examItem, examKey) in examData"
          :key="examKey"
        >
          <div class="left">
            <van-tag class="tag" color="#7232dd" type="danger"></van-tag
            >{{ examItem.SubjectID }}
          </div>
          <div class="right">{{ examItem.Score + '/' + examItem.OverAllItems }}</div>
        </div>
      </div>
    </div>
    <Footer :activeItem="1" />
  </div>
</template>

<script>
import Nav from "@/components/user/common/Nav.vue";
import Footer from "@/components/user/common/Footer.vue";

export default {
  name: "ExamView",
  components: {
    Nav,
    Footer
  },
  data() {
    return {
      pageTitle: "",
      userDetails: {},
      examData: []
    };
  },
  methods: {
    getStudentQuizData(val, periodID) {
      var params = {
        request: 6,
        data: {
          StudentID: val,
          GradingPeriodID: periodID
        },
      };
      this.http
        .post(this.api.AdminExamService, params)
        .then(response => {
          this.examData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
  },
  created() {
    this.userDetails = JSON.parse(localStorage.getItem("user"));
  },
  mounted() {
    this.getStudentQuizData(this.userDetails.ID, this.$route.params.periodid);
    this.pageTitle = this.$route.params.period + ' Grading Period';
  }
};
</script>
<style lang="scss">
.exam-view {
  .exam-view-content {
    height: calc(100vh - 96px);
    overflow: hidden;
    padding: 10px;
    overflow-y: auto;

    .exam-item {
      display: flex;
      flex-direction: row;
      padding: 0px 10px;
      height: 40px;
      line-height: 40px;
      div {
        flex: 1;
      }
      .left {
        text-align: left;
        display: flex;
        align-items: center;
        .tag {
          height: 20px;
          width: 20px;
          margin-right: 10px;
        }
      }
      .right {
        text-align: right;
      }
    }
    .exam-item:not(:last-child) {
      margin-bottom: 5px;
    }
  }
}
</style>
