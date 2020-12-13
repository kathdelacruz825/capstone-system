<template>
  <el-dialog
    title="View Info"
    :visible.sync="showViewInfoStudent"
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
      this.$emit("closeViewInfoStudent", false);
    }
  },
  props: {
    showViewInfoStudent: {
      type: Boolean,
      default: false
    }
  },
  created() {}
};
</script>
