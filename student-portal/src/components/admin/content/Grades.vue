<template>
  <div class="grades">
    <div class="top-panel">
      <el-row :gutter="20">
        <el-col :span="5">
          <div class="search-box">
            <!-- <div class="title-box">
                <span>Search</span>
              </div> -->
            <el-input
              placeholder="Input name to search"
              v-model="searchText"
              @change="getStudentList"
              class="input-with-select"
            >
              <el-button
                slot="append"
                icon="el-icon-search"
                @click="getStudentList()"
              ></el-button>
            </el-input>
            <div class="list">
              <div class="list-wrapper">
                <div
                  class="list-item"
                  v-for="(item, key) in studentList"
                  :key="key"
                  @click="selectStudent(item)"
                >
                  {{
                    item.LastName +
                      " " +
                      item.FirstName +
                      ", " +
                      item.MiddleName.split("")[0]
                  }}
                </div>
              </div>
            </div>
          </div>
          <div class="bottom-box"></div>
        </el-col>
        <el-col :span="19">
          <div class="grid-content bg-purple">
            <el-divider content-position="left">Student Info</el-divider>
            <div class="student-info-box">
              <div class="left">
                <img
                  v-if="studentData != null"
                  :src="studentData.Icon"
                  class="user-f"
                  alt=""
                />
              </div>
              <div class="right">
                <div class="top-info">
                  <small>Student Name</small>
                  <h3 v-if="studentData != null">
                    {{
                      studentData.LastName +
                        " " +
                        studentData.FirstName +
                        ", " +
                        studentData.MiddleName.split("")[0]
                    }}
                  </h3>
                </div>
                <div class="bottom-info">
                  <div>
                    <small>Student ID:</small>
                    <b v-if="studentData != null">{{
                      studentData.AccountID
                    }}</b>
                  </div>
                  <div>
                    <small>Course:</small>
                    <b v-if="studentData != null">{{ studentData.Course }}</b>
                  </div>
                  <div>
                    <small>Year:</small>
                    <b v-if="studentData != null">{{
                      studentData.YearLevel
                    }}</b>
                  </div>
                </div>
              </div>
            </div>
            <el-divider content-position="left">Record Info</el-divider>
            <div class="record-box">
              <div class="record-box-wrapper">
                <div class="record-header">
                  <div
                    class="item-header"
                    v-for="(item, key) in itemClass"
                    :key="key"
                    @click="selectItemClass(key)"
                    :class="activeItemClass == key ? 'selected' : null"
                  >
                    {{ item.name }}
                  </div>
                </div>
                <div class="record-body">
                  <div class="action">
                    <el-row>
                      <el-button
                        type="success"
                        icon="el-icon-circle-plus"
                        v-if="activeItemClass === 0"
                        @click="showAddGradeF()"
                      ></el-button>
                      <el-button
                        type="success"
                        icon="el-icon-circle-plus"
                        v-if="activeItemClass === 1"
                        @click="showAddQuizF()"
                      ></el-button>
                      <el-button
                        type="success"
                        icon="el-icon-circle-plus"
                        v-if="activeItemClass === 2"
                        @click="showAddExamF()"
                      ></el-button>
                      <el-button
                        type="success"
                        icon="el-icon-circle-plus"
                        v-if="activeItemClass === 3"
                        @click="showAddAttendanceF()"
                      ></el-button>
                      <el-button
                        type="success"
                        icon="el-icon-circle-plus"
                        v-if="activeItemClass === 4"
                        @click="showAddScheduleF()"
                      ></el-button>
                    </el-row>
                  </div>
                  <component
                    :is="itemClass[activeItemClass].link"
                    @updateData="updateData"
                    :tableData="tableData"
                  ></component>
                </div>
              </div>
            </div>
          </div>
        </el-col>
      </el-row>
    </div>
    <AddGrade
      v-if="showAddGrade"
      :studentID="studentData.ID"
      @updateData="updateData"
      @closeAddGrade="closeAddGrade($event)"
      :showAddGrade="showAddGrade"
    />

    <AddQuiz
      v-if="showAddQuiz"
      :studentID="studentData.ID"
      @updateData="updateData"
      @closeAddQuiz="closeAddQuiz($event)"
      :showAddQuiz="showAddQuiz"
    />

    <AddExam
      v-if="showAddExam"
      :studentID="studentData.ID"
      @updateData="updateData"
      @closeAddExam="closeAddExam($event)"
      :showAddExam="showAddExam"
    />

    <AddAttendance
      v-if="showAddAttendance"
      :studentID="studentData.AccountID"
      @updateData="updateData"
      @closeAddAttendance="closeAddAttendance($event)"
      :showAddAttendance="showAddAttendance"
    />

    <AddSchedule
      v-if="showAddSchedule"
      :studentID="studentData.AccountID"
      @updateData="updateData"
      @closeAddSchedule="closeAddSchedule($event)"
      :showAddSchedule="showAddSchedule"
    />
  </div>
