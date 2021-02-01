<template>
  <div class="exam-view">
    <Nav
      :title="'Quizzes(' + pageTitle + ')'"
      :isLeftArrow="true"
      :isRightText="false"
    />
    <div class="exam-view-content">
      <van-tabs
        v-model="active"
        animate
        v-if="periodData.length > 0"
        @click="changeTab"
      >
        <van-tab
          v-for="(periodItem, periodKEy) in periodData"
          :key="periodKEy"
          :title="periodItem.Title"
        >
          <div class="exam-list">
            <div
              class="exam-item"
              v-for="(examItem, examKey) in examData"
              :key="examKey"
            >
              <div class="left">
                <van-tag class="tag" color="#7232dd" type="danger"></van-tag
                >{{ examItem.Title }}
              </div>
              <div class="right">
                {{ examItem.Score + "/" + examItem.OverAllItems }}
              </div>
            </div>
          </div>
        </van-tab>
      </van-tabs>
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
      active: 0,
      pageTitle: "",
      periodData: [],
      examData: []
    };
  },
  methods: {
    getQuizDataBySubject(val, subId, period) {
      var params = {
        request: 6,
        data: {
          StudentID: val,
          SubjectID: subId,
          GradingPeriod: period
        }
      };
      this.http
        .post(this.api.AdminQuizService, params)
        .then(response => {
          this.examData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getQuizDataBySubjectBy(val, subId, period) {
      var params = {
        request: 7,
        data: {
          StudentID: val,
          SubjectID: subId,
          GradingPeriod: period
        }
      };
      this.http
        .post(this.api.AdminQuizService, params)
        .then(response => {
          this.examData = response.data;
        })
        .catch(error => {
          console.log(error);
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
          this.periodData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    changeTab(val) {
      if (this.userDetails.AccountType == "1") {
        this.getQuizDataBySubject(
          this.userDetails.ID,
          this.$route.params.subjectid,
          this.periodData[val].ID
        );
      } else {
        this.getQuizDataBySubjectBy(
          this.userDetails.StudentID,
          this.$route.params.subjectid,
          this.periodData[val].ID
        );
      }
    }
  },
  async created() {
    this.userDetails = JSON.parse(localStorage.getItem("user"));
    await this.getAllGradingPeriod();
  },
  mounted() {
    this.pageTitle = this.$route.params.subject;
    if (this.userDetails.AccountType == "1") {
      this.getQuizDataBySubject(
        this.userDetails.ID,
        this.$route.params.subjectid,
        1
      );
    } else {
      this.getQuizDataBySubjectBy(
        this.userDetails.StudentID,
        this.$route.params.subjectid,
        1
      );
    }
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
