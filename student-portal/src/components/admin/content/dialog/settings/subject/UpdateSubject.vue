<template>
  <el-dialog
    :visible.sync="showUpdateSubject"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Update Subject
    </template>
    <div class="add-course-content">
      <el-form
        :label-position="'left'"
        :model="newSubjectData"
        class="add-dialog-form"
        label-width="130px"
        status-icon
        ref="newSubjectData"
        :rules="rules"
      >
        <el-divider content-position="left">Subject Details</el-divider>
        <div class="form-item-account-details">
          <el-form-item label="Code:" prop="Code">
            <el-input v-model="newSubjectData.Code" type="text"></el-input>
          </el-form-item>
          <el-form-item label="Title:" prop="Title">
            <el-input v-model="newSubjectData.Title" type="text"></el-input>
          </el-form-item>
          <el-form-item label="Description:" prop="Description">
            <el-input
              v-model="newSubjectData.Description"
              type="text"
            ></el-input>
          </el-form-item>
          <el-form-item label="Status:">
            <el-radio-group v-model="newSubjectData.Status" size="mini">
              <el-radio :label="'Active'" border>Active</el-radio>
              <el-radio :label="'Inactive'" border>Inactive</el-radio>
            </el-radio-group>
          </el-form-item>
        </div>
      </el-form>
    </div>
    <span slot="footer" class="dialog-footer">
      <el-button @click="closeDialog">Cancel</el-button>
      <el-button type="primary" @click="update()">Save</el-button>
    </span>
  </el-dialog>
</template>

<script>
export default {
  components: {},
  data() {
    var validateCode = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the subject code"));
      } else {
        callback();
      }
    };
    var validateTitle = (rule, value, callback) => {
      if (value === "") {
        callback(new Error("Please input the subject title"));
      } else {
        callback();
      }
    };
    return {
      rules: {
        Code: [{ validator: validateCode, trigger: "blur" }],
        Title: [{ validator: validateTitle, trigger: "blur" }]
      },
      newSubjectData: {}
    };
  },
  methods: {
    closeDialog() {
      this.$emit("closeUpdateSubject", false);
      this.updateData();
    },
    update() {
      this.$refs.newSubjectData.validate(valid => {
        if (valid) {
          let params = {
            request: 4,
            data: {
              ID: this.newSubjectData.ID,
              Code: this.newSubjectData.Code,
              Title: this.newSubjectData.Title,
              Description: this.newSubjectData.Description,
              Status: this.newSubjectData.Status == "Active" ? 1 : 2
            }
          };
          this.http
            .post(this.api.SubjectService, params)
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
    showUpdateSubject: {
      type: Boolean,
      default: false
    },
    subjectData: {
      type: Object,
      default: () => {
        return {};
      }
    }
  },
  created() {},
  mounted() {
    this.newSubjectData = this.subjectData;
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
