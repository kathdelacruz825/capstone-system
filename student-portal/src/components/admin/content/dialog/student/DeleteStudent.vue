<template>
  <el-dialog
    title="Delete Student"
    :visible.sync="showDeleteStudent"
    width="20%"
    :before-close="closeDialog"
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
      console.log("deleted");
    }
  },
  props: {
    showDeleteStudent: {
      type: Boolean,
      default: false
    }
  },
  created() {}
};
</script>
