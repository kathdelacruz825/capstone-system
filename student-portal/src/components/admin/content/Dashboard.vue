<template>
  <div class="dashboard">
    <div class="dashboard-wrapper">
      <div class="top-panel">
        <el-row :gutter="20">
          <el-col :span="8">
            <div
              class="grid-content"
              style="background: #409EFF; color:#fff; border-radius: 3px;"
            >
              <i class="icon el-icon-user" style="font-size:50px;"></i>
              Student {{ studentCount }}
            </div>
          </el-col>
          <el-col :span="8"
            ><div
              class="grid-content"
              style="background: #F56C6C; color:#fff; border-radius: 3px;"
            >
              <i class="icon el-icon-user" style="font-size:50px;"></i>
              Parent {{ parentCount }}
            </div></el-col
          >
          <el-col :span="8"
            ><div
              class="grid-content"
              style="background: #E6A23C; color:#fff; border-radius: 3px;"
            >
              <i class="icon el-icon-user" style="font-size:50px;"></i>
              Teacher {{ teacherCount }}
            </div></el-col
          >
        </el-row>
      </div>
      <div class="bottom-panel">
        <el-row :gutter="20">
          <el-col :span="18"
            ><div class="grid-content bg-purple" style="border-radius: 3px;">
              List for recent activities
            </div></el-col
          >
          <el-col :span="6">
            <div
              class="grid-content bg-purple time"
              style="border-radius: 3px;"
            >
              <div class="grid-content-wrapper">
                <el-divider content-position="center">School Info</el-divider>
                <div class="school-details">
                  <span
                    >School Year: {{ schoolYear }} <i class="el-icon-school"></i
                  ></span>
                  <span
                    >Grading Period: {{ gradingPeriod }}
                    <i class="el-icon-collection"></i
                  ></span>
                </div>
                <el-divider content-position="center">Time Info</el-divider>

                <div class="time-details">
                  <span
                    >Time: {{ time.currTime }} <i class="el-icon-time"></i
                  ></span>
                  <span
                    >Date: {{ time.currDate }} <i class="el-icon-date"></i
                  ></span>
                </div>
                <el-divider content-position="center">User Info</el-divider>
                <div class="user-details">
                  <span
                    >Current User: {{ currUser }}
                    <i class="el-icon-s-custom"></i
                  ></span>
                  <span
                    >Time Logged in: {{ timeLog }}
                    <i class="el-icon-watch-1"></i
                  ></span>
                </div>
              </div></div
          ></el-col>
        </el-row>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      schoolYear: "",
      gradingPeriod: "",
      studentCount: "0",
      parentCount: "0",
      teacherCount: "0",
      time: "",
      currUser: "Administrator",
      timeLog: ""
    };
  },
  methods: {
    getStudentData() {
      var params = {
        request: 8,
        data: {}
      };
      this.http
        .post(this.api.StudentService, params)
        .then(response => {
          this.studentCount = response.data[0].count;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getParentData() {
      var params = {
        request: 8,
        data: {}
      };
      this.http
        .post(this.api.ParentService, params)
        .then(response => {
          this.parentCount = response.data[0].count;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getSchoolYearData() {
      var params = {
        request: 6,
        data: {}
      };
      this.http
        .post(this.api.SchoolYearService, params)
        .then(response => {
          this.schoolYear = response.data[0].SchooYear;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getGradingPeriodData() {
      var params = {
        request: 6,
        data: {}
      };
      this.http
        .post(this.api.GradingPeriodService, params)
        .then(response => {
          this.gradingPeriod = response.data[0].Title;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getTeacherData() {
      var params = {
        request: 8,
        data: {}
      };
      this.http
        .post(this.api.TeacherService, params)
        .then(response => {
          this.teacherCount = response.data[0].count;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getCurrentDateTime() {
      let today = new Date();
      let currdate =
        today.getFullYear() +
        "/" +
        (today.getMonth() + 1) +
        "/" +
        today.getDate();
      let currHour =
        today.getHours() < 10 ? "0" + today.getHours() : today.getHours();
      let currMinutes =
        today.getMinutes() < 10 ? "0" + today.getMinutes() : today.getMinutes();
      let currSeconds =
        today.getSeconds() < 10 ? "0" + today.getSeconds() : today.getSeconds();
      let timePeriod = today.getHours() < 13 ? "AM" : "PM";
      let currtime =
        currHour + ":" + currMinutes + ":" + currSeconds + " " + timePeriod;
      let dt = {
        currDate: currdate,
        currTime: currtime
      };
      return dt;
    }
  },
  props: {},
  async created() {
    this.timeLog = this.getCurrentDateTime().currTime;
    setInterval(() => {
      this.time = this.getCurrentDateTime();
    }, 1000);
    await this.getStudentData();
    await this.getParentData();
    await this.getSchoolYearData();
    await this.getGradingPeriodData();
    await this.getTeacherData();
  }
};
</script>

<style lang="scss">
.dashboard {
  height: 100%;
  .dashboard-wrapper {
    height: 100%;
  }

  .top-panel .top-panel-wrapper {
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;

    .item {
      border: 1px solid #000;
      width: calc(33.3333% - 20px);
      height: 120px;
    }
  }

  .top-panel {
    height: 120px;
    margin-bottom: 20px;
    .el-row .el-col {
      height: 120px;
      line-height: 120px;
      .grid-content {
        // border: 1px solid #333;
        box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.1);
        position: relative;
        font-size: 30px;
        .icon {
          position: absolute;
          left: 60px;
          top: 30px;
        }
      }
    }
  }

  .bottom-panel {
    height: 350px;
    min-height: 350px;
    .el-row {
      height: 100%;
    }
    .el-row .el-col {
      height: 100%;
      .grid-content {
        height: 100%;
        // border: 1px solid #333;
        box-shadow: 0 2px 12px 0 rgba(0, 0, 0, 0.1);
      }

      .grid-content .grid-content-wrapper {
        padding: 10px;
      }

      .grid-content .grid-content-wrapper {
        .school-details {
          margin-bottom: 30px;
          span {
            // font-weight: bold;
            padding-left: 10px;
            display: block;
            text-align: left;
          }
        }
      }

      .grid-content .grid-content-wrapper {
        .time-details {
          margin-bottom: 30px;
          span {
            // font-weight: bold;
            padding-left: 10px;
            display: block;
            text-align: left;
          }
        }
      }

      .grid-content .grid-content-wrapper {
        .user-details span {
          // font-weight: bold;
          padding-left: 10px;
          display: block;
          text-align: left;
        }
      }
    }
  }
}
</style>
