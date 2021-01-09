<template>
  <el-dialog
    title="Update Student"
    :visible.sync="showUpdateStudent"
    @close="closeDialog"
    top="50px"
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
    },
    studentData: {
      type: Object,
      default: () => {
        return {};
      }
    }
  },
  // watch: {
  //   studentData: (newVal, oldVal) => {
  //     console.log(newVal, oldVal);
  //   }
  // },
  created() {}
};
</script>
