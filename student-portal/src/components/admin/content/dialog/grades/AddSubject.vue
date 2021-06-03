<template>
  <el-dialog
    :visible.sync="showAddSubject"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Add Subject
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
        <el-divider content-position="left">Subject Details</el-divider>
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

          <el-form-item label="Title:" prop="currGrade">
            <el-input v-model="ruleForm.Title" type="text" readonly></el-input>
          </el-form-item>

          <el-form-item label="Teacher:" prop="currGrade">
            <el-input v-model="ruleForm.Teacher" type="text" readonly=""></el-input>
          </el-form-item>

        </div>
      </el-form>
    </div>
    <span slot="footer" class="dialog-footer">
      <el-button @click="closeDialog">Close</el-button>
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
        currGrade: [{ validator: validateCurrentGrade, trigger: "blur" }]
      },
      ruleForm: {
        StudentID: "",
        SubjectID: "",
        Title: "",
        Teacher: "",
      },
      currentSubject: "---Select---",
      subjectList: [],
    };
  },
  methods: {
    closeDialog() {
      this.currentSubject = "---Select---";
      this.$emit("closeAddSubject", false);
      this.$emit("updateData");
      this.$refs.ruleForm.resetFields();
    },
    selectSubject(val) {
      console.log(val);
      this.currentSubject = val.Title;
      this.ruleForm.SubjectID = val.ID;
      this.ruleForm.Title = val.Title;
      this.ruleForm.Teacher = val.Teacher;
    },
    save() {
      if (this.currentSubject == "---Select---") {
        this.$message({
          type: "warning",
          message: "Select Subject!"
        });
      } else {
        let params = {
          request: 2,
          data: {
            StudentID: this.ruleForm.StudentID,
            SubjectID: this.ruleForm.SubjectID,
          }
        };

        this.http
          .post(this.api.StudentSubjectService, params)
          .then(response => {
            if (response.data.State == 1) {
              this.resetFields();
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
      }
    },
    getAllSubject() {
      let params = {
        request: 6,
        data: {
          YearLevelID: this.YearLevelID,
          SemesterID: this.SemesterID
        }
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
    resetFields() {
      this.currentSubject = "---Select---";
      this.ruleForm.SubjectID = "";
      this.ruleForm.Title = "";
      this.ruleForm.Teacher = "";
    }
  },
  props: {
    showAddSubject: {
      type: Boolean,
      default: false
    },
    studentID: {
      type: String,
      default: ""
    },
    YearLevelID: {
      type: String,
      default: ""
    },
    SemesterID: {
      type: String,
      default: ""
    },
  },
  async created() {
    await this.getAllSubject();
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
