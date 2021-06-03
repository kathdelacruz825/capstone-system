<template>
  <el-dialog
    :visible.sync="showUpdateGrade"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Update Grade
    </template>
    <div class="add-course-content">
      <el-form
        :label-position="'left'"
        :model="ruleForm"
        class="add-dialog-form"
        label-width="130px"
        status-icon
        ref="ruleForm"
        :rules="rules"
      >
        <el-divider content-position="left">Grade Details</el-divider>
        <div class="form-item-account-details">
          <el-form-item label="Subject:">
            <el-dropdown trigger="click" @command="selectSubject">
              <el-button type="primary" disabled>
                {{ currentSubject }}
                <i class="el-icon-arrow-down el-icon--right"></i>
              </el-button>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item
                  v-for="(subjectItem, subjectKey) in subjectList"
                  :key="subjectKey"
                  :command="subjectItem"
                >
                  {{ subjectItem.Title }}
                </el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
          </el-form-item>

          <el-form-item label="First Quarter:" prop="currGrade">
            <el-input v-model="studentData.FirstGrade" type="number"></el-input>
          </el-form-item>

          <el-form-item label="Second Quarter:" prop="currGrade">
            <el-input
              v-model="studentData.SecondGrade"
              type="number"
            ></el-input>
          </el-form-item>

          <el-form-item label="Third Quarter:" prop="currGrade">
            <el-input v-model="studentData.ThirdGrade" type="number"></el-input>
          </el-form-item>

          <el-form-item label="Fourth Quarter:" prop="currGrade">
            <el-input
              v-model="studentData.FourthGrade"
              type="number"
            ></el-input>
          </el-form-item>

          <!-- <el-form-item label="Over All Grade:" prop="currGrade">
            <el-input
              v-model="ruleForm.Grade"
              readonly
              type="number"
            ></el-input>
          </el-form-item>

          <el-form-item label="Remarks:" prop="currGrade">
            <el-input
              v-model="ruleForm.Grade"
              readonly
              type="text"
            ></el-input>
          </el-form-item> -->

          <!-- <el-form-item label="Teacher:">
            <el-dropdown trigger="click" @command="selectTeacher">
              <el-button type="primary">
                {{ currentTeacher }}
                <i class="el-icon-arrow-down el-icon--right"></i>
              </el-button>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item
                  v-for="(teacherItem, teacherKey) in teacherList"
                  :key="teacherKey"
                  :command="teacherItem"
                >
                  {{ teacherItem.Name }}
                </el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
          </el-form-item> -->
        </div>
      </el-form>
    </div>
    <span slot="footer" class="dialog-footer">
      <el-button @click="closeDialog">Cancel</el-button>
      <el-button type="primary" @click="save()">Update</el-button>
    </span>
  </el-dialog>
</template>

