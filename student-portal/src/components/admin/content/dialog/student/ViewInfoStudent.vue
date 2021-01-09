<template>
  <el-dialog
    :visible.sync="showViewInfoStudent"
    @close="closeDialog()"
    :show-close="false"
    :close-on-press-escape="false"
    :close-on-click-modal="false"
    top="50px"
  >
    <template #title>
      View Info
    </template>
    <div class="content">
      {{ studentData }}
    </div>
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
      this.$emit("closeViewInfoStudent", false);
    }
  },
  props: {
    showViewInfoStudent: {
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