</template>

<script>
import AddGrade from "@/components/admin/content/dialog/grades/AddGrade.vue";
import AddQuiz from "@/components/admin/content/dialog/grades/AddQuiz.vue";
import AddExam from "@/components/admin/content/dialog/grades/AddExam.vue";
import AddSchedule from "@/components/admin/content/dialog/grades/AddSchedule.vue";
import AddAttendance from "@/components/admin/content/dialog/grades/AddAttendance.vue";

export default {
  components: {
    AddGrade,
    AddQuiz,
    AddExam,
    AddSchedule,
    AddAttendance,
    TableGrades: resolve => {
      require(["@/components/admin/content/grades/TableGrades.vue"], resolve);
    },
    TableQuiz: resolve => {
      require(["@/components/admin/content/grades/TableQuiz.vue"], resolve);
    },
    TableExam: resolve => {
      require(["@/components/admin/content/grades/TableExam.vue"], resolve);
    },
    TableAttendance: resolve => {
      require([
        "@/components/admin/content/grades/TableAttendance.vue"
      ], resolve);
    },
    TableSchedule: resolve => {
      require(["@/components/admin/content/grades/TableSchedule.vue"], resolve);
    }
  },
  data() {
    return {
      showAddGrade: false,
      showAddQuiz: false,
      showAddExam: false,
      showAddSchedule: false,
      showAddAttendance: false,
      searchText: "",
      select: "Account ID",
      tableData: [],
      studentList: [],
      itemClass: [
        {
          name: "Grades",
          link: "TableGrades"
        },
        {
          name: "Quizzes",
          link: "TableQuiz"
        },
        {
          name: "Examinations",
          link: "TableExam"
        },
        {
          name: "Attendance",
          link: "TableAttendance"
        },
        {
          name: "Schedule",
          link: "TableSchedule"
        }
      ],
      activeItemClass: 0,
      classActions: [
        { title: "Add", icon: "" },
        { title: "Edit", icon: "" },
        { title: "Delete", icon: "" }
      ],
      studentData: null
    };
  },
  methods: {
    selectItemClass(index) {
      this.activeItemClass = index;
      if (this.studentData != null) {
        this.updateData();
      }
    },
    async getStudentList() {
      if (this.searchText) {
        var params = {
          request: 13,
          data: {
            searchText: this.searchText
          }
        };
        await this.http
          .post(this.api.AdminService, params)
          .then(response => {
            this.studentList = [];
            this.studentList = response.data;
          })
          .catch(error => {
            console.log(error);
          });
      } else {
        this.studentList = [];
      }
    },
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
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getStudentQuizData(val) {
      var params = {
        request: 1,
        data: {
          StudentID: val
        }
      };
      this.http
        .post(this.api.AdminQuizService, params)
        .then(response => {
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getStudentExamData(val) {
      var params = {
        request: 1,
        data: {
          StudentID: val
        }
      };
      this.http
        .post(this.api.AdminExamService, params)
        .then(response => {
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getAttendance(val) {
      let params = {
        request: 6,
        data: {
          AccountID: val
        }
      };
      this.http
        .post(this.api.AttendanceService, params)
        .then(response => {
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getSchedule(val) {
      let params = {
        request: 7,
        data: {
          AccountID: val
        }
      };
      this.http
        .post(this.api.ScheduleService, params)
        .then(response => {
          this.tableData = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    updateData() {
      if (this.activeItemClass === 0) {
        this.getStudentGradeData(this.studentData.ID);
      } else if (this.activeItemClass === 1) {
        this.getStudentQuizData(this.studentData.ID);
      } else if (this.activeItemClass === 2) {
        this.getStudentExamData(this.studentData.ID);
      } else if (this.activeItemClass === 3) {
        this.getAttendance(this.studentData.AccountID);
      } else if (this.activeItemClass === 4) {
        this.getSchedule(this.studentData.AccountID);
      }
    },
    closeAddGrade(val) {
      this.showAddGrade = val;
    },
    closeAddQuiz(val) {
      this.showAddQuiz = val;
    },
    closeAddExam(val) {
      this.showAddExam = val;
    },
    closeAddSchedule(val) {
      this.showAddSchedule = val;
    },
    closeAddAttendance(val) {
      this.showAddAttendance = val;
    },
    selectStudent(val) {
      this.studentData = val;
      if (this.activeItemClass === 0) {
        this.getStudentGradeData(val.ID);
      } else if (this.activeItemClass === 1) {
        this.getStudentQuizData(val.ID);
      } else if (this.activeItemClass === 2) {
        this.getStudentExamData(val.ID);
      } else if (this.activeItemClass === 3) {
        this.getAttendance(val.AccountID);
      } else if (this.activeItemClass === 4) {
        this.getSchedule(val.AccountID);
      }
    },
    showAddGradeF() {
      if (this.studentData != null) {
        this.showAddGrade = true;
      }
    },
    showAddQuizF() {
      if (this.studentData != null) {
        this.showAddQuiz = true;
      }
    },
    showAddExamF() {
      if (this.studentData != null) {
        this.showAddExam = true;
      }
    },
    showAddAttendanceF() {
      if (this.studentData != null) {
        this.showAddAttendance = true;
      }
    },
    showAddScheduleF() {
      if (this.studentData != null) {
        this.showAddSchedule = true;
      }
    }
  },
  props: {},
  created() {}
};
</script>

<style lang="scss">
.grades {
  height: 100%;
  overflow: hidden;
  .top-panel {
    margin-bottom: 20px;
  }

  .el-col {
    // border: 1px solid #ccc;
    // box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.25);
  }
  .top-panel .grid-content {
    .el-select .el-input {
      width: 120px;
    }
    .input-with-select .el-input-group__prepend {
      background-color: #fff;
    }
  }

  .top-panel .search-box {
    max-height: 350px;
    overflow: hidden;
    margin-bottom: 20px;

    .title-box {
      text-align: left;
      height: 25px;
      line-height: 25px;
    }
    .el-input-group input {
      line-height: 15px;
      height: 30px;
      border-radius: 0;
    }
    .el-input-group .el-input-group__append {
      border-radius: 0;
    }
    .list {
      height: calc(350px - 30px);
      .list-wrapper {
        height: 100%;
        overflow-y: scroll;
        border: 1px solid #ccc;
        border-top: 0;
        box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.25);
      }
      .list-wrapper .list-item {
        text-align: left;
        padding: 5px 10px;
        font-size: 14px;
        border-bottom: 1px solid #ebeef5;
        cursor: pointer;
      }
      // .list-wrapper .list-item:not(:last-child) {
      //   border-bottom: 1px solid #EBEEF5;
      // }
    }
  }

  .top-panel .bottom-box {
    border: 1px solid #ccc;
    box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.25);
    height: 150px;
  }

  .el-divider--horizontal {
    margin: 15px 0px;
  }

  .grid-content.bg-purple {
    display: block;
    border: 1px solid #ccc;
    box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.25);
  }

  .student-info-box {
    display: flex;
    padding: 0px 10px;
    height: 120px;
    // margin-bottom: 20px;
    .left {
      width: 150px;
      height: 120px;
      img {
        height: 100%;
        width: 100%;
      }
    }
    .right {
      flex: 3;
      text-align: left;
      padding: 0px 0px 0px 10px;
    }
    .right .top-info {
      min-height: 52px;
    }
    .right .bottom-info {
      display: flex;
      & > div {
        flex: 1;
      }
    }
  }

  .record-box {
    margin-bottom: 20px;
    .record-box-wrapper {
      padding: 0px 10px;
    }
    .record-box-wrapper .record-header {
      display: flex;
      .item-header.selected {
        background: #dcdfe6;
        color: #333;
      }
      .item-header {
        padding: 5px 10px;
        background: #409eff;
        color: #fff;
        border-top-right-radius: 8px;
        border-top-left-radius: 8px;
        cursor: pointer;
      }
      .item-header:not(:last-child) {
        margin-right: 10px;
      }
    }
  }

  .record-body {
    .action {
      margin: 10px 0px;
      display: flex;
      justify-content: flex-start;
    }

    .action .el-button {
      height: 25px;
      width: 30px;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
    }
  }

  .user-f {
    object-fit: fill;
  }
}
</style>
