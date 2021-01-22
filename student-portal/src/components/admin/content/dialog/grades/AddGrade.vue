<template>
  <el-dialog
    :visible.sync="showAddGrade"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Add Grade
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
              <el-button type="primary">
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

          <el-form-item label="Grading Period:">
            <el-dropdown trigger="click" @command="selectGradingPeriod">
              <el-button type="primary">
                {{ currentGradingPeriod }}
                <i class="el-icon-arrow-down el-icon--right"></i>
              </el-button>
              <el-dropdown-menu slot="dropdown">
                <el-dropdown-item
                  v-for="(gradingItem, gradingKey) in gradingPeriodList"
                  :key="gradingKey"
                  :command="gradingItem"
                >
                  {{ gradingItem.Title }}
                </el-dropdown-item>
              </el-dropdown-menu>
            </el-dropdown>
          </el-form-item>

          <el-form-item label="Grade:" prop="currGrade">
            <el-input
              v-model="ruleForm.Grade"
              type="number"
            ></el-input>
          </el-form-item>

          <el-form-item label="Teacher:">
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
          </el-form-item>
        </div>
      </el-form>
    </div>
    <span slot="footer" class="dialog-footer">
      <el-button @click="closeDialog">Cancel</el-button>
      <el-button type="primary" @click="save()">Save</el-button>
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
        currGrade: [{ validator: validateCurrentGrade, trigger: "blur" }],
      },
      ruleForm: {
        StudentID: '',
        SubjectID: '',
        Quarter: '',
        Grade: '',
        // FirstGrade: '',
        // SecondGrade: '',
        // ThirdGrade: '',
        // FourthGrade: '',
        // OverAllGrade: '',
        // Remarks: '',
        TeacherID: '',
      },
      currentTeacher: '---Select---',
      currentSubject: '---Select---',
      currentGradingPeriod: '---Select---',
      currentGrade: '',
      teacherList: [],
      subjectList: [],
      gradingPeriodList: [],
    };
  },
  methods: {
    closeDialog() {
      this.currentGradingPeriod = '---Select---';
      this.currentTeacher = '---Select---';
      this.currentSubject = '---Select---';
      this.$emit("closeAddGrade", false);
      this.$refs.ruleForm.resetFields();
    },
    updateData() {
      this.$emit("updateData");
    },
    selectTeacher(val) {
      this.currentTeacher = val.Name;
      this.ruleForm.TeacherID = val.AccountID;
    },
    selectSubject(val) {
      this.currentSubject = val.Title;
      this.ruleForm.SubjectID = val.ID;
    },
    selectGradingPeriod(val) {
      this.currentGradingPeriod = val.Title;
      this.ruleForm.Quarter = val.Title;
    },
    save() {
      if (this.ruleForm.SubjectID == '') {
        this.$message({
          type: "warning",
          message: "Select Subject!"
        });
      } else if (this.ruleForm.Quarter == '') {
        this.$message({
          type: "warning",
          message: "Select Grading Period!"
        });
      } else if (this.ruleForm.Grade == '') {
          this.$message({
          type: "warning",
          message: "Enter Grade!"
        });
      } else if (this.ruleForm.TeacherID == '') {
          this.$message({
          type: "warning",
          message: "Select Teacher!"
        });
      } else {
        let params = {
          request: 1,
          data: this.ruleForm
        };
        console.log(params);
      }

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
        })
        .catch(error => {
          console.log(error);
        });
    },
    getAllSubject() {
      let params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.SubjectService, params)
        .then(response => {
          this.subjectList = response.data;
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
          this.gradingPeriodList = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
  },
  props: {
    showAddGrade: {
      type: Boolean,
      default: false
    },
    studentID: {
      type: String,
      default: ''
    }
  },
  async created() {
    await this.getAllTeacher();
    await this.getAllSubject();
    await this.getAllGradingPeriod();
  },
  mounted() {
    this.ruleForm.StudentID = this.studentID;
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
