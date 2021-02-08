<template>
  <el-dialog
    title="Update Password"
    :visible.sync="showUpdatePass"
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
        label-width="150px"
        status-icon
        ref="ruleForm"
        :rules="rules"
      >
        <div class="form-item-account-details admin-update">

          <div class="detail-row2">
            <el-form-item label="Old Password:" prop="oldPass">
              <el-input v-model="ruleForm.oldPass" type="password"></el-input>
            </el-form-item>

            <el-form-item label="New Password:" prop="newPass">
              <el-input v-model="ruleForm.newPass" type="password"></el-input>
            </el-form-item>

            <el-form-item label="Confirm Password:" prop="confirmPass">
              <el-input
                v-model="ruleForm.confirmPass"
                type="password"
              ></el-input>
            </el-form-item>

          </div>
        </div>
      </el-form>
    </div>
    <span slot="footer" class="dialog-footer">
      <el-button @click="closeDialog">Close</el-button>
      <el-button type="primary" @click="save()">Update</el-button>
    </span>
  </el-dialog>
</template>

<script>
export default {
  components: {},
  data() {
    var validateCurrPass = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the current password"));
      } else {
        callback();
      }
    };
    var validateNewPass = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input new password"));
      } else {
        callback();
      }
    };
    var validateConfirmPass = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the confirm password"));
      } else {
        callback();
      }
    };
    return {
      rules: {
        oldPass: [{ validator: validateCurrPass, trigger: "blur" }],
        newPass: [{ validator: validateNewPass, trigger: "blur" }],
        confirmPass: [{ validator: validateConfirmPass, trigger: "blur" }],
      },
      ruleForm: {
        oldPass: "",
        newPass: "",
        confirmPass: "",
      },
      fileList: [],
      typeList: [],
      currType: "---Select---",
      userDetails: {},
    };
  },
  methods: {
    closeDialog() {
      this.updateData();
      this.$emit("closePassword", false);
    },
    submitUpload() {
      this.$refs.upload.submit();
    },
    save() {
      if (this.ruleForm.oldPass == '') {
        this.$message({
          type: "danger",
          message: 'Please input the current password'
        });
      } else if (this.ruleForm.newPass == '') {
        this.$message({
          type: "danger",
          message: 'Please input new password'
        });
      } else if (this.ruleForm.confirmPass == '') {
        this.$message({
          type: "danger",
          message: 'Please input confirm password'
        });
      } else {
        if (this.ruleForm.newPass != this.ruleForm.confirmPass ) {
          this.$message({
            type: "danger",
            message: 'New password does not match!'
          });
        } else {
          let params = {
            request: 6,
            data: {
              ID: this.userDetails.ID,
              currPassword: this.ruleForm.oldPass,
              newPass: this.ruleForm.newPass,
            }
          };
          this.http
            .post(this.api.UserService, params)
            .then(response => {
              if (response.data.State == 1) {
                this.ruleForm.oldPass = "";
                this.ruleForm.newPass = "";
                this.ruleForm.confirmPass = "";
                // this.$message({
                //   type: "success",
                //   message: "Password successfully changed"
                // });
                this.$emit("successUpdate", true);
              } else {
                this.$message({
                  type: "danger",
                  message: response.data.Message
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
        }
      }
    },
    getRole() {
      let params = {
        request: 3,
        data: {}
      };
      this.http
        .post(this.api.UserService, params)
        .then(response => {
          this.typeList = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
    selectAccType(val) {
      // this.ruleForm.Role = val.ID;
      this.currType = val.Role;
    },
    parseRole(item) {
      return this.typeList.filter(val => {
        return val.Role == item;
      });
    },
    handleAvatarSuccess(file) {
      this.getBase64(file.raw).then(res => {
        this.ruleForm.Icon = res;
      });
    },
    getBase64(file) {
      return new Promise(function(resolve, reject) {
        let reader = new FileReader();
        let imgResult = "";
        reader.readAsDataURL(file);
        reader.onload = function() {
          imgResult = reader.result;
        };
        reader.onerror = function(error) {
          reject(error);
        };
        reader.onloadend = function() {
          resolve(imgResult);
        };
      });
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
      this.ruleForm.Icon = "";
      this.ruleForm.Role = "";
      this.ruleForm.AccountStatus = 1;
      this.currType = "---Select---";
    }
  },
  props: {
    showUpdatePass: {
      type: Boolean,
      default: false
    },
    userData: {
      type: Object,
      default: () => {
        return {};
      }
    }
  },
  created() {
    this.getRole();
    this.userDetails = JSON.parse(localStorage.getItem("user"));
  },
  mounted() {}
};
</script>

<style lang="scss">
.el-dialog__body {
  padding: 0px 15px 15px;
  .avatar {
    object-fit: cover;
  }
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

.admin-update {
  .detail-row1 {
    display: flex;
    justify-content: center;
  }
}
</style>
