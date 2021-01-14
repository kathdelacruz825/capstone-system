<template>
  <el-dialog
    :visible.sync="showAddYearLevel"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Add Teacher
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
        <el-divider content-position="left">Teacher Details</el-divider>
        <div class="form-item-account-details">
          <el-form-item label="Account ID:" prop="AccountID">
            <el-input v-model="ruleForm.AccountID" type="text"></el-input>
          </el-form-item>
          <el-form-item label="Name:" prop="Name">
            <el-input v-model="ruleForm.Name" type="text"></el-input>
          </el-form-item>
          <el-form-item label="Position:" prop="Position">
            <el-input v-model="ruleForm.Position" type="text"></el-input>
          </el-form-item>
          <el-form-item label="Status:">
            <el-radio-group v-model="ruleForm.Status" size="mini">
              <el-radio :label="1" border>Active</el-radio>
              <el-radio :label="2" border>Inactive</el-radio>
            </el-radio-group>
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
    var validateAccountID = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the account ID"));
      } else {
        callback();
      }
    };
    var validateName = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the name"));
      } else {
        callback();
      }
    };
    var validatePosition = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the position"));
      } else {
        callback();
      }
    };
    return {
      rules: {
        AccountID: [{ validator: validateAccountID, trigger: "blur" }],
        Name: [{ validator: validateName, trigger: "blur" }],
        Position: [{ validator: validatePosition, trigger: "blur" }]
      },
      ruleForm: {
        AccountID: "",
        Name: "",
        Position: "",
        Status: 1 //number 1 - 2
      }
    };
  },
  methods: {
    closeDialog() {
      this.$emit("closeAddCourse", false);
      this.$refs.ruleForm.resetFields();
    },
    save() {
      this.$refs.ruleForm.validate(valid => {
        if (valid) {
          let params = {
            request: 3,
            data: {
              AccountID: this.ruleForm.AccountID,
              Name: this.ruleForm.Name,
              Position: this.ruleForm.Position,
              Status: this.ruleForm.Status
            }
          };
          this.http
            .post(this.api.TeacherService, params)
            .then(response => {
              if (response.data[0].State == 1) {
                this.ruleForm.Status = 1;
                this.$refs.ruleForm.resetFields();
                this.updateData();
              }
              this.$message({
                type: response.data[0].State == 1 ? "success" : "danger",
                message: response.data[0].Message
              });
            })
            .catch(error => {
              console.log(error);
            });
        } else {
          this.$message({
            type: "danger",
            message: "error submit!!"
          });
          return false;
        }
      });
    },
    updateData() {
      this.$emit("updateData");
    }
  },
  props: {
    showAddYearLevel: {
      type: Boolean,
      default: false
    }
  },
  created() {}
};
</script>

<style lang="scss">
.add-course-content {
  .el-form-item__content {
    text-align: left;
  }
}
</style>
