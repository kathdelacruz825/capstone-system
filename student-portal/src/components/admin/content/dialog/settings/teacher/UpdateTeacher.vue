<template>
  <el-dialog
    :visible.sync="showUpdateTeacher"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Update Teacher
    </template>
    <div class="add-course-content">
      <el-form
        :label-position="'left'"
        :model="newTeacherData"
        class="add-dialog-form"
        label-width="130px"
        status-icon
        ref="newTeacherData"
        :rules="rules"
      >
        <el-divider content-position="left">Teacher Details</el-divider>
        <div class="form-item-account-details">
          <el-form-item label="Account ID:" prop="AccountID">
            <el-input v-model="newTeacherData.AccountID" type="text"></el-input>
          </el-form-item>
          <el-form-item label="Name:" prop="Name">
            <el-input v-model="newTeacherData.Name" type="text"></el-input>
          </el-form-item>
          <el-form-item label="Position:" prop="Position">
            <el-input v-model="newTeacherData.Position" type="text"></el-input>
          </el-form-item>
          <el-form-item label="Status:">
            <el-radio-group v-model="newTeacherData.Status" size="mini">
              <el-radio :label="'Active'" border>Active</el-radio>
              <el-radio :label="'Inactive'" border>Inactive</el-radio>
            </el-radio-group>
          </el-form-item>
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
      newTeacherData: {}
    };
  },
  methods: {
    closeDialog() {
      this.$emit("closeUpdateTeacher", false);
      this.$refs.newTeacherData.resetFields();
    },
    save() {
      this.$refs.newTeacherData.validate(valid => {
        if (valid) {
          let params = {
            request: 4,
            data: {
              ID: this.newTeacherData.ID,
              AccountID: this.newTeacherData.AccountID,
              Name: this.newTeacherData.Name,
              Position: this.newTeacherData.Position,
              Status: this.newTeacherData.Status == "Active" ? 1 : 2
            }
          };
          this.http
            .post(this.api.TeacherService, params)
            .then(response => {
              if (response.data.State == 1) {
                this.updateData();
              }
              this.$message({
                type: response.data.State == 1 ? "success" : "danger",
                message: response.data.Message
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
    showUpdateTeacher: {
      type: Boolean,
      default: false
    },
    teacherData: {
      type: Object,
      default: () => {
        return {};
      }
    }
  },
  created() {},
  mounted() {
    this.newTeacherData = this.teacherData;
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
