<template>
  <el-dialog
    title="Parent Status"
    :visible.sync="showInActiveStudent"
    width="20%"
    @close="closeDialog()"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
  >
    <span>Are you sure you want to set {{ statusTitle }}?</span>
    <span slot="footer" class="dialog-footer">
      <el-button @click="closeDialog">Cancel</el-button>
      <el-button type="primary" @click="setStatus()"
        >Set {{ statusTitle }}</el-button
      >
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
      this.$emit("closeInActiveStudent", false);
    },
    setStatus() {
      let params = {
        request: this.request,
        data: {
          ID: this.studentData.ID,
          AccountStatus: this.statusTitle == "Active" ? 1 : 2
        }
      };
      this.http
        .post(this.api.ParentService, params)
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
    showInActiveStudent: {
      type: Boolean,
      default: false
    },
    statusTitle: {
      type: String,
      default: ""
    },
    request: {
      type: Number,
      default: 4 // default value for set inactive
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
