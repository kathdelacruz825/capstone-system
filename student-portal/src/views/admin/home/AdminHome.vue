<template>
  <div class="home admin-theme-main">
    <div class="home-wrapper">
      <el-container>
        <el-header>
          <Header />
        </el-header>
        <el-container>
          <el-aside width="200px">
            <Aside @selectTabContent="selectTabContent" />
          </el-aside>
          <el-container>
            <el-main>
              <Main :tabContent="currTabContent" />
            </el-main>
            <!--
            <el-footer>Footer</el-footer>
            -->
          </el-container>
        </el-container>
      </el-container>
    </div>
  </div>
</template>

<script>
// @ is an alias to /src
import Header from "@/components/admin/home/Header.vue";
import Aside from "@/components/admin/home/Aside.vue";
import Main from "@/components/admin/home/Main.vue";

export default {
  name: "Home",
  components: {
    Header,
    Aside,
    Main
  },
  data() {
    return {
      currTabContent: "Dashboard"
    };
  },
  methods: {
    selectTabContent(val) {
      console.log(val);
      this.currTabContent = val;
    }
  }
};
</script>
<style lang="scss">
.home {
  .home-wrapper {
    height: 100vh;
    min-width: 1200px;
    .el-container {
      height: 100%;
    }
  }

  .el-header {
    height: 50px !important;
  }
  .el-main {
    padding: 0px;
  }

  .el-table td {
    padding: 5px 0px;
  }

  .el-tabs--border-card>.el-tabs__content {
    padding: 0px 10px 10px;
  }
}
</style>
