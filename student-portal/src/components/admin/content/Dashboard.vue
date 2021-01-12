<template>
  <div class="dashboard">
    <div class="dashboard-wrapper">
      <div class="top-panel">
        <el-row :gutter="20">
          <el-col :span="8">
            <div class="grid-content bg-purple">Student</div>
            <!-- <div class="el-col-wraper">
            <div class="grid-content bg-purple"></div>
            <div class="grid-content bg-purple"></div>
            <div class="grid-content bg-purple"></div>
            <div class="grid-content bg-purple"></div>
            </div> -->
          </el-col>
          <el-col :span="8"
            ><div class="grid-content bg-purple">Parent</div></el-col
          >
          <el-col :span="8"
            ><div class="grid-content bg-purple">Teacher</div></el-col
          >
        </el-row>
      </div>
      <div class="bottom-panel">
        <el-row :gutter="20">
          <el-col :span="16"
            ><div class="grid-content bg-purple">
              Table for recent activities
            </div></el-col
          >
          <el-col :span="8"
            ><div class="grid-content bg-purple">Time and Date</div></el-col
          >
        </el-row>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {};
  },
  methods: {},
  props: {},
  created() {}
};
</script>

<style lang="scss">
.dashboard {
  height: 100%;
  .dashboard-wrapper {
    height: 100%;
  }

  .top-panel .top-panel-wrapper {
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;

    .item {
      border: 1px solid #000;
      width: calc(33.3333% - 20px);
      height: 120px;
    }
  }

  .top-panel {
    height: 120px;
    margin-bottom: 20px;
    .el-row .el-col {
      height: 120px;
      line-height: 120px;
      .grid-content {
        border: 1px solid red;
      }
    }
  }

  .bottom-panel {
    height: 350px;
    min-height: 350px;
    .el-row {
      height: 100%;
    }
    .el-row .el-col {
      height: 100%;
      .grid-content {
        height: 100%;
        border: 1px solid red;
      }
    }
  }
}
</style>
