<template>
  <el-dialog title="Add Student" :visible.sync="showAddStudent" @close="closeDialog">

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
      this.$emit('closeAddStudent', false);
    }
  },
  props: {
    showAddStudent: {
      type: Boolean,
      default: false,
    },
  },
  created() {}
};
</script>
