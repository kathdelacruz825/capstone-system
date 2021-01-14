<template>
  <el-dialog
    title="Add Parent"
    :visible.sync="showAddStudent"
    @close="closeDialog"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
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
        <el-divider content-position="left">Account Details</el-divider>
        <div class="form-item-account-details">
          <div class="detail-row1">
            <div class="icon">
              <el-upload
                class="avatar-uploader"
                action="#"
                :auto-upload="false"
                :show-file-list="false"
                list-type="picture-card"
                :on-change="handleAvatarSuccess"
                :before-upload="beforeAvatarUpload"
              >
                <img
                  v-if="ruleForm.Icon"
                  width="148"
                  height="148"
                  :src="ruleForm.Icon"
                  class="avatar"
                />
                <i v-else class="el-icon-plus avatar-uploader-icon"></i>
              </el-upload>
            </div>
            <div class="radio">
              <el-form-item label="Account Type">
                <el-radio-group v-model="AccountType" size="mini">
                  <el-radio label="Student" disabled border>Student</el-radio>
                  <el-radio label="Parent" border>Parent</el-radio>
                </el-radio-group>
              </el-form-item>
              <el-form-item label="Account Status">
                <el-radio-group v-model="AccountStatus" size="mini">
                  <el-radio label="Active" border>Active</el-radio>
                  <el-radio label="Inactive" border disabled>Inactive</el-radio>
                </el-radio-group>
              </el-form-item>
            </div>
          </div>
          <div class="detail-row2">
            <el-form-item label="Account ID" prop="AccountID">
              <el-input v-model="ruleForm.AccountID" type="text"></el-input>
            </el-form-item>
            <el-form-item label="Password" prop="AccountPassword">
              <el-input
                v-model="ruleForm.AccountPassword"
                type="password"
              ></el-input>
            </el-form-item>
          </div>
        </div>
        <el-divider content-position="left">Personal Details</el-divider>
        <div class="form-item-account-details">
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
        </div>
        <el-divider content-position="left">School Details</el-divider>
        <el-form-item label="Student ID:" prop="StudentID">
          <el-input v-model="ruleForm.StudentID" type="text"></el-input>
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
    var validateStudentID = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the student ID"));
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
        MiddleName: [{ validator: validateMiddleName, trigger: "blur" }],
        StudentID: [{ validator: validateStudentID, trigger: "blur" }]
      },
      AccountType: "Parent",
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
        StudentID: "",
        CreateTime: "",
        UpdateTime: ""
      },
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
          let paramsStudent = {
            request: 6,
            data: {
              AccountID: this.ruleForm.StudentID
            }
          };
          this.http
            .post(this.api.StudentService, paramsStudent)
            .then(response => {
              if (response.data[0].State == 1) {
                let params = {
                  request: 3,
                  data: {
                    AccountType: this.AccountType == "Student" ? 1 : 2, //this.ruleForm.AccountType,
                    AccountStatus: this.AccountStatus == "Active" ? 1 : 2, //this.ruleForm.AccountStatus,
                    AccountPending: this.ruleForm.AccountPending,
                    AccountOnlineState: this.ruleForm.AccountOnlineState,
                    AccountID: this.ruleForm.AccountID,
                    AccountPassword: this.ruleForm.AccountPassword,
                    LastName: this.ruleForm.LastName,
                    FirstName: this.ruleForm.MiddleName,
                    MiddleName: this.ruleForm.MiddleName,
                    ExtName: this.ruleForm.ExtName,
                    PhoneNumber: this.ruleForm.PhoneNumber,
                    Email: this.ruleForm.Email,
                    Icon: this.ruleForm.Icon,
                    StudentID: this.ruleForm.StudentID,
                    CreateTime: this.createTime(),
                    UpdateTime: this.createTime()
                  }
                };
                this.http
                  .post(this.api.ParentService, params)
                  .then(res => {
                    if (res.data[0].State == 1) {
                      this.updateData();
                      this.$message({
                        type: "success",
                        message: res.data[0].Message
                      });
                    } else {
                      this.$message({
                        type: "warning",
                        message: res.data[0].Message
                      });
                    }
                  })
                  .catch(error => {
                    this.$message({
                      type: "danger",
                      message: "Connection Error!"
                    });
                    console.log(error);
                  });
              } else {
                this.$message({
                  type: "error",
                  message: response.data[0].Message
                });
              }
            })
            .catch(error => {
              this.$message({
                type: "danger",
                message: "Connection Error!"
              });
              console.log(error);
            });
        } else {
          console.log("error submit!!");
          return false;
        }
      });
    },
    handleAvatarSuccess(file) {
      console.log(file);
      // this.ruleForm.Icon = URL.createObjectURL(file.raw);
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
    updateData() {
      this.$emit("updateData");
    },
    handleRemove(file, fileList) {
      console.log(file, fileList);
    },
    handlePreview(file) {
      console.log(file);
      console.log(this.fileList);
    },
    resetFields() {
      this.$refs.ruleForm.resetFields();
      this.ruleForm.ExtName = "";
      this.ruleForm.PhoneNumber = "";
      this.ruleForm.Email = "";
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
  created() {}
};
</script>

<style lang="scss">
.el-dialog__body {
  padding: 0px 15px 15px;

  .el-form {
    .form-item-account-details .detail-row1 {
      display: flex;
      flex-direction: row;
      align-items: center;
      margin-bottom: 15px;

      .icon {
        margin-right: 25px;
      }

      .radio .el-form-item {
        margin-bottom: 15px;
      }

      .radio .el-form-item__label {
        line-height: 28px;
      }
    }

    .form-item-account-details .detail-row2 {
      margin-bottom: 40px;
    }
  }

  .el-form-item {
    .el-form-item__content {
      display: flex;
      justify-content: flex-start;
      .el-radio {
        width: 100px;
      }
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

.el-dialog__footer {
  text-align: center;
}
</style>
