<template>
  <div class="grades">
    <Nav :title="pageTitle" :isLeftArrow="true" :isRightText="false" />
    <div class="grades-content">
      <div class="general-average">
        <div>General Average</div>
        <div class="color" :class="{ red: generalAverage <= '74' }">
          {{ generalAverage.toFixed(2) }}
        </div>
      </div>
      <div class="grade-items">
        <van-collapse v-model="activeNames">
          <van-collapse-item
            v-for="(gradeItem, gradeKey) in gradeData"
            :key="gradeKey"
            :name="gradeKey"
          >
            <template #title>
              <div class="left">{{ gradeItem.SubjectID }}</div>
              <div
                class="right"
                :class="{ red: gradeItem.OverAllGrade <= '74' }"
              >
                {{ gradeItem.OverAllGrade }}
              </div>
            </template>
            <template #default>
              <div>Teacher: {{ gradeItem.TeacherID }}</div>
              <div>
                First Quarter:
                <span
                  class="color"
                  :class="{ red: gradeItem.FirstGrade <= '74' }"
                >
                  {{ gradeItem.FirstGrade }}
                </span>
              </div>
              <div>
                Secord Quarter:
                <span
                  class="color"
                  :class="{ red: gradeItem.SecondGrade <= '74' }"
                >
                  {{ gradeItem.SecondGrade }}
                </span>
              </div>
              <div>
                Third Quarter:
                <span
                  class="color"
                  :class="{ red: gradeItem.ThirdGrade <= '74' }"
                >
                  {{ gradeItem.ThirdGrade }}
                </span>
              </div>
              <div>
                Fourth Quarter:
                <span
                  class="color"
                  :class="{ red: gradeItem.FourthGrade <= '74' }"
                >
                  {{ gradeItem.FourthGrade }}
                </span>
              </div>
              <div>
                Remarks:
                <span
                  class="color"
                  :class="{ red: gradeItem.Remarks == 'Failed' }"
                >
                  {{ gradeItem.Remarks }}
                </span>
              </div>
            </template>
          </van-collapse-item>
        </van-collapse>
      </div>
    </div>
    <Footer :activeItem="1" />
  </div>
</template>

<script>
import Nav from "@/components/user/common/Nav.vue";
import Footer from "@/components/user/common/Footer.vue";

export default {
  name: "Grades",
  components: {
    Nav,
    Footer
  },
  data() {
    return {
      pageTitle: "Grades",
      generalAverage: 0,
      activeNames: [],
      userDetails: {},
      gradeData: []
    };
  },
  methods: {
    getStudentGradeData(val) {
      var params = {
        request: 1,
        data: {
          StudentID: val
        }
      };
      this.http
        .post(this.api.AdminGradingService, params)
        .then(response => {
          this.gradeData = response.data;
          if (this.gradeData.length > 0) {
            this.computeGenAve(this.gradeData);
          }
        })
        .catch(error => {
          console.log(error);
        });
    },
    getStudentGradeDataBy(val) {
      var params = {
        request: 6,
        data: {
          StudentID: val
        }
      };
      this.http
        .post(this.api.AdminGradingService, params)
        .then(response => {
          this.gradeData = response.data;
          if (this.gradeData.length > 0) {
            this.computeGenAve(this.gradeData);
          }
        })
        .catch(error => {
          console.log(error);
        });
    },
    computeGenAve(arr) {
      var tempVal = 0;
      for (var i = 0; i < arr.length; i++) {
        var currGrade = Number(arr[i].OverAllGrade);
        tempVal = currGrade + tempVal;
      }
      this.generalAverage = tempVal / arr.length;
    }
  },
  created() {
    this.userDetails = JSON.parse(localStorage.getItem("user"));
  },
  mounted() {
    if (this.userDetails.AccountType == "1") {
      this.getStudentGradeData(this.userDetails.ID);
    } else {
      this.getStudentGradeDataBy(this.userDetails.StudentID);
    }
  }
};
</script>
<style lang="scss">
.grades {
  .grades-content {
    height: calc(100vh - 96px);
    padding: 10px;
    overflow: hidden;
  }

  .general-average {
    display: flex;
    flex-direction: row;
    border: 1px solid #ccc;
    margin-bottom: 15px;

    div {
      flex: 1;
      height: 45px;
      line-height: 45px;
    }
    .color {
      color: green;
    }
    .color.red {
      color: red;
    }
  }

  .grade-items {
    height: 100%;
    overflow-y: auto;
    .van-cell__title {
      display: flex;
      flex-direction: row;
      div {
        flex: 1;
      }

      .left {
        text-align: left;
      }

      .right {
        text-align: right;
        color: green;
      }
      .right.red {
        color: red;
      }
    }

    .van-collapse-item__content {
      text-align: left;
    }

    .van-cell::after {
      // display: none;
    }

    .color {
      color: green;
    }
    .color.red {
      color: red;
    }
  }
}
</style>
