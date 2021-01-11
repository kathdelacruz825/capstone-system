<template>
  <el-dialog
    :visible.sync="showAddCourse"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
    width="600px"
  >
    <template #title>
      Add Course
    </template>
    Add Course
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
    return {};
  },
  methods: {
    closeDialog() {
      this.$emit("closeAddCourse", false);
    }
  },
  props: {
    showAddCourse: {
      type: Boolean,
      default: false
    }
  },
  created() {}
};
</script>

<style lang="scss"></style>
