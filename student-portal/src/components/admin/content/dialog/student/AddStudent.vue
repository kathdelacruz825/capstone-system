<template>
  <el-dialog
    title="Add Student"
    :visible.sync="showAddStudent"
    @close="closeDialog"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="500px"
  >
    <div class="add-student-content">
      <el-form
        :label-position="'left'"
        :model="ruleForm"
        class="add-dialog-form"
        label-width="130px"
        status-icon
        ref="ruleForm"
        :rules="rules"
      >
        <el-form-item label="Account Type">
          <el-radio-group v-model="AccountType" size="medium">
            <el-radio label="Student" border>Student</el-radio>
            <el-radio label="Parent" border disabled>Parent</el-radio>
          </el-radio-group>
        </el-form-item>
        <el-form-item label="Account Status">
          <el-radio-group v-model="AccountStatus" size="medium">
            <el-radio label="Active" border>Active</el-radio>
            <el-radio label="Inactive" border>Inactive</el-radio>
          </el-radio-group>
        </el-form-item>
        <el-form-item label="Account ID" prop="AccountID">
          <el-input v-model="ruleForm.AccountID" type="text"></el-input>
        </el-form-item>
        <el-form-item label="Password" prop="AccountPassword">
          <el-input
            v-model="ruleForm.AccountPassword"
            type="password"
          ></el-input>
        </el-form-item>
        <el-form-item label="Last Name:" prop="LastName">
          <el-input v-model="ruleForm.LastName" type="text"></el-input>
        </el-form-item>
        <el-form-item label="First Name:" prop="FirstName">
          <el-input v-model="ruleForm.FirstName" type="text"></el-input>
        </el-form-item>
        <el-form-item label="Middle Name:" prop="MiddleName">
          <el-input v-model="ruleForm.MiddleName" type="text"></el-input>
        </el-form-item>
        <el-form-item label="Extension Name:">
          <el-input v-model="ruleForm.ExtName" type="text"></el-input>
        </el-form-item>
        <el-form-item label="Phone Number:">
          <el-input v-model="ruleForm.PhoneNumber" type="text"></el-input>
        </el-form-item>
        <el-form-item label="Email:">
          <el-input v-model="ruleForm.Email" type="email"></el-input>
        </el-form-item>
        <el-form-item label="Icon:">
          <el-upload
            class="upload-demo"
            action="#"
            :auto-upload="false"
            :on-change="handleAvatarSuccess"
            :on-remove="handleRemove"
            :before-upload="beforeAvatarUpload"
            :limit="1"
            :file-list="fileList"
          >
            <el-button size="small" type="primary">Click to upload</el-button>
            <div slot="tip" class="el-upload__tip">
              jpg/png files with a size less than 500kb
            </div>
          </el-upload>
        </el-form-item>
        <el-form-item label="Course:">
          <el-dropdown trigger="click" @command="selectCourse">
            <el-button type="primary">
              {{ currentCourse
              }}<i class="el-icon-arrow-down el-icon--right"></i>
            </el-button>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item
                v-for="(courseItem, courseKey) in courseList"
                :key="courseKey"
                :command="courseItem"
              >
                {{ courseItem.CourseID }}
              </el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
        </el-form-item>
        <el-form-item label="Year Level:">
          <el-dropdown trigger="click" @command="selectYearLevel">
            <el-button type="primary">
              {{ currentYearLevel
              }}<i class="el-icon-arrow-down el-icon--right"></i>
            </el-button>
            <el-dropdown-menu slot="dropdown">
              <el-dropdown-item
                v-for="(yearLevelItem, yearLevelKey) in yearLevelList"
                :key="yearLevelKey"
                :command="yearLevelItem"
              >
                {{ yearLevelItem.YearLevel }}
              </el-dropdown-item>
            </el-dropdown-menu>
          </el-dropdown>
        </el-form-item>
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
    var validateAccountID = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the account ID"));
      } else {
        callback();
      }
    };
    var validatePass = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the password"));
      } else {
        callback();
      }
    };
    var validateLastName = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the last name"));
      } else {
        callback();
      }
    };
    var validateFirstName = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the first name"));
      } else {
        callback();
      }
    };
    var validateMiddleName = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the middle name"));
      } else {
        callback();
      }
    };
    return {
      rules: {
        AccountID: [{ validator: validateAccountID, trigger: "blur" }],
        AccountPassword: [{ validator: validatePass, trigger: "blur" }],
        LastName: [{ validator: validateLastName, trigger: "blur" }],
        FirstName: [{ validator: validateFirstName, trigger: "blur" }],
        MiddleName: [{ validator: validateMiddleName, trigger: "blur" }]
      },
      AccountType: "Student",
      AccountStatus: "Active",
      ruleForm: {
        ID: "",
        AccountType: 1,
        AccountStatus: 1,
        AccountPending: 2,
        AccountOnlineState: 2,
        AccountID: "",
        AccountPassword: "",
        LastName: "",
        FirstName: "",
        MiddleName: "",
        ExtName: "",
        PhoneNumber: "",
        Email: "",
        Icon: "",
        YearLevel: "",
        Course: "",
        ParentID: "",
        CreateTime: "",
        UpdateTime: ""
      },
      currentCourse: "",
      courseList: [],
      currentYearLevel: "",
      yearLevelList: [],
      fileList: []
    };
  },
  methods: {
    closeDialog() {
      this.$emit("closeAddStudent", false);
    },
    submitUpload() {
      this.$refs.upload.submit();
    },
    save() {
      this.$refs.ruleForm.validate(valid => {
        if (valid) {
          alert("submit!");
          console.log(this.fileList);
          this.resetFields();
        } else {
          console.log("error submit!!");
          return false;
        }
      });
    },
    handleAvatarSuccess(file) {
      this.ruleForm.Icon = URL.createObjectURL(file.raw);
      console.log(file);
    },
    beforeAvatarUpload(file) {
      const isJPG = file.type === "image/jpeg";
      const isLt2M = file.size / 1024 / 1024 < 2;

      if (!isJPG) {
        this.$message.error("Avatar picture must be JPG format!");
      }
      if (!isLt2M) {
        this.$message.error("Avatar picture size can not exceed 2MB!");
      }
      return isJPG && isLt2M;
    },
    handleRemove(file, fileList) {
      console.log(file, fileList);
    },
    handlePreview(file) {
      console.log(file);
      console.log(this.fileList);
    },
    getAllCourse() {
      let params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.CourseService, params)
        .then(response => {
          this.courseList = response.data;
          this.currentCourse = response.data[0].CourseID;
        })
        .catch(error => {
          console.log(error);
        });
    },
    getAllYearLevel() {
      let params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.YearLevelService, params)
        .then(response => {
          this.yearLevelList = response.data;
          this.currentYearLevel = response.data[0].YearLevel;
        })
        .catch(error => {
          console.log(error);
        });
    },
    selectCourse(item) {
      this.ruleForm.Course = item.ID;
      this.currentCourse = item.CourseID;
    },
    selectYearLevel(item) {
      console.log(item);
      this.ruleForm.YearLevel = item.ID;
      this.currentYearLevel = item.YearLevel;
    },
    resetFields() {
      this.$refs.ruleForm.resetFields();
    },
    createTime() {
      let today = new Date();
      let currdate =
        today.getFullYear() +
        "-" +
        (today.getMonth() + 1) +
        "-" +
        (today.getDate() < 10 ? "0" + today.getDate() : today.getDate());
      let currHour =
        today.getHours() < 10 ? "0" + today.getHours() : today.getHours();
      let currMinutes =
        today.getMinutes() < 10 ? "0" + today.getMinutes() : today.getMinutes();
      let currSeconds =
        today.getSeconds() < 10 ? "0" + today.getSeconds() : today.getSeconds();
      let timePeriod = today.getHours() < 13 ? "AM" : "PM";
      let currtime =
        currdate +
        " " +
        currHour +
        ":" +
        currMinutes +
        ":" +
        currSeconds +
        " " +
        timePeriod;
      return currtime;
    }
  },
  props: {
    showAddStudent: {
      type: Boolean,
      default: false
    }
  },
  created() {
    this.getAllCourse();
    this.getAllYearLevel();
  }
};
</script>

<style lang="scss">
.add-dialog-form {
}

.el-dialog__body {
  padding: 15px;

  .el-form-item {
    .el-form-item__content {
      display: flex;
      justify-content: flex-start;
    }

    .upload-demo {
      width: 100%;
      display: flex;
      flex-direction: column;
      text-align: left;

      .el-upload {
        text-align: left;
      }
    }
  }
}
</style>
