<template>
  <div class="home">
    <el-container>
      <el-header>
        <Header />
      </el-header>
      <el-container>
        <el-aside width="400px">
          <Aside />
        </el-aside>
        <el-container>
          <el-main>
            <Main />
          </el-main>
          <!--
          <el-footer>Footer</el-footer>
          -->
        </el-container>
      </el-container>
    </el-container>
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
  }
};
</script>
