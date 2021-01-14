<template>
  <div class="grades">
    <div class="top-panel">
      <el-row :gutter="20">
        <el-col :span="6">

            <div class="search-box">
              <!-- <div class="title-box">
                <span>Search</span>
              </div> -->
              <el-input placeholder="Search" v-model="searchText" class="input-with-select">
                <el-button slot="append" icon="el-icon-search"></el-button>
              </el-input>
              <div class="list">
                <div class="list-wrapper">
                  <div class="list-item" v-for="(item, key) in studentList" :key="key">
                    {{ item.LastName + ' ' + item.FirstName + ', ' + item.MiddleName.split('')[0] }}
                  </div>
                </div>
              </div>
            </div>
            <div class="bottom-box"></div>
        </el-col>
        <el-col :span="18">
          <div class="grid-content bg-purple">
            <el-divider content-position="left">Student Info</el-divider>
            <div>student info</div>
          </div>
        </el-col>
      </el-row>
    </div>
  </div>
</template>

<script>
export default {
  components: {},
  data() {
    return {
      searchText: '',
      select: 'Account ID',
      studentList: [],
    };
  },
  methods: {
    getStudentList() {
      var params = {
        request: 1,
        data: {}
      };
      this.http
        .post(this.api.AdminService, params)
        .then(response => {
          this.studentList = [];
          this.studentList = response.data;
        })
        .catch(error => {
          console.log(error);
        });
    },
  },
  props: {},
  created() {
    this.getStudentList();
  }
};
</script>

<style lang="scss">
.grades {
  height: 100%;
  overflow: hidden;
  .top-panel {
    margin-bottom: 20px;
  }
  
  .el-col {
    // border: 1px solid #ccc;
    // box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.25);
  }
  .top-panel .grid-content {
    .el-select .el-input {
      width: 120px;
    }
    .input-with-select .el-input-group__prepend {
      background-color: #fff;
    }
  }

  .top-panel .search-box {
    max-height: 350px;
    overflow: hidden;
    margin-bottom: 20px;

    .title-box {
      text-align: left;
      height: 25px;
      line-height: 25px;
    }
    .el-input-group input {
      line-height: 15px;
      height: 30px;
      border-radius: 0;
    }
    .el-input-group .el-input-group__append {
      border-radius: 0;
    }
    .list {
      height: calc(350px - 30px);
      .list-wrapper {
        height: 100%;
        overflow-y: scroll;
        border: 1px solid #ccc;
        border-top: 0;
        box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.25);
      }
      .list-wrapper .list-item {
        text-align: left;
        padding: 5px 10px;
        font-size: 14px;
        border-bottom: 1px solid #EBEEF5;
      }
      // .list-wrapper .list-item:not(:last-child) {
      //   border-bottom: 1px solid #EBEEF5;
      // }
    }
  }

  .top-panel .bottom-box {
    border: 1px solid #ccc;
    box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.25);
    height: 150px;
  }

  .el-divider--horizontal {
    margin: 15px 0px;
  }

  .grid-content.bg-purple {
    display: block;
    border: 1px solid #ccc;
    box-shadow: 0px 1px 3px 0px rgba(0, 0, 0, 0.25);
  }
}
</style>
