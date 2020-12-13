<template>
  <el-dialog
    title="Update Student"
    :visible.sync="showUpdateStudent"
    @close="closeDialog"
  >
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
      this.$emit("closeUpdateStudent", false);
    }
  },
  props: {
    showUpdateStudent: {
      type: Boolean,
      default: false
    }
  },
  created() {}
};
</script>