<script>
export default {
  components: {},
  data() {
    var validateCurrentGrade = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the grade"));
      } else {
        callback();
      }
    };
    return {
      rules: {
        currGrade: [{ validator: validateCurrentGrade, trigger: "blur" }]
      },
      ruleForm: {
        StudentID: "",
        SubjectID: "",
        Quarter: "",
        Grade: "",
        FirstGrade: "",
        SecondGrade: "",
        ThirdGrade: "",
        FourthGrade: "",
        OverAllGrade: "",
        Remarks: "",
        TeacherID: ""
      },
      currentTeacher: "---Select---",
      currentSubject: "---Select---",
      currentGradingPeriod: "---Select---",
      currentGrade: "",
      teacherList: [],
      subjectList: [],
      gradingPeriodList: []
    };
  },
  methods: {
    closeDialog() {
      this.currentGradingPeriod = "---Select---";
      this.currentTeacher = "---Select---";
      this.currentSubject = "---Select---";
      this.$emit("closeUpdateGrade", false);
      this.$emit("updateData");
      this.$refs.ruleForm.resetFields();
    },
    selectTeacher(val) {
      this.currentTeacher = val.Name;
      // this.studentData.TeacherID = val.AccountID;
    },
    selectSubject(val) {
      this.currentSubject = val.Title;
      // this.studentData.SubjectID = val.ID;
    },
    selectGradingPeriod(val) {
      this.currentGradingPeriod = val.Title;
      this.ruleForm.Quarter = val.Title;
    },
    save() {
      let params = {
        request: 4,
        data: {
          ID: this.studentData.ID,
          StudentID: this.studentData.StudentID,
          SubjectID: this.parseSubject(this.currentSubject),
          FirstGrade: Number(
            this.studentData.FirstGrade ? this.studentData.FirstGrade : 0
          ),
          SecondGrade: Number(
            this.studentData.SecondGrade ? this.studentData.SecondGrade : 0
          ),
          ThirdGrade: Number(
            this.studentData.ThirdGrade ? this.studentData.ThirdGrade : 0
          ),
          FourthGrade: Number(
            this.studentData.FourthGrade ? this.studentData.FourthGrade : 0
          ),
          OverAllGrade: this.computeOverALL(this.studentData),
          Remarks: this.computeRemarks(this.studentData),
          TeacherID: this.studentData.TeacherID
        }
      };
      console.log(params);
      this.http
        .post(this.api.AdminGradingService, params)
        .then(response => {
          if (response.data.State == 1) {
            this.$emit("updateData");
            this.$message({
              type: "success",
              message: response.data.Message
            });
          } else {
            this.$message({
              type: "warning",
              message: response.data.Message
            });
          }
        })
        .catch(error => {
          console.log(error);
        });
    },
    parseSubject(item) {
      var newItem = this.subjectList.filter(val => {
        if (val.Title == item) {
          return val;
        }
      })[0].ID;
      return newItem;
    },
    parseTeacher(item) {
      var newItem = this.teacherList.filter(val => {
        if (val.Name == item) {
          return val;
        }
      })[0].AccountID;
      return newItem;
    },
    computeOverALL(obj) {
      let first = Number(obj.FirstGrade ? obj.FirstGrade : 0);
      let second = Number(obj.SecondGrade ? obj.SecondGrade : 0);
      let third = Number(obj.ThirdGrade ? obj.ThirdGrade : 0);
      let fourth = Number(obj.FourthGrade ? obj.FourthGrade : 0);
      let overAll = (first + second + third + fourth) / 4;
      return overAll;
    },
    computeRemarks(obj) {
      let first = Number(obj.FirstGrade ? obj.FirstGrade : 0);
      let second = Number(obj.SecondGrade ? obj.SecondGrade : 0);
      let third = Number(obj.ThirdGrade ? obj.ThirdGrade : 0);
      let fourth = Number(obj.FourthGrade ? obj.FourthGrade : 0);
      let overAll = (first + second + third + fourth) / 4;
      return overAll >= 75 ? "Passed" : "Failed";
    },

    getAllTeacher() {
      let params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.TeacherService, params)
        .then(response => {
          this.teacherList = response.data;
          // this.currentTeacher = this.teacherList.filter(val => {
          //   if (val.AccountID == this.studentData.TeacherID) {
          //     return val;
          //   }
          // })[0].Name;
        })
        .catch(error => {
          console.log(error);
        });
    },
    GetSubject(StudentID) {
      var params = {
        request: 1,
        data: {
          StudentID: StudentID
        }
      };
      this.http
        .post(this.api.StudentSubjectService, params)
        .then(response => {
          this.subjectList = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
  },
  props: {
    showUpdateGrade: {
      type: Boolean,
      default: false
    },
    studentData: {
      type: Object,
      default: () => {
        return {};
      }
    }
  },
  async created() {
    await this.getAllTeacher();
    await this.GetSubject(this.studentData.StudentID);
  },
  mounted() {
    console.log(this.studentData);
    this.currentSubject = this.studentData.SubjectID;
    this.currentTeacher = this.studentData.TeacherID;
  }
};
</script>

<style lang="scss">
.add-course-content {
  .el-form-item__content {
    text-align: left;
  }
}
</style>
