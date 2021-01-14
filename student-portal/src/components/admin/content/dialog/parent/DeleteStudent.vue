<template>
  <el-dialog
    title="Delete Student"
    :visible.sync="showDeleteStudent"
    width="20%"
    @close="closeDialog()"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
  >
    <span>Are you sure you want to delete?</span>
    <span slot="footer" class="dialog-footer">
      <el-button @click="closeDialog">Cancel</el-button>
      <el-button type="primary" @click="deleteStudent">Delete</el-button>
    </span>
  </el-dialog>
</template>

<script>
export default {
  components: {},
  data() {
    return {};
  },
  methods: {
    closeDialog() {
      this.$emit("closeDeleteStudent", false);
    },
    deleteStudent() {
      let params = {
        request: 7,
        data: this.studentData
      };
      this.http
        .post(this.api.AdminService, params)
        .then(response => {
          if (response.data[0].State == 1) {
            this.closeDialog();
            this.$message({
              type: "success",
              message: response.data[0].Message
            });
            this.$emit("updateData");
          }
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  props: {
    showDeleteStudent: {
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
  created() {}
};
</script>
